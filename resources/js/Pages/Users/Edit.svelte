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
    export let user

    let tipos_documento = [
        { value: 'Cédula de ciudadanía', label: 'Cédula de ciudadanía' },
        { value: 'Cédula de extranjería', label: 'Cédula de extranjería' },
    ]

    let tipos_afiliacion = [
        { value: 'Personal planta', label: 'Personal planta' },
        { value: 'Contratista', label: 'Contratista' },
    ]

    let roles_sennovalab = [{ value: 1, label: 'Líder de laboratorio' }]

    /**
     * Título para la pestaña del navegador
     */
    $: $title = 'Editar ' + user.primer_nombre

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let sending = false
    let form = useForm({
        primer_nombre: user.primer_nombre,
        segundo_nombre: user.segundo_nombre,
        primer_apellido: user.primer_apellido,
        segundo_apellido: user.segundo_apellido,
        email: user.email,
        password: user.password,
        tipo_documento: {
            value: user.tipo_documento,
            label: tipos_documento.find((item) => item.value == user.tipo_documento)?.label,
        },
        numero_documento: user.numero_documento,
        celular: user.celular,
        telefono: user.telefono,
        extension: user.extension,
        autorizacion_datos: user.autorizacion_datos,

        numero_contrato: '',
        fecha_inicio_contrato: '',
        fecha_finalizacion_contrato: '',
        rol_sennovalab: null,
        firma_digital: '',
    })

    function submit() {
        $form.put(route('users.update', user.id), {
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
            <Form {errors} {submit} {tipos_documento} {tipos_afiliacion} {roles_sennovalab} method="put" {sending} {form} />
        </div>
    </div>
</AuthenticatedLayout>
