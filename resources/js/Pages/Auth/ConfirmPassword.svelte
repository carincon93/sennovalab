<script context="module">
    import GuestLayout from '@/Layouts/Guest'
    export const layout = GuestLayout
</script>

<script>
    import { useForm } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'

    import LoadingButton from '@/Shared/LoadingButton'
    import Input from '@/Shared/Input'

    export let errors

    let sending = false

    let form = useForm({
        password: '',
    })

    function handleSubmit() {
        $form.post(route('password.confirm'))
    }
</script>

<div class="mb-4 text-sm text-gray-600">
    {$_('This is a secure area of the application. Please confirm your password before continuing.')}
</div>

<form on:submit|preventDefault={handleSubmit}>
    <div>
        <Input label={$_('Password')} id="password" type="password" class="mt-1" bind:value={$form.password} error={errors.password} required autocomplete="current-password" />
    </div>

    <div class="flex justify-end mt-4">
        <LoadingButton bind:loading={sending} type="submit">Confirmar</LoadingButton>
    </div>
</form>
