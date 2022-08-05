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
    export let user_externo
    console.table(user_externo)

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
    $: $title = 'Editar ' + user_externo.user.primer_nombre

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let sending = false
    let form = useForm({
        primer_nombre: user_externo.user.primer_nombre,
        segundo_nombre: user_externo.user.segundo_nombre,
        primer_apellido: user_externo.user.primer_apellido,
        segundo_apellido: user_externo.user.segundo_apellido,
        email: user_externo.user.email,
        password: user_externo.user.password,
        tipo_documento: {
            value: user_externo.user.tipo_documento,
            label: tipos_documento.find((item) => item.value == user_externo.user.tipo_documento)?.label,
        },
        numero_documento: user_externo.user.numero_documento,
        celular: user_externo.user.celular,
        telefono: user_externo.user.telefono,
        extension: user_externo.user.extension,
        estado: {
            value: user_externo.user.estado,
            label: estados.find((item) => item.value == user_externo.user.estado)?.label,
        },
        autorizacion_tratamiento_datos: user_externo.user.autorizacion_tratamiento_datos,

        tipo_usuario: {
            value: user_externo.tipo_usuario,
            label: tipos_usuario.find((item) => item.value == user_externo.tipo_usuario)?.label,
        },
        empresa_centro_formacion: user_externo.empresa_centro_formacion,
        nit_rut: user_externo.nit_rut,
        digito_verificacion: user_externo.digito_verificacion,
    })

    function submit() {
        $form.put(route('users-externos.update', user_externo.id), {
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
                    <a use:inertia href={route('users.index')} class="text-orange-500 hover:text-orange-600"> Usuarios </a>
                    <span class="text-orange-500 font-medium">/</span>
                    Editar
                </h1>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información del usuario</h3>
            <p class="mt-1 text-sm text-gray-600">Ingrese nueva información para editar el usuario.</p>
        </div>
        <div class="col-span-2">
            <Form {errors} {submit} {tipos_documento} {tipos_usuario} {estados} method="put" {sending} {form} />
        </div>
    </div>
</AuthenticatedLayout>
