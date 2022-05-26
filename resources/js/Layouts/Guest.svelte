<script context="module">
    import { writable } from 'svelte/store'
    export const title = writable(null)
</script>

<script>
    import { inertia } from '@inertiajs/inertia-svelte'
    import { route } from '@/Utils'
    import ApplicationLogo from '@/Shared/ApplicationLogo'
    import FlashMessages from '@/Shared/FlashMessages'
</script>

<svelte:head>
    <title>{$title ? `${$title} - SGPS-SIPRO` : 'SGPS-SIPRO'}</title>
</svelte:head>

<div class="min-h-screen">
    <slot />
    <FlashMessages />

    <footer class="flex justify-center py-4 bg-white">
        <div class="flex">
            <img src="/images/sena-logo.png" alt="" />
            <img src="/images/grindda-logo.png" alt="" />
            <img src="/images/sennovalab-logo.png" alt="" />
        </div>
        <div class="pl-6 border-black border-l-2">
            <p class="text-center">SENA / Regional Caldas / Centro de Procesos Industriales y Construcción <br /> Kilómetro 10 Vía al Magdalena Bloque 3 –SENNOVALAB I+D+i – Ambiente de Servicios Tecnológicos <br /> PBX 8748444 Extensión 62441 - 62313 <br /> <a href="mailto:sennovalab@sena.edu.co">sennovalab@sena.edu.co</a></p>
        </div>
    </footer>
</div>
