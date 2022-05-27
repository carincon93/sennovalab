<script>
    import AuthenticatedLayout, { title } from '@/Layouts/Authenticated'
    import { inertia, page } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'

    import Button from '@/Shared/Button'

    $title = 'Panel de control'

    let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])
</script>

<svelte:head>
    <style>
        .btn-perfil.mdc-button {
            height: 34px;
        }
    </style>
</svelte:head>

<AuthenticatedLayout>
    <span class="uppercase font-black mb-4 inline-block">Dashboard</span>

    <div class="grid gap-4 grid-cols-3">
        <div class="bg-white shadow-md rounded">
            <div class="bg-orange-200 h-24 flex justify-between">
                <div class="p-6">
                    <h1 class="font-black text-orange-600">¡Bienvenido(a) de nuevo!</h1>
                    <span class="text-orange-500">SENNOVALAB Dashboard</span>
                </div>
                <figure>
                    <img src="/images/profile-img.png" alt="" class="h-full" />
                </figure>
            </div>
            <div class="p-6 flex justify-between">
                <div>
                    <span class="font-black">John Doe</span>
                    <span class="block">Investigador experto</span>
                </div>

                <Button type="button" class="btn-perfil">Ver perfil</Button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded">
            <div class="h-24 flex justify-between">
                <div class="p-6">
                    <h1 class="font-black text-2xl text-gray-600">Usuarios</h1>
                </div>
                <figure />
            </div>
            <div class="p-6 flex justify-between">
                <div>
                    <span class="block">Número de usuarios registrados: 45</span>
                </div>

                <Button type="button" class="btn-perfil" variant="outlined">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </Button>
            </div>
        </div>
        <div class="bg-white shadow-md rounded">
            <div class="h-24 flex justify-between">
                <div class="p-6">
                    <h1 class="font-black text-2xl text-gray-600">Ideas</h1>
                </div>
                <figure />
            </div>
            <div class="p-6 flex justify-between">
                <div>
                    <span class="block">Número de ideas registradas: 45</span>
                </div>

                <Button type="button" class="btn-perfil" variant="outlined">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </Button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4 mt-8">
        <div>
            <div class="bg-white shadow-md rounded">
                <div class="h-24 flex justify-between">
                    <div class="p-6">
                        <h1 class="font-black text-2xl text-gray-600">Servicios</h1>
                    </div>
                    <figure />
                </div>
                <div class="p-6 flex justify-between">
                    <div>
                        <span class="block">Número de servicios registrados: 45</span>
                    </div>

                    <Button type="button" class="btn-perfil" variant="outlined">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </Button>
                </div>
            </div>

            <div class="bg-white shadow-md rounded mt-8">
                <div class="h-24 flex justify-between">
                    <div class="p-6">
                        <h1 class="font-black text-2xl text-gray-600">Evaluaciones</h1>
                    </div>
                    <figure />
                </div>
                <div class="p-6 flex justify-between">
                    <div>
                        <span class="block">Número de evaluaciones registradas: 45</span>
                    </div>

                    <Button type="button" class="btn-perfil" variant="outlined">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </Button>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-md rounded col-span-2">
            <div class="h-24 flex justify-between">
                <div class="p-6">
                    <h1 class="font-black text-2xl text-gray-600">Reportes</h1>
                </div>
                <figure />
            </div>
            <div class="p-6 flex justify-between">
                <table class="border-collapse table-fixed w-full text-sm">
                    <thead>
                        <tr>
                            <th class="border-b font-medium p-4 pt-0 pb-3 text-slate-400 text-left">Nombre</th>
                            <th class="border-b font-medium p-4 pt-0 pb-3 text-slate-400 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            <td class="border-b border-slate-100 p-4 text-slate-500">Servicios</td>
                            <td class="border-b border-slate-100 p-4 text-slate-500">Descargar</td>
                        </tr>
                        <tr>
                            <td class="border-b border-slate-100 p-4 text-slate-500">Ideas</td>
                            <td class="border-b border-slate-100 p-4 text-slate-500">Descargar</td>
                        </tr>
                        <tr>
                            <td class="border-b border-slate-100 p-4 text-slate-500">Usuarios externos</td>
                            <td class="border-b border-slate-100 p-4 text-slate-500">Descargar</td>
                        </tr>
                        <tr>
                            <td class="border-b border-slate-100 p-4 text-slate-500">Evaluaciones</td>
                            <td class="border-b border-slate-100 p-4 text-slate-500">Descargar</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
