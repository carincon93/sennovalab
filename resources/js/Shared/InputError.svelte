<script>
    export let message
</script>

{#if message}
    <div class="text-red-400 bg-red-100 py-1 px-2">
        <p>
            {message}
        </p>
    </div>
{/if}
