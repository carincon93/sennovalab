<script context="module">
    import GuestLayout from '@/Layouts/Guest'
    export const layout = GuestLayout
</script>

<script>
    import { inertia, useForm } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'
    import LoadingButton from '@/Shared/LoadingButton'
    import Input from '@/Shared/Input'
    import Label from '@/Shared/Label'
    import Select from '@/Shared/Select'
    import Button from '@/Shared/Button'
    import InfoMessage from '@/Shared/InfoMessage'
    import Checkbox from '@smui/checkbox'
    import FormField from '@smui/form-field'
    import { Inertia } from '@inertiajs/inertia'

    export let errors

    let tipos_documento = [
        {
            value: 'cc',
            label: 'Cédula de ciudadania',
        },
        {
            value: 'ce',
            label: 'Cédula de extranjería',
        },
    ]

    let tipos_usuarios = [
        {
            value: 'Persona natural',
            label: 'Persona natural',
        },
        {
            value: 'Persona jurídica',
            label: 'Persona jurídica',
        },
    ]

    let sending = false

    let form = useForm({
        primer_nombre: '',
        segundo_nombre: '',
        primer_apellido: '',
        segundo_apellido: '',
        email: '',
        tipo_documento: '',
        numero_documento: '',
        celular: '',
        telefono: '',
        extension: '',
        tipo_usuario: '',
        empresa_centro_formacion: '',
        nit_rut: '',
        digito_verificacion: '',
        password: '',
        password_confirmation: '',
        autorizacion_tratamiento_datos: false,
    })

    function handleSubmit() {
        if ($form.autorizacion_tratamiento_datos) {
            $form.post(route('register'))
        }
    }
</script>

<div class="flex mb-20">
    <figure class="w-full z-[-1]">
        <img class="fixed w-[850px] top-[80px]" src="/images/register-img.png" alt="" />
    </figure>
    <div class="bg-white px-28 py-10 shadow-xl">
        <h1 class="text-4xl mb-10">Registro</h1>
        <form on:submit|preventDefault={handleSubmit}>
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
                <Select id="tipo_usuario" items={tipos_usuarios} bind:selectedValue={$form.tipo_usuario} error={errors.tipo_usuario} placeholder="Seleccione un tipo de usuario" required />
            </div>

            <div class="grid gap-4 grid-cols-2">
                <div class="mb-10">
                    <Label required class="mb-5" labelFor="empresa_centro_formacion" value="Nombre de la empresa / entidad / centro de formación" />
                    <Input id="empresa_centro_formacion" type="text" bind:value={$form.empresa_centro_formacion} error={errors.empresa_centro_formacion} required />
                </div>

                <div class="mb-10 grid gap-2 grid-cols-2">
                    <div>
                        <Label required class="mb-10" labelFor="nit_rut" value="NIT / RUT" />
                        <Input id="nit_rut" type="number" input$min="0" input$max="9223372036854775807" bind:value={$form.nit_rut} error={errors.nit_rut} required />
                    </div>

                    <div>
                        <Label required class="mb-10" labelFor="digito_verificacion" value="Dígito de verificación" />
                        <Input id="digito_verificacion" type="number" input$min="0" input$max="9" bind:value={$form.digito_verificacion} error={errors.digito_verificacion} required />
                    </div>
                </div>
            </div>

            <div class="mb-10">
                <Label required class="mb-5" labelFor="password" value={$_('Password')} />
                <Input id="password" type="password" bind:value={$form.password} error={errors.password} required autocomplete="new-password" />
            </div>

            <div class="mb-10">
                <Label required class="mb-5" labelFor="password_confirmation" value={$_('Confirm Password')} />
                <Input id="password_confirmation" type="password" bind:value={$form.password_confirmation} error={errors.password_confirmation} required autocomplete="new-password" />
            </div>

            <hr class="mt-4" />

            <div class="block mt-4">
                <InfoMessage message="Los datos proporcionados serán tratados de acuerdo con la política de tratamiento de datos personales del SENA y a la ley 1581 de 2012 (Acuerdo No. 0009 del 2016)" class="mb-4" />
                <FormField>
                    <Checkbox bind:checked={$form.autorizacion_tratamiento_datos} />
                    <span slot="label">Autorizo el tratamiento de mis datos personales. <a href="https://www.sena.edu.co/es-co/transparencia/Documents/proteccion_datos_personales_sena_2016.pdf" target="_blank" class="text-indigo-500">Leer acuerdo No. 0009 del 2016</a></span>
                </FormField>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button on:click={() => Inertia.visit(route('login'))} type="button" class="mr-4" variant="outlined">
                    {$_('Already registered?')}
                </Button>

                <LoadingButton bind:loading={sending} type="submit" bind:disabled={$form.autorizacion_tratamiento_datos}>Registarse</LoadingButton>
            </div>
        </form>
    </div>
</div>
