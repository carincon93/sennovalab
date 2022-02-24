<script>
    import Button, { Label } from '@smui/button'

    export let variant = 'raised'
    export let href

    $: props = {
        ...$$restProps,
        class: `${$$restProps.class || ''}`,
    }
</script>

<Button {...props} {href} {variant} height="100px" action={null} on:click>
    <Label>
        <slot />
    </Label>
</Button>

<style>
    :global(.mdc-button) {
        height: auto;
        min-height: 36px;
    }
</style>
