<script>
    export let labelFor
    export let value
    export let required

    $: props = {
        ...$$restProps,
        class: `block font-medium text-sm text-gray-700 ${$$restProps.class || ''}`,
    }
</script>

{#if value}
    <label {...props} for={labelFor}>
        {@html value}
        {#if required}
            <small class="label-required text-red-400">* Campo obligatorio</small>
        {/if}
    </label>
{/if}
