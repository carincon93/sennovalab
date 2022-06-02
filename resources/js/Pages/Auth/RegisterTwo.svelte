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

    /*     export let errors

    export let usr */
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
        let n = $form.name
        console.log('Name -> ' + n)

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
            <div class="signupFrm">
                <div class="wrapper">
                    <form action="" class="form" on:submit|preventDefault={handleSubmit}>
                        <h1 class="title">Registarse</h1>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" bind:value={$form.name} />
                            <label for="" class="label">Primer nombre *</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Segundo nombre</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Primer apellido *</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Segundo apellido *</label>
                        </div>

                        <div class="">
                            <label for="cars" style="color: #e0dfe1;">Tipo de documento *</label>
                            <select name="docuem" id="documento">
                                <option value="" style="color: #e0dfe1;">Seleccione ...</option>
                                <option value="">Cédula de ciudadanía</option>
                                <option value="">Cédula de extranjería</option>
                            </select>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Número de documento *</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Correo electrónico *</label>
                        </div>

                        <div class="inputContainerTwo">
                            <input type="text" class="inputmini" placeholder="a" />
                            <label for="" class="label">Celular *</label>
                        </div>
                        <div class="inputContainerTwo">
                            <input type="text" class="inputmini" placeholder="a" />
                            <label for="" class="label">Teléfono *</label>
                        </div>

                        <div class="inputContainerTwo">
                            <input type="text" class="inputmini" placeholder="a" />
                            <label for="" class="label">Extensión</label>
                        </div>

                        <div class="">
                            <label for="cars" style="color: #e0dfe1;">Tipo de usuario *</label>
                            <select name="docuem" id="documento">
                                <option value="" style="color: #e0dfe1;">Seleccione ...</option>
                                <option value="">Persona natural</option>
                                <option value="">Persona jurídica</option>
                            </select>
                        </div>

                        <div class="inputContainerFour">
                            <input type="text" class="inputmini" placeholder="a" />
                            <label for="" class="labelOne">Nombre empresa/ entidad/ centro de formación*</label>
                        </div>

                        <div class="inputContainerFive">
                            <input type="text" class="inputmini" placeholder="a" />
                            <label for="" class="labelOne">NIT / RUT *</label>
                        </div>

                        <div class="inputContainerThree">
                            <input type="text" class="inputmini" placeholder="a" />
                            <label for="" class="labelOne">Dígito verificación*</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Contraseña *</label>
                        </div>

                        <div class="inputContainer">
                            <input type="text" class="input" placeholder="a" />
                            <label for="" class="label">Repita la Contraseña *</label>
                        </div>

                        <div class="datos">
                            <p style="color: #EA5846;">Los datos proporcionados serán tratados de acuerdo con la política de tratamiento de datos personales del SENA y a la ley 1581 de 2012 (Acuerdo No. 0009 del 2016)</p>
                        </div>

                        <div class="auth">
                            <FormField>
                                <Checkbox bind:checked={$form.autorizacion_datos} />
                                <span slot="label">Autorizo el tratamiento de mis datos personales. <a href="https://www.sena.edu.co/es-co/transparencia/Documents/proteccion_datos_personales_sena_2016.pdf" target="_blank" class="text-indigo-500">Leer acuerdo No. 0009 del 2016</a></span>
                            </FormField>
                        </div>

                        <input type="submit" class="submitBtn" value="Registrarse" />
                        <a use:inertia href={route('login')} class="submitBtn2"> Regresar </a>
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
    .signupFrm {
        display: flex;
        justify-content: center;
        align-items: center;
        height: auto;
    }

    .form {
        background-color: white;
        width: 517px;
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
        width: 49%;
        display: inline-block;
        margin-bottom: 17px;
    }
    .inputContainerTwo {
        position: relative;
        height: 45px;
        width: 32%;
        display: inline-block;
        margin-bottom: 17px;
    }

    .inputContainerThree {
        position: relative;
        height: 45px;
        width: 22%;
        display: inline-block;
        margin-bottom: 17px;
    }

    .inputContainerFour {
        position: relative;
        height: 45px;
        width: 52%;
        display: inline-block;
        margin-bottom: 17px;
    }
    .inputContainerFive {
        position: relative;
        height: 45px;
        width: 22%;
        display: inline-block;
        margin-bottom: 17px;
    }

    .input {
        position: absolute;
        /* top: -3px; */
        left: 0px;
        height: 100%;
        width: 100%;
        border: 1px solid #dadce0;
        border-radius: 7px;
        font-size: 16px;
        padding: 0 20px;
        outline: none;
        background: none;
        z-index: 1;
    }
    .inputmini {
        position: absolute;
        /* top: -3px; */
        left: 0px;
        height: 100%;
        width: 99%;
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
        top: 10px;
        left: 15px;
        padding: 0 4px;
        background-color: white;
        color: #dadce0;
        font-size: 16px;
        transition: 0.5s;
        z-index: 0;
    }
    .labelOne {
        position: absolute;
        top: 4px;
        padding: 0 4px;
        background-color: white;
        color: #dadce0;
        font-size: 12px;
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
        width: 49%;
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
        width: 50%;
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

    .inputmini:focus + .label {
        top: -7px;
        left: 3px;
        z-index: 10;
        font-size: 14px;
        font-weight: 600;
        color: #ffb700;
    }

    .inputmini:focus + .labelOne {
        top: -3px;
        left: 3px;
        z-index: 10;
        font-size: 10px;
        font-weight: 300;
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

    input[type='date'],
    select {
        border-radius: 4px;
        border: 1px solid #dbdbdb;
        margin-bottom: 5%;
    }

    .datos {
        border-radius: 10px;
        border: 0px solid rgb(0, 0, 0);
        background-color: #ffedd5;
        text-align: center;
        font-size: 11px;
        padding: 9px;
    }
    .auth {
        margin-top: 4%;
        margin-bottom: 4%;
        margin-left: -2%;
    }
</style>
