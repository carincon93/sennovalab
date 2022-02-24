<script>
    import Tagify from '@yaireo/tagify'

    import '@yaireo/tagify/dist/tagify.css'
    import InputError from '@/Shared/InputError'
    import { onMount } from 'svelte'

    export let error
    export let placeholder
    export let whitelist
    export let tags
    export let id
    export let enforceWhitelist = true

    let inputElm, tagify

    let selectedValues = null

    if (tags) {
        selectedValues = JSON.parse(tags)
            .map(function (item) {
                return item.value
            })
            .join(',')
    }

    onMount(() => {
        inputElm = document.getElementById(id)

        // initialize Tagify on the above input node reference
        if (inputElm) {
            tagify = new Tagify(inputElm, {
                enforceWhitelist: enforceWhitelist,

                // make an array from the initial input value
                whitelist: inputElm.value.trim().split(/\s*,\s*/),
            })

            // Chainable event listeners
            tagify.on('add', onAddTag).on('remove', onRemoveTag).on('input', onInput).on('edit', onTagEdit).on('dropdown:hide dropdown:show')
        }
    })

    var mockAjax = (function mockAjax() {
        var timeout
        return function (duration) {
            clearTimeout(timeout) // abort last request
            return new Promise(function (resolve, reject) {
                timeout = setTimeout(resolve, duration || 700, whitelist)
            })
        }
    })()

    // tag added callback
    function onAddTag(e) {
        tags = inputElm.value
    }

    // tag remvoed callback
    function onRemoveTag(e) {
        tags = inputElm.value
    }

    // on character(s) added/removed (user is typing/deleting)
    function onInput(e) {
        // console.log('onInput: ', e.detail)
        tagify.settings.whitelist.length = 0 // reset current whitelist
        tagify.loading(true).dropdown.hide.call(tagify) // show the loader animation

        // get new whitelist from a delayed mocked request (Promise)
        mockAjax().then(function (result) {
            // replace tagify "whitelist" array values with new values
            // and add back the ones already choses as Tags
            if (result != undefined) {
                tagify.settings.whitelist.push(...result, ...tagify.value)
            }

            // render the suggestions dropdown.
            tagify.loading(false).dropdown.show.call(tagify, e.detail.value)
        })
    }

    function onTagEdit(e) {
        tags = inputElm.value
    }

    $: props = {
        ...$$restProps,
        class: `tagify-input bg-white w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:border-indigo-200 focus:ring-indigo-200 ${$$restProps.class || ''}`,
    }
</script>

<input {id} name="tags" {...props} {placeholder} value={selectedValues} />
<InputError message={error} />

<style>
    :global(.tagify__input::before) {
        line-height: initial;
    }
</style>
