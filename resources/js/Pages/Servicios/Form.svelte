<script>
    import { checkRole, checkPermission } from '@/Utils'

    import Input from '@/Shared/Input'
    import Label from '@/Shared/Label'
    import LoadingButton from '@/Shared/LoadingButton'
    import Select from '@/Shared/Select'
    import Textarea from '@/Shared/Textarea'

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
    export let users_externos
    export let lineas_desarrollo
    export let categorias_linea_desarrollo
    export let tipos_servicios

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let isSuperAdmin = checkRole(authUser, [1])
</script>

<form on:submit|preventDefault={submit} class="col-span-2">
    <fieldset class="px-8">
        <div class="mb-10">
            <Label required class="mb-5" labelFor="user_externo_id" value="Usuario externo" />
            <Select id="user_externo_id" items={users_externos} bind:selectedValue={$form.user_externo_id} error={errors.user_externo_id} placeholder="Seleccione un usuario externo" required />
        </div>
        <div class="mb-10">
            <Label required class="mb-5" labelFor="linea_desarrollo_id" value="Linea de Desarrollo" />
            <Select id="linea_desarrollo_id" items={lineas_desarrollo} bind:selectedValue={$form.linea_desarrollo_id} error={errors.linea_desarrollo_id} placeholder="Seleccione una línea de desarrollo" required />
        </div>
        <div class="mb-10">
            <Label required class="mb-5" labelFor="categoria_linea_desarrollo_id" value="Categoria de línea de desarrollo" />
            <Select id="categoria_linea_desarrollo_id " items={categorias_linea_desarrollo} bind:selectedValue={$form.categoria_linea_desarrollo_id} error={errors.categoria_linea_desarrollo_id} placeholder="Seleccione una categoria de línea de desarrollo" required />
        </div>
        <div class="mb-10">
            <Label required class="mb-5" labelFor="tipo_servicio_id" value="Tipo de servicio" />
            <Select id="tipo_servicio_id" items={tipos_servicios} bind:selectedValue={$form.tipo_servicio_id} error={errors.tipo_servicio_id} placeholder="Seleccione el tipo de servicio" required />
        </div>
        <div class="mb-10">
            <Label required class="mb-5" labelFor="descripcion_necesidad" value="Descripcion de la necesidad del servicio" />
            <Textarea id="descripcion_necesidad" bind:value={$form.descripcion_necesidad} error={errors.descripcion_necesidad} required />
        </div>
    </fieldset>
    <div class="mt-10 px-8 py-4 flex items-center sticky bottom-0">
        <LoadingButton loading={sending} class="ml-auto" type="submit">Guardar</LoadingButton>
    </div>
</form>
