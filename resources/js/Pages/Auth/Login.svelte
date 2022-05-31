<script context="module">
    import GuestLayout, { title } from '@/Layouts/Guest'
    export const layout = GuestLayout
</script>

<script>
    import { inertia, useForm } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'
    import { Inertia } from '@inertiajs/inertia'

    import Input from '@/Shared/Input'
    import LoadingButton from '@/Shared/LoadingButton'
    import Button from '@/Shared/Button'
    import Label from '@/Shared/Label'
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

    <style>
        @media (min-width: 1024px) {
            .mdc-checkbox .mdc-checkbox__native-control:enabled:not(:checked):not(:indeterminate):not([data-indeterminate='true']) ~ .mdc-checkbox__background {
                border-color: white;
            }

            .mdc-button--outlined:not(:disabled) {
                border: none;
            }
        }
    </style>
</svelte:head>

{#if status}
    <div class="mb-4 font-medium text-sm text-green-600">
        {status}
    </div>
{/if}

<div class="lg:flex flex-col form-wrapper justify-center lg:min-h-[85vh] w-full p-8 lg:p-0">
    <div class="lg:w-[35%] mx-auto lg:ml-[10rem]">
        <form on:submit|preventDefault={handleSubmit}>
            <div>
                <Label required labelFor="email" value={$_('Email')} class="lg:text-white mb-4" />
                <Input id="email" type="email" bind:value={$form.email} error={errors.email} required autocomplete="email" />
            </div>

            <div class="mt-4">
                <Label required value={$_('Password')} labelFor="password" class="lg:text-white mb-4" />
                <Password id="password" class="mt-1 w-full" bind:value={$form.password} error={errors.password} required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <FormField>
                    <Checkbox bind:checked={$form.remember} class="login-checkbox" value={selection} />
                    <span slot="label" class="lg:text-white">{$_('Remember me')}</span>
                </FormField>
            </div>

            <a use:inertia href={route('password.request')} class="my-10 text-center lg:text-white hover:opacity-80 block">
                {$_('Forgot your password?')}
            </a>

            <div class="flex flex-col mt-4">
                <LoadingButton bind:loading={sending} class="mb-8" type="submit">{$_('Login')}</LoadingButton>
                <Button on:click={() => Inertia.visit(route('register'))} type="button" variant="outlined">No tengo cuenta. ¡Quiero registrarme!</Button>
            </div>
        </form>
    </div>
</div>

<style>
    @media (min-width: 1024px) {
        .form-wrapper {
            background: url(/images/fondo-login.png) center center no-repeat;
            background-size: cover;
        }
    }
</style>
