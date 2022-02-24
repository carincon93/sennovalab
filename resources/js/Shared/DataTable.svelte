<script>
    import SearchFilter from '@/Shared/SearchFilter'

    export let filters
    export let showFilters
    export let routeParams
    export let showSearchInput = true

    $: props = {
        ...$$restProps,
        class: `${$$restProps.class || ''}`,
    }
</script>

<div {...props}>
    <h1 class="mt-24 mb-8 text-center text-3xl">
        <slot name="title" />
    </h1>
    <div class="mb-8">
        <slot name="caption" />
    </div>

    <div class="mb-6 flex justify-between items-center">
        {#if showSearchInput}
            <SearchFilter {routeParams} class="w-full max-w-md mr-4" {showFilters} bind:filters>
                <slot name="filters" />
            </SearchFilter>
            <slot name="actions" />
        {/if}
    </div>
    <div class="bg-white rounded shadow">
        <table class="w-full whitespace-no-wrap table-fixed data-table">
            <slot name="thead" />
            <slot name="tbody" />
            <slot name="tfoot" />
        </table>
    </div>
</div>

<style>
    :global(.data-table td.border-t.td-actions:last-child) {
        text-align: center;
        width: 150px;
    }
</style>
