<script>
    $: props = {
        ...$$restProps,
    }
</script>

<img src={window.basePath + '/images/logo.jpeg'} {...props} alt="Logo" />
