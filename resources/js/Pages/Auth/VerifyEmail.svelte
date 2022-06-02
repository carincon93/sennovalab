<script context="module">
    import GuestLayout from '@/Layouts/Guest'
    export const layout = GuestLayout
</script>

<script>
    import { Inertia } from '@inertiajs/inertia'
    import { inertia } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'
    import LoadingButton from '@/Shared/LoadingButton'

    export let status

    let sending = false

    function handleSubmit() {
        Inertia.post(route('verification.send'))
    }

    function verificationLinkSent() {
        return status === 'verification-link-sent'
    }
</script>

<div class="mb-4 text-sm text-gray-600">
    {$_("Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.")}
</div>

{#if verificationLinkSent}
    <div class="mb-4 font-medium text-sm text-green-600">
        {$_('A new verification link has been sent to the email address you provided during registration.')}
    </div>
{/if}

<form on:submit|preventDefault={handleSubmit}>
    <div class="mt-4 flex items-center justify-between">
        <LoadingButton bind:loading={sending} type="submit">{$_('Resend Verification Email')}</LoadingButton>

        <a use:inertia href={route('logout')} method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Salir</a>
    </div>
</form>
