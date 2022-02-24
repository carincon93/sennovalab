<script>
    import Label from '@/Shared/Label'
    import InputError from '@/Shared/InputError'
    import InfoMessage from '@/Shared/InfoMessage'

    export let id
    export let value
    export let label
    export let error
    export let maxSize

    let input
    let size

    export const focus = () => input.focus()
    export const select = () => input.select()

    $: props = {
        ...$$restProps,
        class: `w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm ${$$restProps.class || ''}`,
    }

    function update(event) {
        value = event.target.files[0]
    }

    $: if (value?.size) size = value?.size / 1e6

    $: size > maxSize / 1000 ? (error = `El archivo pesa más de ${maxSize / 1000} MB. Por favor optimice el tamaño.`) : (error = null)
</script>

<div class={$$restProps.class}>
    <Label {label} {id} />

    <input {...props} type="file" class="w-full border-gray-300 shadow-sm focus:ring focus:ring-opacity-50{error ? ' ring ring-opacity-50 border-red-200 ring-red-200 focus:border-red-200 focus:ring-red-200' : 'focus:border-indigo-200 focus:ring-indigo-200'}" {id} on:change={(event) => update(event)} />
    <InfoMessage message="El archivo debe pesar máximo {maxSize / 1000} MB" />

    {#if value?.size}
        <span class="inline-block mt-4 mb-4">Peso del archivo: {size.toFixed(2)} MB</span>
    {/if}

    {#if error}
        <InputError message={error} />
    {/if}
</div>
