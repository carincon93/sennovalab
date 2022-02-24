<script>
    import { page } from '@inertiajs/inertia-svelte'
    import { _ } from 'svelte-i18n'
    import { fly } from 'svelte/transition'
    import { quintOut } from 'svelte/easing'

    let showSuccessMessage = false
    let showErrorMessage = false

    $: successMessage = $page.props.flash.success
    $: errorMessage = $page.props.flash.error
    $: errors = $page.props.errors

    $: if (successMessage) {
        showSuccessMessage = true

        setTimeout(() => {
            showSuccessMessage = false
            successMessage = ''
        }, 10000)
    }

    $: if (errorMessage) {
        showErrorMessage = true

        setTimeout(() => {
            showErrorMessage = false
            errorMessage = ''
        }, 10000)
    }

    $: if (Object.keys(errors).length > 0) {
        showErrorMessage = true

        setTimeout(() => {
            showErrorMessage = false
            errors = {}
        }, 10000)
    }

    $: console.log($page.props.errors)
</script>

{#if showSuccessMessage && successMessage}
    <div
        class="mb-8 flex items-center justify-between bg-green-500 rounded max-w-md fixed -bottom-0 z-index-full"
        transition:fly={{
            delay: 250,
            duration: 300,
            x: 100,
            y: 700,
            opacity: 0.5,
            easing: quintOut,
        }}
    >
        <div class="flex items-center">
            <svg class="ml-4 mr-2 flex-shrink-0 w-4 h-4 fill-white" viewBox="0 0 20 20">
                <polygon points="0 11 2 9 7 14 18 3 20 5 7 18" />
            </svg>
            <div class="p-4 text-white text-sm font-medium">
                {successMessage}
            </div>
        </div>
    </div>
{/if}

{#if (showErrorMessage && errorMessage) || (Object.keys(errors).length > 0 && showErrorMessage)}
    <div
        class="mb-8 flex items-center justify-between bg-red-500 rounded max-w-3xl fixed -bottom-0 z-index-full"
        transition:fly={{
            delay: 250,
            duration: 300,
            x: 100,
            y: 700,
            opacity: 0.5,
            easing: quintOut,
        }}
    >
        <div class="flex items-center">
            <svg class="ml-4 mr-2 flex-shrink-0 w-4 h-4 fill-white" viewBox="0 0 20 20">
                <path
                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66
                4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83
                2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"
                />
            </svg>
            {#if errorMessage}
                <div class="p-4 text-white text-sm font-medium">
                    {errorMessage}
                </div>
            {:else}
                <div class="p-4 text-white text-sm font-medium">
                    {#if Object.keys(errors).length === 1}
                        <span>Hay un error en el formulario.</span>
                    {:else}
                        <span>
                            Hay {Object.keys(errors).length} errores en el formulario.
                        </span>
                    {/if}
                </div>
            {/if}
        </div>
    </div>
{/if}

<style>
    .z-index-full {
        z-index: 99999;
    }
</style>
