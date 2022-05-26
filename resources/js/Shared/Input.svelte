<script>
    import Label from '@/Shared/Label'
    import InputError from './InputError'
    import Textfield from '@smui/textfield'
    import { onMount } from 'svelte'

    export let id
    export let value
    export let label
    export let error
    export let type
    export let disabled

    let input
    let container

    export const focus = () => input.focus()
    export const select = () => input.select()

    $: props = {
        ...$$restProps,
        class: 'w-full block bg-white rounded',
    }

    function update(event) {
        value = event.target.value
    }

    onMount(() => {
        container.querySelector('input').setAttribute('id', id)
    })
</script>

<div class={$$restProps.class} bind:this={container}>
    <Label {label} {id} />

    <Textfield {disabled} variant="outlined" {...props} bind:this={input} {type} {value} on:input={update} {label} />
    {#if error}
        <InputError message={error} />
    {/if}
</div>
