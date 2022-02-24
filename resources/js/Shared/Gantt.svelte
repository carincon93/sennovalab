<script>
    import { route } from '@/Utils'
    import { _ } from 'svelte-i18n'
    import { Inertia } from '@inertiajs/inertia'

    import Loading from './Loading'
    import DataTableMenu from '@/Shared/DataTableMenu'
    import { Item, Text } from '@smui/list'
    import InfoMessage from '@/Shared/InfoMessage'
    import { onMount } from 'svelte'

    export let items
    export let request = null

    let loading = false

    onMount(() => {
        google.charts.setOnLoadCallback(drawChart)
    })

    function drawChart() {
        var data = new google.visualization.DataTable()
        data.addColumn('string', 'Task ID')
        data.addColumn('string', 'Task Name')
        data.addColumn('date', 'Start Date')
        data.addColumn('date', 'End Date')
        data.addColumn('number', 'Duration')
        data.addColumn('number', 'Percent Complete')
        data.addColumn('string', 'Dependencies')

        items.map(function (item) {
            data.addRows([['itemID-' + item.id, '', item.year_inicio > 1999 ? new Date(item.year_inicio, item.mes_inicio - 1, item.dia_inicio) : null, item.year_finalizacion > 1999 ? new Date(item.year_finalizacion, item.mes_finalizacion - 1, item.dia_finalizacion) : null, null, 100, null]])
        })

        let trackHeight = 120

        var options = {
            width: '100%',
            backgroundColor: {
                fill: 'white',
            },
            height: (items.length + 1) * trackHeight,
            gantt: {
                trackHeight: trackHeight,
                labelMaxWidth: 0,
                labelStyle: {
                    fontName: "'Nunito', sans-serif",
                    fontSize: 10,
                    color: '#757575',
                },
            },
            backgroundColor: {
                fill: '#fff',
            },
        }

        // Valida si el document.getElementById('chart_div') existe para proceder a dibujar el GanttChart
        if (items.length > 0) {
            var chart = new google.visualization.Gantt(document.getElementById('chart_div'))

            loading = true

            if (typeof chart.draw === 'function') {
                // Draw the chart, setting the allowHtml option to true for the tooltips.
                chart.draw(data, options)
            }

            google.visualization.events.addListener(chart, 'select', handleClick)

            function handleClick() {
                var selection = chart.getSelection()
                for (var i = 0; i < selection.length; i++) {
                    var item = selection[i]
                    var itemID = data.getValue(item.row, i)
                    let er = /(\w{6}-)/
                    let newID = itemID.replace(er, '')

                    console.log(newID)
                }
            }
        } else {
            loading = true
        }
    }

    function arrayPush(item, i) {
        // Agrega el id del item a request.params
        request.params.push(item)
        return request.params
    }
</script>

<div class="flex relative mt-10">
    {#if items.length === 0}
        <InfoMessage message={$_('No data recorded')} />
    {:else}
        <aside class="labels" style={items.length > 0 ? 'flex: 0.5' : ''}>
            <ul class="list-unstyled">
                {#each items as item, i}
                    <li class="border-b-2 flex p-1.5" style="height:120px; max-height:120px; line-height: 1.2">
                        {#if request}
                            <div class="w-full">
                                <p class="paragraph-ellipsis w-full" style="max-width: 90%;">
                                    {item.descripcion ?? item.nombre}
                                </p>
                                {#if item.year_inicio < 1999}
                                    <span class="bg-red-100 text-red-400 hover:bg-red-200 px-2 py-1 rounded-3xl text-center inline-block mt-2 mb-2">Sin fechas definidas</span>
                                {/if}
                            </div>
                            <DataTableMenu>
                                <Item on:SMUI:action={() => Inertia.visit(route(request.uri, arrayPush(item.id)))}>
                                    <Text>{$_('View details')}</Text>
                                </Item>
                            </DataTableMenu>
                        {:else}
                            <span style="max-width: 90%;max-height: 50px;overflow: hidden;">{item.descripcion ?? item.nombre}</span>
                        {/if}
                    </li>
                {/each}
            </ul>
        </aside>
        <div id="chart_div" style="flex: 1;" />
    {/if}
    <Loading {loading} bg="transparent" />
</div>

<style>
    :global(#chart_div path) {
        fill: #4f46e5;
    }

    .paragraph-ellipsis {
        -webkit-line-clamp: 4 !important;
        height: 75px;
    }
</style>
