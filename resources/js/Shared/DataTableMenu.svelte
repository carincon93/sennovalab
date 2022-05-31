<script>
    import { _ } from 'svelte-i18n'
    import Menu from '@smui/menu'
    import List from '@smui/list'
    import Button from '@smui/button'

    let menu

    $: props = {
        ...$$restProps,
        class: `${$$restProps.class || ''}`,
    }
</script>

<div {...props} class="relative m-auto w-[64px] h-[36px]">
    <Button on:click={() => menu.setOpen(true)}>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
        </svg>
    </Button>
    <Menu bind:this={menu}>
        <List>
            <slot />
        </List>
    </Menu>
</div>
