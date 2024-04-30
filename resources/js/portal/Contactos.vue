<template>
    <div class="contenedor_inicio">
        <!-- Product -->
        <section class="sec-blog bg0 p-b-90 fondo_seccion">
            <div class="container-fluid p-0">
                <div class="bg3 titulo-seccion">
                    <h1
                        class="ltext-105 cl5 txt-center respon1 text-warning pt-5 pb-5"
                    >
                        Contactos
                    </h1>
                </div>
            </div>

            <div
                class="container-fluid p-lr-40 bg-dark wow fadeInUp"
                wow-data-delay="0.2s"
            >
                <div class="row">
                    <div class="col-12">
                        <div class="container text-white">
                            <div class="row">
                                <div
                                    class="col-12 text-center text-lg text-white"
                                >
                                    Escribenos
                                </div>
                                <div class="col-md-8 offset-md-2 pb-5">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.nombre,
                                                    }"
                                                    >Tú Nombre:</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.nombre,
                                                    }"
                                                    v-model="oForm.nombre"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.nombre"
                                                    v-text="errors.nombre[0]"
                                                ></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.asunto,
                                                    }"
                                                    >Asunto:</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.asunto,
                                                    }"
                                                    v-model="oForm.asunto"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.asunto"
                                                    v-text="errors.asunto[0]"
                                                ></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.correo,
                                                    }"
                                                    >Tú correo:</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.correo,
                                                    }"
                                                    v-model="oForm.correo"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.correo"
                                                    v-text="errors.correo[0]"
                                                ></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.fono,
                                                    }"
                                                    >Tú Teléfono/Celular:</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.fono,
                                                    }"
                                                    v-model="oForm.fono"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.fono"
                                                    v-text="errors.fono[0]"
                                                ></span>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.mensaje,
                                                    }"
                                                    >Mensaje:</label
                                                >
                                                <textarea
                                                    class="form-control"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.mensaje,
                                                    }"
                                                    v-model="oForm.mensaje"
                                                    rows="6"
                                                >
                                                </textarea>
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.mensaje"
                                                    v-text="errors.mensaje[0]"
                                                ></span>
                                            </div>
                                            <div class="col-12">
                                                <button
                                                    class="btn btn-block btn-primary"
                                                    @click="setFormulario"
                                                    :disabled="enviando"
                                                    v-html="textoBoton"
                                                ></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data() {
        return {
            fullscreenLoading: true,
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            url_asset: "",
            oConfiguracion: {
                nombre_sistema: "",
                alias: "",
                razon_social: "",
                nit: "",
                ciudad: "",
                dir: "",
                fono: "",
                web: "",
                actividad: "",
                correo: "",
                logo: "",
                servicios: "",
                servicios_img: "",
                mision: "",
                mision_img: "",
                vision: "",
                vision_img: "",
                nosotros: "",
                nosotros_img: "",
                facebook: "",
                instagram: "",
                twitter: "",
                youtube: "",
                ubicacion: "",
            },
            oForm: {
                nombre: "",
                asunto: "",
                correo: "",
                fono: "",
                mensaje: "",
            },
            enviando: false,
            errors: [],
        };
    },
    computed: {
        textoBoton() {
            if (this.enviando) {
                return ` <i class="fa fa-spinner fa-spin"></i> Enviando...`;
            }
            return ` <i class="fa fa-paper-plane"></i> Enviar`;
        },
    },
    mounted() {
        let self = this;
        setTimeout(function () {
            self.loadingWindow.close();
        }, 500);
        this.getConfiguracion();
        this.getUrlAsset();
    },
    methods: {
        getConfiguracion() {
            axios
                .get(main_url + "/configuracion/getConfiguracion")
                .then((response) => {
                    this.oConfiguracion = response.data.configuracion;
                });
        },
        getUrlAsset() {
            axios.get(main_url + "/url_asset").then((response) => {
                this.url_asset = response.data;
            });
        },
        aplicarFiltros(key, valor) {
            this.loading = true;
            this.filtro[key] = valor;
            if (this.currentPage != 1) {
                this.currentPage = 1;
            } else {
                this.getProductos();
            }
        },
        setFormulario() {
            this.enviando = true;
            try {
                let url = main_url + "/correo_portal";
                axios
                    .post(url, this.oForm)
                    .then((res) => {
                        this.enviando = false;
                        Swal.fire({
                            icon: "success",
                            title: res.data.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        this.limpiaForm();
                        this.errors = [];
                    })
                    .catch((error) => {
                        this.enviando = false;
                        if (error.response) {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors;
                            }
                            if (error.response.status === 500) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    html: error.response.data.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                            }
                        }
                    });
            } catch (e) {
                this.enviando = false;
                console.log(e);
            }
        },
        limpiaForm() {
            this.oForm.nombre = "";
            this.oForm.asunto = "";
            this.oForm.correo = "";
            this.oForm.fono = "";
            this.oForm.mensaje = "";
        },
    },
};
</script>
<style></style>
