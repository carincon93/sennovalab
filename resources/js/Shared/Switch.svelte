<script>
    import Switch from '@smui/switch'
    import FormField from '@smui/form-field'

    export let checked = false
    export let disabled
    export let onMessage = 'Si'
    export let offMessage = 'No'
</script>

<FormField>
    <Switch bind:checked {disabled} />
    <span slot="label">
        {#if checked} {onMessage} {:else} {offMessage} {/if}
    </span>
</FormField>
