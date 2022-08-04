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
    export let servicio
    export let users_externos
    export let lineas_desarrollo
    export let categorias_linea_desarrollo
    export let tipos_servicios

    /**
     * Título para la pestaña del navegador
     */
    $: $title = 'Editar ' + servicio.codigo_servicio

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let sending = false
    let form = useForm({
        user_externo_id: {
            value: servicio.user_externo_id,
            label: users_externos.find((item) => item.value == servicio.user_externo_id)?.label,
        },

        linea_desarrollo_id: {
            value: servicio.linea_desarrollo_id,
            label: lineas_desarrollo.find((item) => item.value == servicio.linea_desarrollo_id)?.label,
        },
        categoria_linea_desarrollo_id: {
            value: servicio.categoria_linea_desarrollo_id,
            label: categorias_linea_desarrollo.find((item) => item.value == servicio.categoria_linea_desarrollo_id)?.label,
        },
        tipo_servicio_id: {
            value: servicio.tipo_servicio_id,
            label: tipos_servicios.find((item) => item.value == servicio.tipo_servicio_id)?.label,
        },
        descripcion_necesidad: servicio.descripcion_necesidad,
    })

    function submit() {
        $form.put(route('servicios.update', servicio.id), {
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
                    <a use:inertia href={route('servicios.index')} class="text-orange-500 hover:text-orange-600">Servicios</a>
                    <span class="text-orange-500 font-medium">/</span>
                    Editar
                </h1>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-3 gap-6 mt-20">
        <div class="col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información del servicio</h3>
            <p class="mt-1 text-sm text-gray-600">Ingrese nueva información para editar el servicio.</p>
        </div>
        <div class="bg-white rounded shadow col-span-2">
            <Form {errors} {submit} {users_externos} {lineas_desarrollo} {categorias_linea_desarrollo} {tipos_servicios} method="put" {sending} {form} />
        </div>
    </div>
</AuthenticatedLayout>
