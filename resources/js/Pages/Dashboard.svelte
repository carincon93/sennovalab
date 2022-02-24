<script>
    import AuthenticatedLayout, { title } from '@/Layouts/Authenticated'
    import { inertia, page } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'

    $title = 'Panel de control'

    let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])
</script>

<AuthenticatedLayout>Dashboard</AuthenticatedLayout>
