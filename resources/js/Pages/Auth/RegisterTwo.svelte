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

<div style="background-color:white;">
    <Grid container gutter={12}>
        <!-- columna Logo registro-->
        <Grid xs={12} lg={6}>
            <ApplicationRegister class="w-5/6 fill-current text-gray-500" style="margin-top: 5%;margin-left: 10%;" />
        </Grid>

        <!-- columna Form -->
        <Grid xs={12} lg={6}>
            <!--             <form on:submit|preventDefault={handleSubmit} class="hijo">
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
            </form> -->
            <div class="signupFrm">
                <div class="wrapper">
                    <form action="" class="form">
                        <h1 class="title">Registarse</h1>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Nombre Completo</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Tipo de documento</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Número de documento</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Correo electrónico</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Celular / Teléfono</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Contraseña</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Repita la contraseña</label>
                        </div>

                        <input type="submit" class="submitBtn" value="Registrarse" />
                        <input type="submit" class="submitBtn2" value="Regresar" />
                    </form>
                </div>
            </div>
        </Grid>
    </Grid>
</div>

<div style="background-color:white;">
    <Grid container gutter={12}>
        <Grid>
            <ApplicationFooter class="w-5/6 fill-current text-gray-500 center" style="margin-left: 10%;" />
        </Grid>
    </Grid>
</div>

<style>
    /*     .hijo {
        margin: 0 auto;
        padding-left: 10%;
        padding-right: 10%;
        padding-top: 3%;
        //border: 1px solid #4caf50;
    }

    .btnBack {
        margin-left: 12px;
        background-color: white;
        color: orange;
        border-radius: 6px;
        border: 1px solid orange;
        font-size: 21px;
    }
 */
    .signupFrm {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form {
        background-color: white;
        width: 400px;
        border-radius: 8px;
        padding: 20px 40px;
        box-shadow: 0 10px 25px rgba(92, 99, 105, 0.2);
    }

    .title {
        font-size: 25px;
        color: #ffb700;
    }

    .inputContainer {
        position: relative;
        height: 45px;
        width: 90%;
        margin-bottom: 17px;
    }

    .input {
        position: absolute;
        top: -3px;
        left: 0px;
        height: 66%;
        width: 100%;
        border: 1px solid #dadce0;
        border-radius: 7px;
        font-size: 16px;
        padding: 0 20px;
        outline: none;
        background: none;
        z-index: 1;
    }

    .label {
        position: absolute;
        /* top: 15px; */
        left: 15px;
        padding: 0 4px;
        background-color: white;
        color: #dadce0;
        font-size: 16px;
        transition: 0.5s;
        z-index: 0;
    }

    ::placeholder {
        color: transparent;
    }

    .submitBtn {
        display: inline-block;
        margin-left: auto;
        padding: 4px 30px;
        border: none;
        background-color: #ffb700;
        color: white;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        /*         margin-top: 30px; */
        width: 44%;
    }

    .submitBtn2 {
        display: inline-block;
        margin-left: auto;
        padding: 4px 30px;
        border: none;
        background-color: white;
        color: #ffb700;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        /*         margin-top: 30px; */
        width: 45%;
        border: 1px solid orange;
    }
    .submitBtn:hover {
        background-color: #ffb700d2;
        transform: translateY(-2px);
    }
    .submitBtn2:hover {
        background-color: #ffb700d2;
        transform: translateY(-2px);
        color: white;
    }
    .input:focus + .label {
        top: -7px;
        left: 3px;
        z-index: 10;
        font-size: 14px;
        font-weight: 600;
        color: #ffb700;
    }

    .input:not(:placeholder-shown) + .label {
        top: -7px;
        left: 3px;
        z-index: 10;
        font-size: 14px;
        font-weight: 600;
    }

    .input:focus {
        border: 2px solid #ffb700;
    }
</style>
