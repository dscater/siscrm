<template>
    <div class="contenedor_inicio">
        <!-- Product -->
        <section class="sec-blog bg0 p-b-90 fondo_seccion">
            <div class="container-fluid p-0">
                <div class="bg3 titulo-seccion">
                    <h1
                        class="ltext-105 cl5 txt-center respon1 text-warning pt-5 pb-5"
                    >
                        {{ oConfiguracion.razon_social }}
                    </h1>
                </div>
            </div>

            <div
                class="container-fluid p-lr-40 bg-dark wow fadeInUp"
                wow-data-delay="0.2s"
            >
                <div class="row text-white">
                    <div class="col-md-3" v-if="oConfiguracion.nosotros">
                        <img
                            :src="oConfiguracion.url_nosotros_img"
                            alt="Nosotros SISCRM"
                            class="w-100"
                            loading="lazy"
                        />
                    </div>
                    <div class="col-md-9 text-center">
                        <h4 class="font-weight-bold text-md mt-3 mb-3">
                            NOSOTROS
                        </h4>
                        <p class="text-sm" v-text="oConfiguracion.nosotros"></p>
                    </div>
                </div>
            </div>

            <div
                class="container-fluid p-lr-40 border fondo_tarjeta wow fadeInUp"
                wow-data-delay="0.2s"
            >
                <div class="row text-gray">
                    <div class="col-md-9 text-center">
                        <h4 class="font-weight-bold text-md mt-3 mb-3">
                            MISIÓN
                        </h4>
                        <p class="text-sm" v-text="oConfiguracion.mision"></p>
                    </div>
                    <div class="col-md-3" v-if="oConfiguracion.mision">
                        <img
                            :src="oConfiguracion.url_mision_img"
                            alt="Nosotros SISCRM"
                            class="w-100"
                            loading="lazy"
                        />
                    </div>
                </div>
            </div>

            <div
                class="container-fluid p-lr-40 bg-dark wow fadeInUp"
                wow-data-delay="0.2s"
            >
                <div class="row text-white">
                    <div class="col-md-3" v-if="oConfiguracion.vision">
                        <img
                            :src="oConfiguracion.url_vision_img"
                            alt="Nosotros SISCRM"
                            class="w-100"
                            loading="lazy"
                        />
                    </div>
                    <div class="col-md-9 text-center">
                        <h4 class="font-weight-bold text-md mt-3 mb-3">
                            VISIÓN
                        </h4>
                        <p class="text-sm" v-text="oConfiguracion.vision"></p>
                    </div>
                </div>
            </div>

            <div
                class="container-fluid p-lr-40 mt-5 border fondo_tarjeta wow fadeInUp"
                wow-data-delay="0.2s"
            >
                <div class="row text-gray">
                    <div class="col-md-12 text-center">
                        <h4 class="font-weight-bold text-md mt-3 mb-3">
                            UBICACIÓN
                        </h4>
                        <div
                            v-html="oConfiguracion.ubicacion"
                            class="ubicacion_portal"
                        ></div>
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
        };
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
    },
};
</script>
<style></style>
