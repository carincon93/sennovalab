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
    import InfoMessage from '@/Shared/InfoMessage'
    import Checkbox from '@smui/checkbox'
    import FormField from '@smui/form-field'

    export let errors

    let sending = false

    let form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        autorizacion_datos: false,
        role_id: [],
    })

    function handleSubmit() {
        if ($form.autorizacion_datos) {
            $form.post(route('register'))
        }
    }
</script>

<form on:submit|preventDefault={handleSubmit}>
    <div>
        <Input label="Nombre completo" id="name" type="text" class="mt-1" bind:value={$form.name} error={errors.name} required autocomplete="name" />
    </div>

    <div class="mt-4">
        <Input label="Correo electrónico institucional" id="email" type="email" class="mt-1" bind:value={$form.email} error={errors.email} required autocomplete="username" />
    </div>

    <div class="mt-4">
        <Input label={$_('Password')} id="password" type="password" class="mt-1" bind:value={$form.password} error={errors.password} required autocomplete="new-password" />
    </div>

    <div class="mt-4">
        <Input label={$_('Confirm Password')} id="password_confirmation" type="password" class="mt-1" bind:value={$form.password_confirmation} error={errors.password_confirmation} required autocomplete="new-password" />
    </div>

    <hr class="mt-4" />

    <div class="block mt-4">
        <InfoMessage message="Los datos proporcionados serán tratados de acuerdo con la política de tratamiento de datos personales del SENA y a la ley 1581 de 2012 (Acuerdo No. 0009 del 2016)" class="mb-4" />
        <FormField>
            <Checkbox bind:checked={$form.autorizacion_datos} />
            <span slot="label">Autorizo el tratamiento de mis datos personales. <a href="https://www.sena.edu.co/es-co/transparencia/Documents/proteccion_datos_personales_sena_2016.pdf" target="_blank" class="text-indigo-500">Leer acuerdo No. 0009 del 2016</a></span>
        </FormField>
    </div>

    <div class="flex items-center justify-end mt-4">
        <a use:inertia href={route('login')} class="mr-4 underline text-sm text-gray-600 hover:text-gray-900">
            {$_('Already registered?')}
        </a>

        <LoadingButton bind:loading={sending} class="btn-indigo" type="submit" bind:disabled={$form.autorizacion_datos}>{$_('Register')}</LoadingButton>
    </div>
</form>
