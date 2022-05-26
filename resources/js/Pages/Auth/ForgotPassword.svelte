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

    export let status
    export let errors

    let sending = false

    let form = useForm({
        email: '',
    })

    function handleSubmit() {
        $form.post(route('password.email'))
    }
</script>

<div class="flex flex-col form-wrapper justify-center min-h-[85vh] w-full">
    <div class="w-[35%] mx-auto shadow p-10">
        <div class="mb-4 text-sm text-gray-600">
            {$_('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')}
        </div>

        {#if status}
            <div class="mb-4 font-medium text-sm text-green-600">
                {status}
            </div>
        {/if}

        <form on:submit|preventDefault={handleSubmit}>
            <div>
                <Input label={$_('Email')} id="email" type="email" class="mt-1" bind:value={$form.email} error={errors.email} name="email" required autocomplete="email" />
            </div>

            <LoadingButton bind:loading={sending} class="w-full mt-4" type="submit">{$_('Email Password Reset Link')}</LoadingButton>

            <Button on:click={() => Inertia.visit(route('login'))} type="button" class="w-full mt-4" variant="outlined">Regresar</Button>
        </form>
    </div>
</div>
