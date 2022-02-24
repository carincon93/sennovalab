<script>
    import { afterUpdate, onMount } from 'svelte'
    import axios from 'axios'
    import Select from 'svelte-select'
    import { _ } from 'svelte-i18n'

    import InputError from '@/Shared/InputError'
    import InfoMessage from '@/Shared/InfoMessage'

    export let classes = ''
    export let id = ''
    export let message
    export let value
    export let required
    export let placeholder
    export let routeWebApi
    export let recurso
    export let reset
    export let noOptionsText = ''
    export let disabled = false

    let items = []
    let itemFiltered = null
    let select = null

    $: if (routeWebApi) {
        getItems()
    }

    onMount(() => {
        getItems()
        select = document.getElementById(id)
    })

    afterUpdate(() => {
        if (required) {
            itemFiltered != null && select != null ? select.setCustomValidity('') : select.setCustomValidity($_('Please fill out this field.'))
        }
    })

    async function getItems() {
        let res = await axios.get(routeWebApi)
        items = res.data
        selectItem()
    }

    function handleSelect(event) {
        value = event.detail.value
        recurso = event.detail
    }

    function selectItem() {
        if (value) {
            let filterItem = items.filter(function (item) {
                return item.value == value
            })
            itemFiltered = filterItem[0]
        }
    }

    $: if (reset) {
        itemFiltered = null
    }
</script>

<Select bind:selectedValue={itemFiltered} inputAttributes={{ id: id }} {placeholder} listPlacement="bottom" containerClasses="items w-full{items.length > 6 ? ' height-select' : ''} {classes}" {items} on:select={handleSelect} on:clear={() => (value = null)} noOptionsMessage="No hay ítems, por favor revise los filtros o de clic en refrescar" isDisabled={disabled} />
{#if items.length == 0}
    <InfoMessage class="mt-4">
        {#if noOptionsText != ''}
            <p class="mb-4">{@html noOptionsText}</p>
        {:else}
            <p>Parece que no se han encontrado elementos. Por favor haga clic en <strong>Refrescar</strong></p>
            <button on:click={getItems} type="button" class="flex underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Refrescar
            </button>
        {/if}
    </InfoMessage>
{/if}
<InputError {message} />

<style>
    :global(.items .listItem) {
        border-bottom: 1px solid #ccc;
    }

    :global(.items .item) {
        height: auto !important;
        line-height: 1.6 !important;
        text-overflow: initial !important;
        overflow: initial !important;
        white-space: break-spaces !important;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    :global(.height-select .listContainer) {
        min-height: 50vh;
    }
</style>
