<script context="module">
    import { writable } from 'svelte/store'
    export const title = writable(null)
</script>

<script>
    import { Inertia } from '@inertiajs/inertia'
    import { route } from '@/Utils'
    import Button from '@/Shared/Button'

    export let status

    $title = 'SENNOVALAB ' + status
</script>

<svelte:head>
    <title>SENNOVALAB {status}</title>
</svelte:head>

<div class="{status >= 500 || status == 403 ? 'bg-red-500' : 'bg-indigo-700'}  flex flex-col items-center justify-center min-h-screen text-white">
    <figure>
        {#if status >= 500 || status == 403}
            <img src="/images/error.png" alt="Error" class="w-2/3 m-auto mb-10" />
        {:else if status == 404}
            <img src="/images/error404.png" alt="Error" class="w-2/3 m-auto mb-10" />
        {/if}
    </figure>

    <div>
        {#if status == 403}
            <h1 class="text-2xl text-center">Está acción no está autorizada para su rol.</h1>
        {:else if status == 404}
            <h1 class="text-2xl text-center">La página que busca no existe.</h1>

            <div class="mt-20">
                <p>Posibles motivos por los que la página solicitada no se encuentra disponible:</p>
                <ul class="list-disc mt-5">
                    <li>Puede que haya cambiado de dirección (URL).</li>
                    <li>Es posible que está página no exista o no se haya escrito correctamente la URL, compruebe de nuevo y verifique que este bien escrita.</li>
                </ul>
            </div>
        {:else if status == 500}
            <h1 class="text-2xl text-center">Algo está mal en nuestros servidores. Por favor notifique este error a la mesa de ayuda.</h1>
        {:else if status == 503}
            <h1 class="text-2xl text-center">La aplicación está en mantenimiento. Por favor intenta de nuevo en unos minutos.</h1>
        {/if}

        {#if status != 503}
            <div class="mt-10">
                <p>Puede notificar a la mesa de ayuda realice los siguientes pasos:</p>
                <ul class="list-disc mt-5">
                    <li>Tome un pantallazo del error desde Windows o Mac.</li>
                    <li>Copie la URL.</li>
                    <li>Envie un correo detallando el error.</li>
                </ul>

                <div class="flex items-center mt-10">
                    <Button on:click={() => Inertia.visit(route('login'))} variant="raised" class=" ml-4" style="background-color: white !important; color: black !important;">Regresar a la aplicación</Button>
                </div>
            </div>
        {/if}
    </div>
</div>
