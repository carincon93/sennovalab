<script context="module">
    import GuestLayout, { title } from '@/Layouts/Guest'
    export const layout = GuestLayout
</script>

<script>
    import { inertia, useForm } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'

    import Input from '@/Shared/Input'
    import LoadingButton from '@/Shared/LoadingButton'
    import Checkbox from '@smui/checkbox'
    import FormField from '@smui/form-field'
    import Password from '@/Shared/Password'

    export let status
    export let errors

    $title = 'Iniciar sesión'

    let canResetPassword
    let selection = []
    let sending = false

    let form = useForm({
        email: '',
        password: '',
        remember: false,
    })

    function handleSubmit() {
        $form.post(route('login'), {
            onStart: () => (sending = true),
            onFinish: () => (sending = false),
        })
    }
</script>

<svelte:head>
    <title>Ingresar - SGPS-SIPRO</title>
</svelte:head>

{#if status}
    <div class="mb-4 font-medium text-sm text-green-600">
        {status}
    </div>
{/if}

<form on:submit|preventDefault={handleSubmit}>
    <div>
        <Input label={$_('Email')} id="email" type="email" class="mt-1" bind:value={$form.email} error={errors.email} required autocomplete="email" />
    </div>

    <div class="mt-4">
        <Password id="password" class="mt-1 w-full" bind:value={$form.password} error={errors.password} required autocomplete="current-password" />
    </div>

    <div class="block mt-4">
        <FormField>
            <Checkbox bind:checked={$form.remember} value={selection} />
            <span slot="label" class="text-gray-500">{$_('Remember me')}</span>
        </FormField>
    </div>

    <div class="flex items-center justify-between mt-4">
        <a use:inertia href={route('password.request')} class="mr-4 underline text-sm text-gray-600 hover:text-gray-900">
            {$_('Forgot your password?')}
        </a>

        <LoadingButton bind:loading={sending} class="btn-indigo" type="submit">{$_('Login')}</LoadingButton>
    </div>
</form>

<p class="text-xs mt-6 text-gray-900">
    <a use:inertia href={route('register')} class="text-indigo-500 underline">No tengo cuenta. ¡Quiero registrarme!</a>
</p>
<p class="text-xs mt-6 text-gray-900">
    <a use:inertia href={route('registerTwo')} class="text-indigo-500 underline">¡Quiero registrarme! Externo</a>
</p>
