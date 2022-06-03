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
    export let tipos_documento
    export let tipos_usuario
    export let estados

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let isSuperAdmin = checkRole(authUser, [1])
</script>

<form on:submit|preventDefault={submit} class="col-span-2">
    <fieldset class="px-8">
        <div class="grid gap-4 grid-cols-2">
            <div class="mb-10 w-full">
                <Label class="mb-5" required labelFor="primer_nombre" value="Primer nombre" />
                <Input id="primer_nombre" type="text" bind:value={$form.primer_nombre} error={errors.primer_nombre} required />
            </div>

            <div class="mb-10 w-full">
                <Label class="mb-5" labelFor="segundo_nombre" value="Segundo nombre" />
                <Input id="segundo_nombre" type="text" bind:value={$form.segundo_nombre} error={errors.segundo_nombre} />
            </div>
        </div>

        <div class="grid gap-4 grid-cols-2">
            <div class="mb-10">
                <Label class="mb-5" required labelFor="primer_apellido" value="Primer apellido" />
                <Input id="primer_apellido" type="text" bind:value={$form.primer_apellido} error={errors.primer_apellido} required />
            </div>

            <div class="mb-10">
                <Label class="mb-5" labelFor="segundo_apellido" value="Segundo apellido" />
                <Input id="segundo_apellido" type="text" bind:value={$form.segundo_apellido} error={errors.segundo_apellido} />
            </div>
        </div>

        <div class="mb-10">
            <Label required class="mb-5" labelFor="tipo_documento" value="Tipo de documento" />
            <Select id="tipo_documento" items={tipos_documento} bind:selectedValue={$form.tipo_documento} error={errors.tipo_documento} placeholder="Seleccione un tipo de documento" required />
        </div>

        <div class="mb-10">
            <Label required class="mb-5" labelFor="numero_documento" value="Número de documento" />
            <Input id="numero_documento" type="number" input$min="0" bind:value={$form.numero_documento} error={errors.numero_documento} required />
        </div>

        <div class="mb-10">
            <Label required class="mb-5" labelFor="email" value="Correo electrónico" />
            <Input id="email" type="email" bind:value={$form.email} error={errors.email} required />
        </div>

        <div class="grid gap-4 grid-cols-3">
            <div class="mb-10">
                <Label required class="mb-5" labelFor="celular" value="Celular" />
                <Input id="celular" type="text" bind:value={$form.celular} error={errors.celular} required />
            </div>

            <div class="mb-10">
                <Label required class="mb-5" labelFor="telefono" value="Teléfono" />
                <Input id="telefono" type="text" bind:value={$form.telefono} error={errors.telefono} required />
            </div>

            <div class="mb-10">
                <Label labelFor="extension" class="mb-5" value="Extensión" />
                <Input id="extension" type="text" bind:value={$form.extension} error={errors.extension} />
            </div>
        </div>

        <div class="mb-10">
            <Label required class="mb-5" labelFor="tipo_usuario" value="Tipo de usuario" />
            <Select id="tipo_usuario" items={tipos_usuario} bind:selectedValue={$form.tipo_usuario} error={errors.tipo_usuario} placeholder="Seleccione un tipo de usuario" required />
        </div>

        <div class="grid gap-4 grid-cols-2">
            <div class="mb-10">
                <Label required class="mb-5" labelFor="empresa_centro_formacion" value="Nombre de la empresa / entidad / centro de formación" />
                <Input id="empresa_centro_formacion" type="text" bind:value={$form.empresa_centro_formacion} error={errors.empresa_centro_formacion} required />
            </div>

            <div class="mb-10 grid gap-2 grid-cols-2">
                <div>
                    <Label required class="mb-5" labelFor="nit_rut" value="NIT / RUT" />
                    <Input id="nit_rut" type="number" input$min="0" input$max="9223372036854775807" bind:value={$form.nit_rut} error={errors.nit_rut} required />
                </div>

                <div>
                    <Label required class="mb-5" labelFor="digito_verificacion" value="Dígito de verificación" />
                    <Input id="digito_verificacion" type="number" input$min="0" input$max="9" bind:value={$form.digito_verificacion} error={errors.digito_verificacion} required />
                </div>
            </div>
        </div>

        <div class="mt-10">
            <Label required labelFor="estado" value="Estado" />
            <Select id="estado" error={errors.estado} required placeholder="Seleccione un estado" items={estados} bind:selectedValue={$form.estado} />
        </div>

        {#if method != 'put'}
            <div class="mt-10">
                <InfoMessage message="Los datos proporcionados serán tratados de acuerdo con la política de tratamiento de datos personales del SENA y a la ley 1581 de 2012 (Acuerdo No. 0009 del 2016)" class="mb-4" />
                <FormField>
                    <Checkbox bind:checked={$form.autorizacion_tratamiento_datos} />
                    <span slot="label">¿El usuario autoriza el tratamiento de datos personales. <a href="https://www.sena.edu.co/es-co/transparencia/Documents/proteccion_datos_personales_sena_2016.pdf" target="_blank" class="text-indigo-500">Leer acuerdo No. 0009 del 2016</a>?</span>
                </FormField>
            </div>
        {/if}

        {#if $form.numero_documento && method != 'put'}
            <div class="mt-10">
                <InfoMessage>
                    <p>La contraseña del usuario es: <span class="font-black">sennovalab{$form.numero_documento}*</span></p>
                    <p>Por favor copiela verificando que no hayan espacios y envíela al usuario</p>
                </InfoMessage>
            </div>
        {/if}
    </fieldset>
    <div class="mt-10 px-8 py-4 flex items-center sticky bottom-0">
        <LoadingButton loading={sending} disabled={$form.autorizacion_tratamiento_datos} class="ml-auto" type="submit">Guardar</LoadingButton>
    </div>
</form>
