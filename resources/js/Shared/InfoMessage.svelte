<script>
    export let message
    export let alertMsg

    $: props = {
        ...$$restProps,
        class: `relative ${alertMsg ? 'bg-red-100 text-red-600' : 'bg-orange-100 text-orange-600'} p-5 ${$$restProps.class || ''}`,
    }
</script>

<div {...props}>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5" style="transform: translateX(-44px); position: absolute;">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    {#if message}
        <p class="whitespace-pre-wrap">{@html message}</p>
    {/if}
    <slot />
</div>
