<script>
    import { checkRole, checkPermission } from '@/Utils'

    import Input from '@/Shared/Input'
    import Label from '@/Shared/Label'
    import Select from '@/Shared/Select'
    import File from '@/Shared/File'
    import InfoMessage from '@/Shared/InfoMessage'
    import Checkbox from '@smui/checkbox'
    import FormField from '@smui/form-field'
    import LoadingButton from '@/Shared/LoadingButton'

    export let submit
    // export let authUser
    export let sending
    export let errors
    export let form
    export let method
    export let tipos_documento
    export let tipos_afiliacion
    export let roles_sennovalab

    // let isSuperAdmin = checkRole(authUser, [1])
</script>

<form on:submit|preventDefault={submit} class="col-span-2">
    <fieldset class="px-8">
        <div class="grid grid-cols-2 gap-8">
            <div>
                <Label required labelFor="primer_nombre" value="Primer nombre" />
                <Input id="primer_nombre" type="text" bind:value={$form.primer_nombre} error={errors.primer_nombre} required />
            </div>

            <div>
                <Label labelFor="segundo_nombre" value="Segundo nombre" />
                <Input id="segundo_nombre" type="text" bind:value={$form.segundo_nombre} error={errors.segundo_nombre} />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 mt-10">
            <div>
                <Label required labelFor="primer_apellido" value="Primer apellido" />
                <Input id="primer_apellido" type="text" bind:value={$form.primer_apellido} error={errors.primer_apellido} required />
            </div>

            <div>
                <Label labelFor="segundo_apellido" value="Segundo apellido" />
                <Input id="segundo_apellido" type="text" bind:value={$form.segundo_apellido} error={errors.segundo_apellido} />
            </div>
        </div>

        <div class="mt-10">
            <Label required labelFor="tipo_documento" value="Tipo de documento" />
            <Select id="tipo_documento" error={errors.tipo_documento} required placeholder="Seleccione un tipo de documento" items={tipos_documento} bind:selectedValue={$form.tipo_documento} />
        </div>

        <div class="mt-10">
            <Label required labelFor="numero_documento" value="Número de documento" />
            <Input id="numero_documento" type="number" input$min="0" input$max="9223372036854775807" bind:value={$form.numero_documento} error={errors.numero_documento} required />
        </div>

        <div class="mt-10">
            <Label required labelFor="email" value="Correo electrónico" />
            <Input id="email" type="email" bind:value={$form.email} error={errors.email} required />
        </div>

        <div class="grid grid-cols-3 gap-8 mt-10">
            <div>
                <Label required labelFor="celular" value="Celular" />
                <Input id="celular" type="number" input$min="0" input$max="9223372036854775807" bind:value={$form.celular} error={errors.celular} required />
            </div>

            <div>
                <Label required labelFor="telefono" value="Teléfono" />
                <Input id="telefono" type="text" bind:value={$form.telefono} error={errors.telefono} required />
            </div>

            <div>
                <Label labelFor="extension" value="Extensión" />
                <Input id="extension" type="text" bind:value={$form.extension} error={errors.extension} />
            </div>
        </div>

        <div class="mt-10">
            <Label required labelFor="tipo_afiliacion" value="Tipo de afiliacion" />
            <Select id="tipo_afiliacion" error={errors.tipo_afiliacion} required placeholder="Seleccione un tipo de afiliación" items={tipos_afiliacion} bind:selectedValue={$form.tipo_afiliacion} />
        </div>

        {#if $form.tipo_afiliacion?.value == 'Contratista'}
            <div class="mt-10">
                <Label required labelFor="numero_contrato" value="Número de contrato" />
                <Input id="numero_contrato" type="text" bind:value={$form.numero_contrato} error={errors.numero_contrato} required />
            </div>

            <div class="grid grid-cols-2 gap-8 mt-10">
                <div>
                    <Label required labelFor="fecha_inicio_contrato" value="Fecha de inicio del contrato" />
                    <input type="date" bind:value={$form.fecha_inicio_contrato} required />
                </div>

                <div>
                    <Label required labelFor="fecha_finalizacion_contrato" value="Fecha de finalización del contrato" />
                    <input type="date" bind:value={$form.fecha_finalizacion_contrato} required />
                </div>
            </div>
        {/if}

        <div class="mt-10">
            <Label required labelFor="rol_sennovalab" value="Rol SENNOVALAB" />
            <Select id="rol_sennovalab" error={errors.rol_sennovalab} required placeholder="Seleccione un rol SENNOVALAB" items={roles_sennovalab} bind:selectedValue={$form.rol_sennovalab} />
        </div>

        <div class="mt-10">
            <Label required={method != 'put' ? 'required' : undefined} labelFor="firma_digital" value="Firma digital" />
            <File id="firma_digital" accept=".jpeg,.bmp,.png" bind:value={$form.firma_digital} error={errors.firma_digital} maxSize={5000} required={method != 'put' ? 'required' : undefined} />
        </div>

        {#if method != 'put'}
            <div class="mt-10">
                <InfoMessage message="Los datos proporcionados serán tratados de acuerdo con la política de tratamiento de datos personales del SENA y a la ley 1581 de 2012 (Acuerdo No. 0009 del 2016)" class="mb-4" />
                <FormField>
                    <Checkbox bind:checked={$form.autorizacion_datos} />
                    <span slot="label">¿El usuario autoriza el tratamiento de mis datos personales. <a href="https://www.sena.edu.co/es-co/transparencia/Documents/proteccion_datos_personales_sena_2016.pdf" target="_blank" class="text-indigo-500">Leer acuerdo No. 0009 del 2016</a>?</span>
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
        <LoadingButton loading={sending} disabled={$form.autorizacion_datos} class="ml-auto" type="submit">Guardar</LoadingButton>
    </div>
</form>
