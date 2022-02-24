<script>
    $: props = {
        ...$$restProps,
    }
</script>

<img src={window.basePath + '/images/logo.png'} {...props} alt="Logo" />
