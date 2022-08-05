<script>
    import AuthenticatedLayout, { title } from '@/Layouts/Authenticated'
    import { inertia, page } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'

    /**
     * Datos que llegan desde el controlador - backend
     */
    export let tipo_servicio

    /**
     * Título para la pestaña del navegador
     */
    $: $title = 'Detalles del tipo de servicio'

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])
</script>

<AuthenticatedLayout>
    <h1 class="mt-10 text-3xl font-medium text-center">{tipo_servicio.nombre}</h1>
    <div class="grid grid-cols-3 gap-6 mt-20">
        <div class="col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información del tipo de servicio</h3>
            <p class="mt-1 text-sm text-gray-600">Revise la información del tipo de servicio.</p>
            <a use:inertia href={route('tipos-servicios.edit', tipo_servicio.id)} class="text-sm underline text-orange-500">Editar la información</a>
        </div>
        <div class="bg-white rounded shadow col-span-2 p-8 divide-y">
            <div class="py-8">
                <p class="font-medium">Nombre</p>
                <p>{tipo_servicio.nombre}</p>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-6 mt-20">
            <div class="col-span-1 mt-1 text-sm font-medium text-center">
                <h1>
                    <a use:inertia href={route('tipos-servicios.index')} class="text-orange-500 hover:text-orange-600"> Volver</a>
                </h1>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
