<script context="module">
    import GuestLayout from '@/Layouts/Guest'
    export const layout = GuestLayout
</script>

<script>
    import { useForm } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'
    import { Inertia } from '@inertiajs/inertia'

    import LoadingButton from '@/Shared/LoadingButton'
    import Button from '@/Shared/Button'
    import Input from '@/Shared/Input'

    export let email
    export let token
    export let errors

    let sending = false

    let form = useForm({
        token: token,
        email: email,
        password: '',
        password_confirmation: '',
    })

    function handleSubmit() {
        $form.post(route('password.update'))
    }
</script>

<div class="flex flex-col form-wrapper justify-center min-h-[85vh] w-full">
    <div class="w-[35%] mx-auto shadow p-10">
        <form on:submit|preventDefault={handleSubmit}>
            <div>
                <Input label={$_('Email')} id="email" type="email" class="mt-1" bind:value={$form.email} name="email" error={errors.email} required autocomplete="email" />
            </div>

            <div class="mt-4">
                <Input label={$_('Password')} id="password" type="password" class="mt-1" bind:value={$form.password} name="password" error={errors.password} required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <Input label={$_('Confirm Password')} id="password_confirmation" type="password" class="mt-1" bind:value={$form.password_confirmation} name="password_confirmation" error={errors.password_confirmation} required autocomplete="new-password" />
            </div>

            <LoadingButton bind:loading={sending} class="w-full mt-4" type="submit">{$_('Reset Password')}</LoadingButton>

            <Button on:click={() => Inertia.visit(route('login'))} type="button" class="w-full mt-4" variant="outlined">Regresar</Button>
        </form>
    </div>
</div>
