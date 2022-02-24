<script>
    import { onMount } from 'svelte'
    import { _ } from 'svelte-i18n'

    import SelectMulti from 'svelte-select'
    import InputError from '@/Shared/InputError'

    export let id = ''
    export let classes = ''
    export let selectedValue
    export let items
    export let placeholder
    export let error
    export let required
    export let disabled = false

    const groupBy = (item) => item.group

    let select = null

    onMount(() => {
        select = document.getElementById(id)
    })

    $: selectedValue
    $: if (required && select != null) {
        selectedValue != undefined ? select.setCustomValidity('') : select.setCustomValidity($_('Please fill out this field.'))
    }
</script>

<SelectMulti isDisabled={disabled} inputAttributes={{ id: id }} bind:selectedValue {items} containerClasses="items {classes}" isMulti={true} {groupBy} placeholder={required ? placeholder + ' *' : placeholder} autocomplete="off" />
<InputError message={error} />

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
</style>
