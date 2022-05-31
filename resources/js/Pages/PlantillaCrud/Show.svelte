<script>
    import AuthenticatedLayout, { title } from '@/Layouts/Authenticated'
    import { inertia, page } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'

    export let nombre_entidad_singular

    $: $title = 'Detalles del nombre_entidad_singular'

    /**
     * Permisos
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])
</script>

<AuthenticatedLayout>
    <header slot="header">
        <div class="flex items-center justify-between max-w-7xl mx-auto py-6">
            <div>
                <h1>
                    <a use:inertia href={route('ruta.index')} class="text-orange-500 hover:text-orange-600"> nombre_entidad_plural </a>
                    <span class="text-orange-500 font-medium">/</span>
                    Ver detalles
                </h1>
            </div>
        </div>
    </header>

    <h1 class="mt-10 text-3xl font-medium text-center">{nombre_entidad_singular.columna}</h1>
    <div class="grid grid-cols-3 gap-6 mt-20">
        <div class="col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información del usuario</h3>
            <p class="mt-1 text-sm text-gray-600">Revise la información del usuario.</p>
            {#if isSuperAdmin || checkPermission(authUser, [17])}
                <a use:inertia href={route('ruta.edit', nombre_entidad_singular.id)} class="text-sm underline text-orange-500">Editar la información</a>
            {/if}
        </div>
        <div class="bg-white rounded shadow col-span-2 p-8 divide-y">
            <div class="py-8">
                <p class="font-medium">Título</p>
                <p>{nombre_entidad_singular.columna}</p>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
