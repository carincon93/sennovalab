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

    /**
     * Título para la pestaña del navegador
     */
    $: $title = 'Crear Linea'

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let nombre_linea
    let sending = false
    let form = useForm({
        nombre_linea: '',
    })

    function submit() {
        $form.post(route('lineas-investigacion.store'), {
            onStart: () => (sending = true),
            onFinish: () => (sending = false),
        })
    }
</script>

<AuthenticatedLayout>
    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-1 pl-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información de la Linea de desarrollo</h3>
            <p class="mt-1 text-sm text-gray-600">Ingrese la siguiente información para crear una Linea de desarrollo.</p>
        </div>
        <div class="col-span-2">
            <Form {errors} {submit} {nombre_linea} {sending} {form} />
        </div>
    </div>
</AuthenticatedLayout>
