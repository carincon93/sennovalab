<script>
    import AuthenticatedLayout, { title } from '@/Layouts/Authenticated'
    import { useForm, page } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'

    import Form from './Form'

    /**
     * Datos que llegan desde el controlador - backend
     */
    export let errors
    export let linea_desarrollo

    /**
     * Título para la pestaña del navegador
     */
    $: $title = 'Editar ' + linea_desarrollo.nombre

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let form = useForm({
        nombre: linea_desarrollo.nombre,
    })

    function submit() {
        $form.put(route('lineas-desarrollo.update', linea_desarrollo.id), {
            preserveScroll: true,
        })
    }
</script>

<AuthenticatedLayout>
    <div class="grid grid-cols-3 gap-6 mt-20">
        <div class="col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información de la línea de desarrollo</h3>
            <p class="mt-1 text-sm text-gray-600">Ingrese nueva información para editar la línea de desarrollo.</p>
        </div>
        <div class="bg-white rounded shadow col-span-2">
            <Form {errors} {submit} method="put" {form} />
        </div>
    </div>
</AuthenticatedLayout>
