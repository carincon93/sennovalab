<script>
    import _ from 'lodash'

    export let errors
</script>

{#if !_.isEmpty(errors)}
    <div>
        <div class="font-medium text-red-600">Whoops! Something went wrong.</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            {#each errors as error}
                <li>{error}</li>
            {/each}
        </ul>
    </div>
{/if}
