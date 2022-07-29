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
    export let linea_Desarrollo
    //console.table(linea_Desarrollo)

    /**
     * Título para la pestaña del navegador
     */
    $: $title = 'Editar ' + linea_Desarrollo.nombre
    //primer_nombre: user_externo.user.primer_nombre,
    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let nombre_linea
    let sending = false
    let form = useForm({
        nombre_linea: linea_Desarrollo.nombre,
        id_linea: linea_Desarrollo.id,
    })

    function submit() {
        $form.put(route('lineas-investigacion.update', linea_Desarrollo.id), {
            onStart: () => (sending = true),
            onFinish: () => (sending = false),
            preserveScroll: true,
        })
    }
</script>

<AuthenticatedLayout>
    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información del usuario</h3>
            <p class="mt-1 text-sm text-gray-600">Ingrese nueva información para editar el usuario.</p>
        </div>
        <div class="col-span-2">
            <Form {errors} {submit} {nombre_linea} method="put" {sending} {form} />
        </div>
    </div>
</AuthenticatedLayout>
