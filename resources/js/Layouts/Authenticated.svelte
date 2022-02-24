<script context="module">
    import { writable } from 'svelte/store'
    export const title = writable(null)
    export const permissions = writable(null)
</script>

<script>
    import { Inertia } from '@inertiajs/inertia'
    import { inertia, page } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'

    import ApplicationLogo from '@/Shared/ApplicationLogo'
    import Dropdown from '@/Shared/Dropdown'
    import Icon from '@/Shared/Icon'
    import ResponsiveNavLink from '@/Shared/ResponsiveNavLink'
    import FlashMessages from '@/Shared/FlashMessages'
    import Loading from '@/Shared/Loading'

    let showingNavigationDropdown = false

    let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let loading = true
    Inertia.on('start', () => {
        loading = false
    })
    Inertia.on('finish', () => {
        loading = true
    })
</script>

<svelte:head>
    <title>{$title ? `${$title} - SENNOVALAB` : 'SENNOVALAB'}</title>
</svelte:head>

<div>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a use:inertia href={route('dashboard')}>
                                <ApplicationLogo class="w-20" />
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex sm:items-center">
                            <!-- <Button on:click={() => (dialogOpen = true)} variant={null}>Menú de navegación</Button> -->
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- <div class="bg-indigo-500 text-white py-2 px-4 shadow border-b-2 flex" /> -->

                        <!-- Settings Dropdown -->
                        <div class="mr-5 ml-5 relative">
                            <a href="#" class="flex items-center hover:text-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                {#if $page.props.auth.numeroNotificaciones > 0}
                                    <span class="absolute bg-indigo-700 flex h-5/6 items-center justify-center rounded-full text-center text-white text-xs w-5/6" style="top: -10px; left: 10px;">{$page.props.auth.numeroNotificaciones}</span>
                                {/if}
                            </a>
                        </div>
                        <div class="ml-3 relative">
                            <Dropdown class="mt-1" placement="bottom-end">
                                <div class="flex items-center cursor-pointer select-none group">
                                    <div class="text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600 mr-1 whitespace-no-wrap">
                                        <span class="capitalize">{authUser.name}</span>
                                    </div>
                                    <Icon name="cheveron-down" class="w-5 h-5 group-hover:fill-indigo-600 fill-gray-700 focus:fill-indigo-600" />
                                </div>
                                <div slot="dropdown" class="mt-2 py-2 shadow-xl bg-white rounded text-sm">
                                    <!-- <a use:inertia href={route('users.change-password')} class="flex items-center px-6 py-2 hover:bg-indigo-500 hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="flex-basis: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        <span class="ml-1.5">Cambiar contraseña</span>
                                    </a> -->

                                    <a use:inertia={{ method: 'post' }} href={route('logout')} class="flex items-center px-6 py-2 hover:bg-indigo-500 hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1.5">{$_('Logout')}</span>
                                    </a>
                                </div>
                            </Dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <!-- <div class="-mr-2 flex items-center sm:hidden">
                        <button on:click={showingNavigationDropdown = ! showingNavigationDropdown} class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path class="{showingNavigationDropdown ? 'hidden': '', ! showingNavigationDropdown ? 'inline-flex': ''}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path class="{! showingNavigationDropdown ? 'hidden': '', showingNavigationDropdown ? 'inline-flex': ''}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div> -->
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div class="sm:hidden{(showingNavigationDropdown ? ' block' : '', !showingNavigationDropdown ? ' hidden' : '')}">
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink href={route('dashboard')} active={route().current('dashboard')}>Menú de navegación</ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="font-medium text-base text-gray-800">
                            {authUser.name}
                        </div>
                        <div class="font-medium text-sm text-gray-500">
                            {authUser.email}
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink href={route('logout')} method="post" as="button">
                            {$_('Logout')}
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        {#if $$slots.header}
            <slot name="header" />
        {/if}

        <!-- Page Content -->
        <main class="lg:px-8 max-w-7xl md:p-12 mx-auto px-4 py-8 sm:px-6">
            <FlashMessages />
            <Loading {loading} />
            <slot />
        </main>
    </div>
</div>
