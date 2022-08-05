<script>
    import { checkRole, checkPermission } from '@/Utils'

    import Input from '@/Shared/Input'
    import Label from '@/Shared/Label'
    import Select from '@/Shared/Select'
    import InfoMessage from '@/Shared/InfoMessage'
    import Checkbox from '@smui/checkbox'
    import FormField from '@smui/form-field'
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
    export let nombre_linea

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let isSuperAdmin = checkRole(authUser, [1])
</script>

<form on:submit|preventDefault={submit} class="col-span-2">
    <fieldset class="px-8">
        <div class="grid gap-4 grid-cols-2">
            <div class="mb-10 w-full">
                <Label class="mb-5" required labelFor="nombre" value="Nombre de la linea" />
                <Input id="primer_nombre" type="text" bind:value={$form.nombre_linea} error={errors.nombre_linea} required />
            </div>
        </div>
    </fieldset>
    <div class="mt-10 px-8 py-4 flex items-center sticky bottom-0">
        <LoadingButton loading={sending} class="ml-auto" type="submit">Crear</LoadingButton>
    </div>
</form>
