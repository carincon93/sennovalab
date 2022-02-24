<script>
    import Dialog, { Title, Content, Actions } from '@smui/dialog'

    export let open = false
    export let id
</script>

<Dialog bind:open scrimClickAction="" escapeKeyAction="" aria-labelledby="mandatory-title" aria-describedby="mandatory-content" id="{id}-dialog">
    <Title id="{id}-mandatory-title">
        <slot name="title" />
    </Title>
    <Content id="{id}-mandatory-content">
        <slot name="content" />
    </Content>
    <Actions>
        <slot name="actions" />
    </Actions>
</Dialog>
