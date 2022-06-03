<script>
    import AuthenticatedLayout, { title } from '@/Layouts/Authenticated'
    import { page } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'
    import { Inertia } from '@inertiajs/inertia'

    import Button from '@/Shared/Button'
    import Pagination from '@/Shared/Pagination'
    import DataTable from '@/Shared/DataTable'
    import DataTableMenu from '@/Shared/DataTableMenu'
    import Dialog from '@/Shared/Dialog'
    import { Item, Text } from '@smui/list'

    /**
     * Datos que llegan desde el controlador - backend
     */
    export let users

    /**
     * Título para la pestaña del navegador
     */
    $title = 'Usuarios'

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let filters = {}
    let dialogDeleteOpen = false
    let dialogUserOpen = false
    let userId

    function destroy() {
        Inertia.delete(route('users.destroy', userId), {
            onSuccess: () => (dialogDeleteOpen = false),
        })
    }
</script>

<AuthenticatedLayout>
    <DataTable>
        <div slot="title">Usuarios</div>

        <div slot="actions">
            <Button on:click={() => (dialogUserOpen = true)} variant="raised" type="button" class="bg-orange-500">Crear usuario</Button>
        </div>

        <thead slot="thead">
            <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4 sticky top-0 z-10 bg-white shadow-xl w-full"> Nombre </th>
                <th class="px-6 pt-6 pb-4 sticky top-0 z-10 bg-white shadow-xl w-full"> Correo electrónico </th>
                <th class="px-6 pt-6 pb-4 sticky top-0 z-10 bg-white shadow-xl w-full"> Celular / Teléfono </th>
                <th class="px-6 pt-6 pb-4 sticky top-0 z-10 bg-white shadow-xl w-full"> Tipo de usuario </th>
                <th class="bg-white pb-4 pt-6 px-6 shadow-xl sticky text-center top-0 w-full z-10"> Acciones </th>
            </tr>
        </thead>
        <tbody slot="tbody">
            {#each users.data as user (user.id)}
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <p class="px-6 py-4 focus:text-orange-500 first-letter-uppercase">
                            {user.primer_nombre}
                        </p>
                    </td>
                    <td class="border-t">
                        <p class="px-6 py-4 focus:text-orange-500 first-letter-uppercase">
                            {user.email}
                        </p>
                    </td>
                    <td class="border-t">
                        <p class="px-6 py-4 focus:text-orange-500 first-letter-uppercase">
                            {user.celular}/{user.telefono}
                        </p>
                    </td>

                    <td class="border-t">
                        <p class="px-6 py-4 focus:text-orange-500 first-letter-uppercase">
                            {user.user_interno ? 'Interno' : user.user_externo ? 'Externo' : 'Sin tipo de usuario asignado'}
                        </p>
                    </td>

                    <td class="border-t td-actions">
                        <DataTableMenu class={users.data.length < 4 ? 'z-50' : ''}>
                            {#if user.user_interno}
                                <Item on:SMUI:action={() => Inertia.visit(route('users-internos.show', user.user_interno.id))}>
                                    <Text>Ver detalles</Text>
                                </Item>

                                <Item on:SMUI:action={() => Inertia.visit(route('users-internos.edit', user.user_interno.id))}>
                                    <Text>Editar</Text>
                                </Item>
                            {:else if user.user_externo}
                                <Item on:SMUI:action={() => Inertia.visit(route('users-externos.show', user.user_externo.id))}>
                                    <Text>Ver detalles</Text>
                                </Item>

                                <Item on:SMUI:action={() => Inertia.visit(route('users-externos.edit', user.user_externo.id))}>
                                    <Text>Editar</Text>
                                </Item>
                            {/if}

                            <Item on:SMUI:action={() => ((userId = user.id), (dialogDeleteOpen = true))}>
                                <Text>Eliminar</Text>
                            </Item>
                        </DataTableMenu>
                    </td>
                </tr>
            {/each}

            {#if users.data.length === 0}
                <tr>
                    <td class="border-t px-6 py-4" colspan="4"> Sin información registrada </td>
                </tr>
            {/if}
        </tbody>
    </DataTable>
    <Pagination links={users.links} />

    <Dialog bind:open={dialogUserOpen}>
        <div slot="title" class="flex items-center text-center">Seleccione el tipo de usuario que desea registrar</div>
        <div slot="content">
            <figure>
                <img src="/images/users-module.png" class="m-auto" alt="" />
            </figure>
        </div>
        <div slot="actions" class="w-full">
            <div class="p-4 flex justify-center items-center">
                <Button variant="raised" on:click={() => Inertia.visit(route('users-internos.create'))}>Usuario interno</Button>
                <Button variant="raised" on:click={() => Inertia.visit(route('users-externos.create'))}>Usuario externo</Button>
            </div>
            <div class="flex item justify-center">
                <Button on:click={(event) => (dialogUserOpen = false)} variant={null}>Cancelar</Button>
            </div>
        </div>
    </Dialog>

    <Dialog bind:open={dialogDeleteOpen}>
        <div slot="title" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            Eliminar recurso
        </div>
        <div slot="content">
            <p>
                ¿Está seguro(a) que desea eliminar este recurso?
                <br />
                Todos los datos se eliminarán de forma permanente.
                <br />
                Está acción no se puede deshacer.
            </p>
        </div>
        <div slot="actions">
            <div class="p-4">
                <Button on:click={(event) => (dialogDeleteOpen = false)} variant={null}>Cancelar</Button>
                <Button variant="raised" on:click={destroy}>Confirmar</Button>
            </div>
        </div>
    </Dialog>
</AuthenticatedLayout>
