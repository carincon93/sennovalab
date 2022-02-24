<script>
    import { Jumper } from 'svelte-loading-spinners'

    export let loading = true
</script>

{#if !loading}
    <div class="fixed right-0 bottom-0">
        <Jumper size="60" color="#6366f1" unit="px" duration="1s" />
    </div>
{/if}
