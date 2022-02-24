<script>
    import fitTextarea from 'fit-textarea'
    import InputError from '@/Shared/InputError'
    import Textarea from '@smui/textfield'
    import CharacterCounter from '@smui/textfield/character-counter/index'
    import { onMount } from 'svelte'
    import { writable } from 'svelte/store'

    export let error
    export let id
    export let value
    export let label
    export let disabled
    export let sinContador = false
    export let maxlength = 2000
    export let localStorageForm = null
    export let count = 0

    const theme = writable(null)

    let container

    $: props = {
        ...$$restProps,
        class: `w-full block bg-white ${$$restProps.class || ''}`,
    }

    onMount(() => {
        fitTextarea.watch(container.querySelector('textarea'))
        container.querySelector('textarea').setAttribute('id', id)
    })

    theme.subscribe((value) => {
        if (localStorageForm != null && value) {
            localStorage.setItem(localStorageForm + '.' + value.name, value.value)
            localStorage.getItem(localStorageForm + '.' + value.name) ? count++ : null
        }
    })
</script>

<div bind:this={container}>
    {#if sinContador == true}
        <Textarea {disabled} textarea bind:value {label} {...props} on:input on:blur={() => theme.set({ name: id, value: value })} />
    {:else}
        <Textarea {disabled} textarea input$maxlength={maxlength} bind:value {label} {...props} on:input on:blur={() => theme.set({ name: id, value: value })}>
            <CharacterCounter slot="internalCounter">0 / {maxlength}</CharacterCounter>
        </Textarea>
    {/if}
</div>

{#if error}
    <InputError message={error} />
{/if}
