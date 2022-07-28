<script>
    import AuthenticatedLayout, { title } from '@/Layouts/Authenticated'
    import { inertia, useForm, page } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'

    import Form from './Form'

    /**
     * Datos que llegan desde el controlador - backend
     */
    export let errors
    export let nombre_entidad_singular

    /**
     * Título para la pestaña del navegador
     */
    $: $title = 'Editar ' + nombre_entidad_singular.columna

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let sending = false
    let form = useForm({
        columna: nombre_entidad_singular.columna,
    })

    function submit() {
        $form.put(route('ruta.update', nombre_entidad_singular.id), {
            onStart: () => (sending = true),
            onFinish: () => (sending = false),
            preserveScroll: true,
        })
    }
</script>

<AuthenticatedLayout>
    <header slot="header">
        <div class="flex items-center justify-between max-w-7xl mx-auto py-6">
            <div>
                <h1>
                    <a use:inertia href={route('ruta.index')} class="text-orange-500 hover:text-orange-600"> Tipos de servicios </a>
                    <span class="text-orange-500 font-medium">/</span>
                    Editar
                </h1>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-3 gap-6 mt-20">
        <div class="col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información del tipo de servicio</h3>
            <p class="mt-1 text-sm text-gray-600">Ingrese la siguiente información para crear un nuevo tipo de servicio.</p>
        </div>
        <div class="bg-white rounded shadow col-span-2">
            <Form {errors} {submit} method="put" {sending} {form} />
        </div>
    </div>
</AuthenticatedLayout>
