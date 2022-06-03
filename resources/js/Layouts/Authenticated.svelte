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
    import { onMount } from 'svelte'

    import ApplicationLogo from '@/Shared/ApplicationLogo'
    import Dropdown from '@/Shared/Dropdown'
    import Icon from '@/Shared/Icon'
    import ResponsiveNavLink from '@/Shared/ResponsiveNavLink'
    import FlashMessages from '@/Shared/FlashMessages'
    import Loading from '@/Shared/Loading'

    let showingNavigationDropdown = true

    let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let loading = true
    Inertia.on('start', () => {
        loading = false
    })
    Inertia.on('finish', () => {
        loading = true
    })

    onMount(() => {
        // if (body.classList.contains('mdc-dialog-scroll-lock')) {
        body.classList.remove('mdc-dialog-scroll-lock')
        // }
    })

    let body = document.getElementById('body')
    function toggleMenu() {
        body.classList.toggle('vertical-collpsed')
        showingNavigationDropdown = !showingNavigationDropdown
    }
</script>

<svelte:head>
    <title>{$title ? `${$title} - SENNOVALAB` : 'SENNOVALAB'}</title>

    <style>
        .vertical-collpsed .main-content {
            margin-left: 70px;
        }

        .vertical-collpsed .navbar-brand-box {
            width: 70px !important;
        }

        .vertical-collpsed .vertical-menu {
            position: fixed;
            width: 70px !important;
            z-index: 5;
        }

        .vertical-collpsed .nav-menu-title,
        .vertical-collpsed .nav-option-title {
            display: none;
        }
    </style>
</svelte:head>

<div class="min-h-screen bg-gray-100">
    <header class="navbar-header flex justify-between items-center bg-white h-16 fixed left-0 top-0 right-0 z-50">
        <!-- Primary Navigation Menu -->

        <div class="flex">
            <div class="navbar-brand-box h-16">
                <!-- Logo -->
                <a use:inertia href={route('dashboard')}>
                    <ApplicationLogo bind:showingNavigationDropdown class="w-20 mx-auto h-full object-contain" />
                </a>
            </div>

            <!-- Hamburger -->
            <button on:click={() => toggleMenu()} class="p-5 hover:opacity-80">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div class="flex">
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
                            <span class="capitalize">{authUser.primer_nombre + ' ' + authUser.primer_apellido}</span>
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
    </header>

    <div class="vertical-menu p-5">
        <nav>
            <ul>
                <li class="uppercase text-gray-500 text-xs mb-6 nav-menu-title">Menu</li>
                <li>
                    <a use:inertia href={route('users.index')} class="flex items-center">
                        <div class="inline-block rounded-md border border-violet-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 11.2" class="w-5" style="margin: 4.02px 2px;">
                                <g id="a" />
                                <g id="b">
                                    <g id="c">
                                        <path d="M7,7c1.26,0,2.26-1.02,2.26-2.27s-1.02-2.27-2.26-2.27-2.26,1.02-2.26,2.27c-.02,1.26,1,2.27,2.26,2.27Z" style="fill:#a78bfa;" />
                                        <path d="M8.09,7.7h-2.18c-1.72,0-3.11,1.31-3.11,2.92,0,.32,.28,.58,.62,.58h7.16c.34,0,.62-.26,.62-.58,0-1.61-1.39-2.92-3.11-2.92Z" style="fill:#a78bfa;" />
                                        <circle cx="11.2" cy="1.75" r="1.75" style="fill:#c8bbff;" />
                                        <path d="M4.02,4.73c0-.12,.02-.23,.04-.35-.24-.13-.5-.18-.78-.18H1.93c-1.06,0-1.93,.91-1.93,2.04,0,.23,.17,.41,.39,.41H4.75c-.45-.52-.73-1.19-.73-1.93Z" style="fill:#a78bfa;" />
                                        <circle cx="2.8" cy="1.75" r="1.75" style="fill:#a78bfa;" />
                                        <path d="M12.07,4.2h-1.35c-.28,0-.54,.07-.78,.18,.01,.12,.03,.23,.03,.34,0,.74-.28,1.4-.73,1.93h4.37c.21,0,.39-.18,.39-.41,0-1.13-.86-2.04-1.93-2.04Z" style="fill:#c8bbff;" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="text-violet-200 ml-5 nav-option-title"> Usuarios </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Page Heading -->
    {#if $$slots.header}
        <slot name="header" />
    {/if}

    <!-- Page Content -->
    <main class="main-content">
        <FlashMessages />
        <Loading {loading} />
        <div class="page-content">
            <slot />
        </div>
    </main>
</div>

<style>
    .main-content {
        margin-left: 250px;
        overflow: hidden;
    }

    .navbar-brand-box {
        background: #2a3042;
        width: 250px;
    }

    .vertical-menu {
        width: 250px;
        z-index: 1001;
        background: #2a3042;
        bottom: 0;
        margin-top: 0;
        position: fixed;
        top: 64px;
        -webkit-box-shadow: 0 0.75rem 1.5rem rgb(18 38 63 / 3%);
        box-shadow: 0 0.75rem 1.5rem rgb(18 38 63 / 3%);
    }

    .navbar-header {
        padding: 0 calc(80px / 2) 0 0;
    }

    .page-content {
        padding: calc(70px + 24px) calc(24px / 2) 60px calc(24px / 2);
    }
</style>
