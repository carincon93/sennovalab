<script>
    export let group
    export let value
    export let checked
    export let id

    $: updateChekbox(group)
    $: updateGroup(checked)

    function updateChekbox(group) {
        checked = group.indexOf(value) >= 0
    }

    function updateGroup(checked) {
        const index = group.indexOf(value)
        if (checked) {
            if (index < 0) {
                group.push(value)
                group = group
            }
        } else {
            if (index >= 0) {
                group.splice(index, 1)
                group = group
            }
        }
    }
</script>

<input type="checkbox" {id} bind:checked {value} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-200" />
