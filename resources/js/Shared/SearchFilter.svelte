<script>
    import { Inertia } from '@inertiajs/inertia'
    import { page } from '@inertiajs/inertia-svelte'
    import { route } from '@/Utils'
    import pickBy from 'lodash/pickBy'
    import debounce from 'lodash/debounce'
    import Dropdown from '@/Shared/Dropdown'

    export let routeParams
    export let showFilters = false
    export let filters = {}
    export let maxWidth = 300

    $: props = {
        ...$$restProps,
        class: `flex items-center ${$$restProps.class || ''}`,
    }

    let readyToSearch = false
    let form = {
        search: $page.props.filters.search,
    }

    $: if (filters) {
        form = { ...form, ...filters }
    }

    $: search(form)

    function reset() {
        Object.keys(form).forEach((key) => (form[key] = null))
        Object.keys(filters).forEach((key) => (filters[key] = null))
    }

    const search = debounce((form) => {
        if (!readyToSearch) {
            readyToSearch = true
            return
        }

        let query = pickBy(form)

        Inertia.get(route(route().current(), routeParams), Object.keys(query).length ? query : { remember: 'forget' }, { preserveState: true, preserveScroll: true })
    }, 150)
</script>

<div {...props}>
    {#if showFilters}
        <Dropdown
            class="px-4 md:px-6 rounded-l border-r hover:bg-gray-100 focus:border-white
      focus:shadow-outline focus:z-10"
            placement="bottom-start"
            autoclose={false}
        >
            <div class="flex items-baseline">
                <span class="text-gray-700 hidden md:inline">Filtros:</span>
                <svg class="w-2 h-2 fill-gray-700 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
                    <path
                        d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624
            239.999-.345-.001-108.625-108.001-240.624-240z"
                    />
                </svg>
            </div>
            <div slot="dropdown" class="mt-2 px-4 py-6 w-screen shadow-xl bg-white rounded" style="max-width: {maxWidth}px">
                <slot />
            </div>
        </Dropdown>
    {/if}
    <input class="relative w-full px-6 py-3 rounded focus:shadow-outline" autocomplete="off" type="text" name="search" placeholder="Buscar…" bind:value={form.search} />

    <button class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500" type="button" on:click={reset}> Limpiar </button>
</div>
