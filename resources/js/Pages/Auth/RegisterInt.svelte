<script context="module">
    /*    import GuestLayout from '@/Layouts/Guest'
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
    import FormField from '@smui/form-field'
    import Grid from 'svelte-grid-responsive'
    import ApplicationRegister from '@/Shared/ApplicationRegister'
    import ApplicationFooter from '@/Shared/ApplicationFooter'

    export let errors

    export let usr
    console.log('usuarios')

    let sending = false

    let form = useForm({
        name: '',
        email: '',
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
        <!-- columna -->
        <Grid xs={12} lg={6} class="ImageP">
            <ApplicationRegister class="w-5/6 fill-current text-gray-500" style="margin-top: 10%;margin-left: 10%;" />
        </Grid>

        <!-- columna -->
        <Grid xs={12} lg={6}>
            <form on:submit|preventDefault={handleSubmit} class="hijo">
                <div class="mt-4">
                    <Input label="Nombre completo" id="name" type="text" class="mt-1" bind:value={$form.name} error={errors.name} required autocomplete="name" />
                </div>

                <div class="mt-4">
                    <select id="TipoD" name="TipoD" class="mt-1">
                        <option value="Tipo de documento" selected disabled>Tipo de documento</option>
                        <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                        <option value="Cedula de extranjeria">Cedula de extranjeria</option>
                    </select>
                </div>

                <div class="mt-4">
                    <Input label="Numero de documento" id="ND" type="text" class="mt-1" bind:value={$form.name} error={errors.name} required autocomplete="ND" />
                </div>

                <div class="mt-4">
                    <Input label="Correo electrónico" id="email" type="email" class="mt-1" bind:value={$form.email} error={errors.email} required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <Input label="Celular/Telefono" id="CT" type="text" class="mt-1" bind:value={$form.name} error={errors.name} required autocomplete="CT" />
                </div>

                <div class="mt-4">
                    <select id="RolSennovalab" name="RS" class="mt-1">
                        <option value="Rol Sennovalab" selected disabled>Rol Sennovalab</option>
                        <option value="Investigador">Investigador</option>
                        <option value="Personal Tecnico">Personal Tecnico</option>
                        <option value="Gestion Tecnica">Gestion Tecnica</option>
                    </select>
                </div>

                <div class="mt-4">
                    <select id="TipoA" name="TipoA" class="mt-1">
                        <option value="Tipo de Afiliacion" selected disabled>Tipo de Afiliacion</option>
                        <option value="Planta">Planta</option>
                        <option value="Contratista">Contratista</option>
                    </select>
                </div>

                <div class="mt-4">
                    <Input label="Numero de contrato" id="NC" type="text" class="mt-1" bind:value={$form.name} error={errors.name} required autocomplete="NC" />
                </div>
                <br />

                <label for="FIC" class="mt-4">Fecha de Inicio Contratista:</label>

                <input type="date" class="mt-1" id="FIC" name="FIC" value="2022-01-01" min="2022-01-01" max="2022-12-31" /><br />

                <label for="FFC" class="mt-4">Fecha final Contratista:</label>

                <input type="date" class="mt-1" id="FFC" name="FFC" value="2022-01-01" min="2022-01-01" max="2022-12-31" />

                <div class="mt-4">
                    <Input label={$_('Password')} id="password" type="password" class="mt-1" bind:value={$form.password} error={errors.password} required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <Input label={$_('Confirm Password')} id="password_confirmation" type="password" class="mt-1" bind:value={$form.password_confirmation} error={errors.password_confirmation} required autocomplete="new-password" />
                </div>

                <hr class="mt-4" />

                <div class="block mt-4">
                    <InfoMessage message="Los datos proporcionados serán tratados de acuerdo con la política de tratamiento de datos personales del SENA y a la ley 1581 de 2012 (Acuerdo No. 0009 del 2016)" class="mb-4" />
                    <FormField>
                        <Checkbox bind:checked={$form.autorizacion_datos} />
                        <span slot="label">Autorizo el tratamiento de mis datos personales. <a href="https://www.sena.edu.co/es-co/transparencia/Documents/proteccion_datos_personales_sena_2016.pdf" target="_blank" class="text-indigo-500">Leer acuerdo No. 0009 del 2016</a></span>
                    </FormField>
                </div>

                <div class="flex items-center justify-content-center mt-4">
                    <LoadingButton bind:loading={sending} class="btn-indigo" type="submit" bind:disabled={$form.autorizacion_datos}>{$_('Register')}</LoadingButton>
                    <a use:inertia href={route('login')} class="btnBack mr-4 hover:text-gray-900">
                        {$_('Already registered?')}
                    </a>
                </div>

                <!-- <div class="flex items-center justify-end mt-4">
                    <a use:inertia href={route('login')} class="mr-4 underline text-sm text-gray-600 hover:text-gray-900">
                        {$_('Already registered?')}
                    </a>

                    <LoadingButton bind:loading={sending} class="btn-indigo" type="submit" bind:disabled={$form.autorizacion_datos}>{$_('Register')}</LoadingButton>
                </div> -->
            </form>
        </Grid>
    </Grid>

    <div>
        <Grid container gutter={12}>
            <Grid>
                <ApplicationFooter class="w-5/6 fill-current text-gray-500 center" style="margin-left:10%" />
            </Grid>
        </Grid>
    </div>
</div>

<style>
    .hijo {
        margin: 0 auto;
        padding: 60px;
        border: 1px solid #4caf50;
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
