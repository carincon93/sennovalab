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
    export let user_interno
    export let roles_sennovalab

    let tipos_documento = [
        { value: 'cc', label: 'Cédula de ciudadanía' },
        { value: 'ce', label: 'Cédula de extranjería' },
    ]

    let tipos_afiliacion = [
        { value: 'Personal planta', label: 'Personal planta' },
        { value: 'Contratista', label: 'Contratista' },
    ]

    let estados = [
        { value: 1, label: 'Activo' },
        { value: 2, label: 'Inactivo' },
    ]

    /**
     * Título para la pestaña del navegador
     */
    $: $title = 'Editar ' + user_interno.user.primer_nombre

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let sending = false
    let form = useForm({
        _method: 'put',
        primer_nombre: user_interno.user.primer_nombre,
        segundo_nombre: user_interno.user.segundo_nombre,
        primer_apellido: user_interno.user.primer_apellido,
        segundo_apellido: user_interno.user.segundo_apellido,
        email: user_interno.user.email,
        password: user_interno.user.password,
        tipo_documento: {
            value: user_interno.user.tipo_documento,
            label: tipos_documento.find((item) => item.value == user_interno.user.tipo_documento)?.label,
        },
        numero_documento: user_interno.user.numero_documento,
        celular: user_interno.user.celular,
        telefono: user_interno.user.telefono,
        extension: user_interno.user.extension,
        estado: {
            value: user_interno.user.estado,
            label: estados.find((item) => item.value == user_interno.user.estado)?.label,
        },
        autorizacion_tratamiento_datos: user_interno.user.autorizacion_tratamiento_datos,

        tipo_afiliacion: {
            value: user_interno.tipo_afiliacion,
            label: tipos_afiliacion.find((item) => item.value == user_interno.tipo_afiliacion)?.label,
        },
        numero_contrato: user_interno.numero_contrato,
        fecha_inicio_contrato: user_interno.fecha_inicio_contrato,
        fecha_finalizacion_contrato: user_interno.fecha_finalizacion_contrato,
        rol_id: {
            value: user_interno.user.rol_id,
            label: roles_sennovalab.find((item) => item.value == user_interno.user.rol_id)?.label,
        },
        firma_digital: '',
    })

    function submit() {
        $form.put(route('users-internos.update', user_interno.id), {
            onStart: () => (sending = true),
            onFinish: () => (sending = false),
            preserveScroll: true,
        })
    }

    $: if ($form.tipo_afiliacion?.value == 'Personal planta') {
        $form.numero_contrato = ''
        $form.fecha_inicio_contrato = ''
        $form.fecha_finalizacion_contrato = ''
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
            <Form {errors} {submit} {tipos_documento} {tipos_afiliacion} {estados} {roles_sennovalab} method="put" {sending} {form} />
        </div>
    </div>
</AuthenticatedLayout>
