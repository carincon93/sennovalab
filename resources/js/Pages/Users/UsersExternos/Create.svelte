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

    let tipos_documento = [
        { value: 'cc', label: 'Cédula de ciudadanía' },
        { value: 'ce', label: 'Cédula de extranjería' },
    ]

    let tipos_usuario = [
        { value: 'Persona natural', label: 'Persona natural' },
        { value: 'Persona jurídica', label: 'Persona jurídica' },
    ]

    let estados = [
        { value: 1, label: 'Activo' },
        { value: 2, label: 'Inactivo' },
    ]

    /**
     * Título para la pestaña del navegador
     */
    $: $title = 'Crear usuario'

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let sending = false
    let form = useForm({
        primer_nombre: '',
        segundo_nombre: '',
        primer_apellido: '',
        segundo_apellido: '',
        email: '',
        password: '',
        tipo_documento: '',
        numero_documento: '',
        celular: '',
        telefono: '',
        extension: '',
        estado: '',
        autorizacion_tratamiento_datos: false,

        tipo_usuario: '',
        empresa_centro_formacion: '',
        nit_rut: '',
        digito_verificacion: '',
    })

    function submit() {
        $form.post(route('users-externos.store'), {
            onStart: () => (sending = true),
            onFinish: () => (sending = false),
        })
    }
</script>

<AuthenticatedLayout>
    <header slot="header">
        <div class="flex items-center justify-between max-w-7xl mx-auto py-6">
            <div>
                <h1>
                    <a use:inertia href={route('users.index')} class="text-orange-500 hover:text-orange-600"> Usuarios </a>
                    <span class="text-orange-500 font-medium">/</span>
                    Crear
                </h1>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-1 pl-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información del usuario</h3>
            <p class="mt-1 text-sm text-gray-600">Ingrese la siguiente información para crear un nuevo usuario.</p>
        </div>
        <div class="col-span-2">
            <Form {errors} {submit} {tipos_documento} {tipos_usuario} {estados} {sending} {form} />
        </div>
    </div>
</AuthenticatedLayout>
