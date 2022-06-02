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
    export let nombre_entidad_plural

    /**
     * Título para la pestaña del navegador
     */
    $title = 'nombre_entidad_plural'

    /**
     * Validar si el usuario autenticado es SuperAdmin
     */
    // let authUser = $page.props.auth.user
    // let isSuperAdmin = checkRole(authUser, [1])

    let filters = {}
    let dialogOpen = false
    let nombre_entidad_singularId

    function destroy() {
        Inertia.delete(route('ruta.destroy', nombre_entidad_singularId), {
            onSuccess: () => (dialogOpen = false),
        })
    }
</script>

<AuthenticatedLayout>
    <DataTable>
        <div slot="title">nombre_entidad_plural</div>

        <div slot="actions">
            <Button on:click={() => Inertia.visit(route('ruta.create'))} variant="raised" class="bg-orange-500">Crear nombre_entidad_singular</Button>
        </div>

        <thead slot="thead">
            <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4 sticky top-0 z-10 bg-white shadow-xl w-full"> TH1 </th>
                <th class="px-6 pt-6 pb-4 sticky top-0 z-10 bg-white shadow-xl w-full"> TH2 </th>
                <th class="bg-white pb-4 pt-6 px-6 shadow-xl sticky text-center top-0 w-full z-10"> Acciones </th>
            </tr>
        </thead>
        <tbody slot="tbody">
            {#each nombre_entidad_plural.data as nombre_entidad_singular (nombre_entidad_singular.id)}
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <p class="px-6 py-4 focus:text-orange-500 first-letter-uppercase">
                            {nombre_entidad_singular.columna}
                        </p>
                    </td>
                    <td class="border-t">
                        <p class="px-6 py-4 focus:text-orange-500 first-letter-uppercase">
                            {nombre_entidad_singular.columna}
                        </p>
                    </td>

                    <td class="border-t td-actions">
                        <DataTableMenu class={nombre_entidad_plural.data.length < 4 ? 'z-50' : ''}>
                            <Item on:SMUI:action={() => Inertia.visit(route('ruta.show', nombre_entidad_singular.id))}>
                                <Text>Ver detalles</Text>
                            </Item>

                            <Item on:SMUI:action={() => Inertia.visit(route('ruta.edit', nombre_entidad_singular.id))}>
                                <Text>Editar</Text>
                            </Item>

                            <Item on:SMUI:action={() => ((nombre_entidad_singularId = nombre_entidad_singular.id), (dialogOpen = true))}>
                                <Text>Eliminar</Text>
                            </Item>
                        </DataTableMenu>
                    </td>
                </tr>
            {/each}

            {#if nombre_entidad_plural.data.length === 0}
                <tr>
                    <td class="border-t px-6 py-4" colspan="4"> Sin información registrada </td>
                </tr>
            {/if}
        </tbody>
    </DataTable>
    <Pagination links={nombre_entidad_plural.links} />

    <Dialog bind:open={dialogOpen}>
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
                <Button on:click={(event) => (dialogOpen = false)} variant={null}>Cancelar</Button>
                <Button variant="raised" on:click={destroy}>Confirmar</Button>
            </div>
        </div>
    </Dialog>
</AuthenticatedLayout>
