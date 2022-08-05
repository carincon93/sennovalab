<script>
    import Input from '@/Shared/Input'
    import Label from '@/Shared/Label'
    import LoadingButton from '@/Shared/LoadingButton'

    /**
     * Datos que llegan desde el componente padre (Create-Edit)
     */
    //
    export let submit
    export let errors
    export let form
    // export let method

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let isSuperAdmin = checkRole(authUser, [1])
</script>

<form on:submit|preventDefault={submit} class="col-span-2">
    <fieldset class="px-8">
        <div class="mt-20">
            <Label class="mb-5" required labelFor="nombre" value="Nombre de la línea de desarrollo" />
            <Input id="nombre" type="text" bind:value={$form.nombre} error={errors.nombre} required />
        </div>
    </fieldset>
    <div class="mt-10 px-8 py-4 flex items-center sticky bottom-0">
        <LoadingButton loading={$form.processing} class="ml-auto" type="submit">Guardar</LoadingButton>
    </div>
</form>
