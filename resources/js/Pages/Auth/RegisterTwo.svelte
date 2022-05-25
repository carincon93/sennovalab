<script context="module">
    /*     import GuestLayout from '@/Layouts/Guest'
    export const layout = GuestLayout */
</script>

<script>
    import { inertia, useForm } from '@inertiajs/inertia-svelte'
    import { route, checkRole, checkPermission } from '@/Utils'
    import { _ } from 'svelte-i18n'
    import LoadingButton from '@/Shared/LoadingButton'
    import Input from '@/Shared/Input'
    import InfoMessage from '@/Shared/InfoMessage'
    import Checkbox from '@smui/checkbox'
    import SelectMulti from 'svelte-select'

    import FormField from '@smui/form-field'
    import ApplicationRegister from '@/Shared/ApplicationRegister'
    import ApplicationFooter from '@/Shared/ApplicationFooter'

    import Grid from 'svelte-grid-responsive'

    export let errors

    export let usr
    //console.log('usuarios ->' + usr)

    let sending = false

    let form = useForm({
        name: '',
        email: '',
        tDocu: '',
        nDocu: '',
        tel: '',
        password: '',
        password_confirmation: '',
        autorizacion_datos: false,
        role_id: [],
    })

    function handleSubmit() {
        if ($form.autorizacion_datos) {
            $form.post(route('register'))
        }
    }
</script>

<div>
    <Grid container gutter={12}>
        <!-- columna Logo registro-->

        <Grid xs={12} lg={6}>
            <ApplicationRegister class="w-5/6 fill-current text-gray-500" style="margin-top: 10%;margin-left: 10%;" />
        </Grid>

        <!-- columna Form -->
        <Grid xs={12} lg={6}>
            <form on:submit|preventDefault={handleSubmit} class="hijo">
                <label for="" style="font-size: 21px;">Registro</label>

                <div class="">
                    <Input label="Nombre completo" id="name" type="text" class="mt-1" bind:value={$form.name} error={errors.name} required autocomplete="name" />
                </div>

                <div>
                    <Input label="Tipo Documento" id="tpDocum" type="text" class="mt-1" bind:value={$form.tDocu} error={errors.name} required autocomplete="name" />
                </div>

                <div>
                    <Input label="Número de Documento" id="" type="number" class="mt-1" bind:value={$form.nDocu} error={errors.name} required autocomplete="" />
                </div>

                <div class="">
                    <Input label="Correo electrónico institucional" id="email" type="email" class="mt-1" bind:value={$form.email} error={errors.email} required autocomplete="username" />
                </div>

                <div>
                    <Input label="Celular / Teléfono" id="" type="number" class="mt-1" bind:value={$form.tel} error={errors.name} required autocomplete="" />
                </div>

                <div class="">
                    <Input label={$_('Password')} id="password" type="password" class="mt-1" bind:value={$form.password} error={errors.password} required autocomplete="new-password" />
                </div>

                <div class="">
                    <Input label={$_('Confirm Password')} id="password_confirmation" type="password" class="mt-1" bind:value={$form.password_confirmation} error={errors.password_confirmation} required autocomplete="new-password" />
                </div>

                <hr class="mt-4" />

                <div class="block">
                    <InfoMessage message="Los datos proporcionados serán tratados de acuerdo con la política de tratamiento de datos personales del SENA y a la ley 1581 de 2012 (Acuerdo No. 0009 del 2016)" class="mb-4" />
                    <FormField>
                        <Checkbox bind:checked={$form.autorizacion_datos} />
                        <span slot="label">Autorizo el tratamiento de mis datos personales. <a href="https://www.sena.edu.co/es-co/transparencia/Documents/proteccion_datos_personales_sena_2016.pdf" target="_blank" class="text-indigo-500">Leer acuerdo No. 0009 del 2016</a></span>
                    </FormField>
                </div>

                <div class="flex items-center justify-content-center">
                    <LoadingButton bind:loading={sending} class="btn-indigo" type="submit" bind:disabled={$form.autorizacion_datos}>{$_('Register')}</LoadingButton>
                    <a use:inertia href={route('login')} class="btnBack mr-4 hover:text-gray-900">
                        {$_('Already registered?')}
                    </a>
                </div>
            </form>
        </Grid>
    </Grid>
</div>
<div>
    <Grid container gutter={12}>
        <Grid>
            <ApplicationFooter class="w-5/6 fill-current text-gray-500 center" />
        </Grid>
    </Grid>
</div>

<style>
    .hijo {
        margin: 0 auto;
        padding-left: 10%;
        padding-right: 10%;
        padding-top: 3%;
        /*         border: 1px solid #4caf50; */
    }

    .btnBack {
        margin-left: 12px;
        background-color: white;
        color: orange;
        border-radius: 6px;
        border: 1px solid orange;
        font-size: 21px;
    }
</style>
