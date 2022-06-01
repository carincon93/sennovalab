<script>
    import { checkRole, checkPermission } from '@/Utils'

    import Input from '@/Shared/Input'
    import Label from '@/Shared/Label'
    import LoadingButton from '@/Shared/LoadingButton'

    /**
     * Datos que llegan desde el componente padre (Create-Edit)
     */
    //
    export let submit
    export let authUser
    export let sending
    export let errors
    export let form
    export let method

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let isSuperAdmin = checkRole(authUser, [1])
</script>

<form on:submit|preventDefault={submit} class="col-span-2">
    <fieldset class="px-8">
        <div>
            <Label required labelFor="columna" value="Nombre columna" />
            <Input id="columna" type="text" bind:value={$form.columna} error={errors.columna} required />
        </div>
    </fieldset>
    <div class="mt-10 px-8 py-4 flex items-center sticky bottom-0">
        <LoadingButton loading={sending} class="ml-auto" type="submit">Guardar</LoadingButton>
    </div>
</form>
