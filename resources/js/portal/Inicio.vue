<template>
    <div class="contenedor_inicio">
        <!-- Product -->
        <section class="sec-blog bg0 p-b-90 fondo_seccion">
            <div class="container-fluid p-0 mb-4">
                <div class="bg-dark">
                    <h1
                        class="ltext-105 cl5 txt-center respon1 text-warning pt-3 pb-3"
                    >
                        {{ oConfiguracion.razon_social }}
                    </h1>
                </div>
            </div>

            <div class="container wow fadeInUp" wow-data-delay="0.2s">
                <div class="flex-w flex-sb-m p-b-20">
                    <div class="flex-w flex-c-m m-tb-10">
                        <div
                            class="flex-c-m stext-106 cl2 size-104 bor4 pointer hov-btn1 trans-04 m-r-8 m-tb-4 js-show-filter"
                        >
                            <i
                                class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"
                            ></i>
                            <i
                                class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"
                            ></i>
                            Filtro
                        </div>

                        <div
                            class="flex-c-m stext-106 cl2 size-105 bor4 pointer hov-btn1 trans-04 m-tb-4 js-show-search"
                        >
                            <i
                                class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"
                            ></i>
                            <i
                                class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"
                            ></i>
                            <span>Buscar</span>
                        </div>
                    </div>

                    <!-- Search product -->
                    <div class="dis-none panel-search w-full bg-white">
                        <div class="bor8 dis-flex p-l-15">
                            <button
                                class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04"
                                @click="searchProductos"
                            >
                                <i class="zmdi zmdi-search"></i>
                            </button>

                            <input
                                class="mtext-107 cl2 size-114 plh2 p-r-15"
                                type="text"
                                name="search-product"
                                placeholder="Buscar"
                                id="btnBuscarProducto"
                                v-model="search"
                                @keyup="searchProductos"
                            />
                        </div>
                    </div>

                    <!-- Filter -->
                    <div class="dis-none panel-filter w-full p-t-10">
                        <div
                            class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm"
                        >
                            <div class="col-3">
                                <div class="mtext-102 cl2 p-b-15">
                                    Ordenar por
                                </div>

                                <ul>
                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros(
                                                    'orden',
                                                    'defecto'
                                                )
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.orden == 'defecto'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Defecto
                                        </a>
                                    </li>

                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros(
                                                    'orden',
                                                    'nombre'
                                                )
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.orden == 'nombre'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Nombre
                                        </a>
                                    </li>

                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros(
                                                    'orden',
                                                    'precio_mayor'
                                                )
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.orden == 'precio_mayor'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Precio mayor
                                        </a>
                                    </li>

                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros(
                                                    'orden',
                                                    'precio_menor'
                                                )
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.orden == 'precio_menor'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Precio menor
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-3">
                                <div class="mtext-102 cl2 p-b-15">Precio</div>

                                <ul>
                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros(
                                                    'precio',
                                                    'todos'
                                                )
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.precio == 'todos'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Todos
                                        </a>
                                    </li>

                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros('precio', '0-50')
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.precio == '0-50'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Bs 0.00 - Bs 50.00
                                        </a>
                                    </li>

                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros(
                                                    'precio',
                                                    '50-100'
                                                )
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.precio == '50-100'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Bs 50.00 - Bs 100.00
                                        </a>
                                    </li>

                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros(
                                                    'precio',
                                                    '100-150'
                                                )
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.precio == '100-150'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Bs 100.00 - Bs 150.00
                                        </a>
                                    </li>

                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros(
                                                    'precio',
                                                    '150-200'
                                                )
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.precio == '150-200'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Bs 150.00 - Bs 200.00
                                        </a>
                                    </li>

                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros('precio', '200')
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.precio == '200'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Bs 200.00+
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <div class="mtext-102 cl2 p-b-15">
                                    Categorías
                                </div>

                                <ul
                                    class="filtro_categorias"
                                    :class="[
                                        listCategorias.length > 5
                                            ? 'column-list'
                                            : '',
                                    ]"
                                >
                                    <li class="p-b-6">
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros(
                                                    'categoria',
                                                    'todos'
                                                )
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.categoria == 'todos'
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            Todos
                                        </a>
                                    </li>

                                    <li
                                        class="p-b-6"
                                        v-for="item in listCategorias"
                                    >
                                        <a
                                            href="#"
                                            @click.prevent="
                                                aplicarFiltros(
                                                    'categoria',
                                                    item.id
                                                )
                                            "
                                            class="filter-link stext-106 trans-04"
                                            :class="[
                                                filtro.categoria == item.id
                                                    ? 'filter-link-active'
                                                    : '',
                                            ]"
                                        >
                                            <p>{{ item.nombre }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3" v-if="search != ''">
                    <div class="col-md-12">
                        Resultados para:
                        <span class="font-weight-bold">{{ search }}</span>
                    </div>
                </div>
                <b-skeleton-wrapper :loading="loading">
                    <template #loading>
                        <b-row>
                            <b-col cols="3">
                                <b-skeleton-img></b-skeleton-img>
                            </b-col>
                            <b-col cols="3">
                                <b-skeleton-img></b-skeleton-img>
                            </b-col>
                            <b-col cols="3">
                                <b-skeleton-img></b-skeleton-img>
                            </b-col>
                            <b-col cols="3">
                                <b-skeleton-img></b-skeleton-img>
                            </b-col>
                        </b-row>
                        <b-row class="mt-4 pb-5">
                            <b-col cols="3">
                                <b-skeleton-img></b-skeleton-img>
                            </b-col>
                            <b-col cols="3">
                                <b-skeleton-img></b-skeleton-img>
                            </b-col>
                            <b-col cols="3">
                                <b-skeleton-img></b-skeleton-img>
                            </b-col>
                            <b-col cols="3">
                                <b-skeleton-img></b-skeleton-img>
                            </b-col>
                        </b-row>
                    </template>
                    <div
                        class="row isotope-grid"
                        v-if="listProductos.length > 0"
                        id="contenedor_productos"
                    >
                        <div
                            v-for="item in listProductos"
                            class="col-sm-6 col-md-4 col-lg-3 p-b-35 item_producto"
                            :class="[
                                item.categoria ? 'c' + item.categoria.id : '',
                            ]"
                        >
                            <!-- Block2 -->
                            <div class="block2">
                                <span class="info_categoria">
                                    {{ item.categoria.nombre }}
                                </span>
                                <div class="block2-pic hov-img0">
                                    <img
                                        :src="item.url_imagen"
                                        alt="IMG-PRODUCT"
                                    />
                                    <!-- <button
                                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04"
                                        @click="showModalProducto(item.id)"
                                    >
                                        Ver producto
                                    </button> -->
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14 p-l-5 p-b-5">
                                    <div class="block2-txt-child1 flex-col-l">
                                        <span
                                            class="stext-104 cl2 hov-cl1 trans-04 js-name-b2 p-b-6 descripcion"
                                        >
                                            {{ item.nombre }}
                                        </span>
                                        <span class="stext-105 cl7">
                                            Bs. {{ item.precio }}
                                        </span>
                                    </div>
                                </div>
                                <div class="block-btn">
                                    <button
                                        type="button"
                                        class="btn btn-warning btn-flat btn-block text-white"
                                        @click.prevent="
                                            showModalProducto(item.id)
                                        "
                                    >
                                        <i class="fa fa-cart-plus"></i>
                                        Ver/Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-5" v-else>
                        <div class="col-md-12">
                            <h4 class="text-center text-white">
                                No se encontrarón registros disponibles
                            </h4>
                        </div>
                    </div>
                </b-skeleton-wrapper>
                <div
                    class="row mt-5"
                    v-if="!loading && listProductos.length > 0"
                >
                    <div class="col-md-12 pb-3 paginacion_portal">
                        <b-pagination
                            class="rounded-0"
                            align="center"
                            v-model="currentPage"
                            :total-rows="rows"
                            :per-page="perPage"
                            aria-controls="my-table"
                        ></b-pagination>
                    </div>
                </div>
            </div>
            <ModalProducto
                :id="id_seleccionado"
                :mostrar_modal="muestra_modal_producto"
                @close="muestra_modal_producto = false"
            ></ModalProducto>
        </section>
    </div>
</template>
<script>
import ModalProducto from "./componentes/ModalProducto.vue";
export default {
    components: {
        ModalProducto,
    },
    data() {
        return {
            fullscreenLoading: true,
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            url_asset: "",
            listCategorias: [],
            listProductos: [],
            id_seleccionado: 0,
            muestra_modal_producto: false,
            currentPage: 1,
            rows: 12,
            perPage: 5,
            search: "",
            setTimeOutSearch: null,
            loading: false,
            filtro: {
                orden: "defecto",
                precio: "todos",
                categoria: "todos",
            },
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
        this.getProductos();
        this.getCategorias();
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
        getProductos(page = 1) {
            this.loading = true;
            axios
                .get(main_url + "/portal/listaProductos", {
                    params: {
                        page: page,
                        orden: this.filtro.orden,
                        precio: this.filtro.precio,
                        categoria: this.filtro.categoria,
                        texto: this.search,
                    },
                })
                .then((response) => {
                    this.listProductos = response.data.productos.data;
                    this.rows = response.data.productos.total;
                    this.perPage = response.data.per_page;
                    let self = this;
                    setTimeout(function () {
                        self.metodosProductos();
                        self.loading = false;
                    }, 300);
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
        searchProductos() {
            this.loading = true;
            clearInterval(this.setTimeOutSearch);
            let self = this;
            this.setTimeOutSearch = setTimeout(function () {
                self.getProductos();
            }, 600);
        },
        getCategorias() {
            axios.get(main_url + "/portal/getCategorias").then((response) => {
                this.listCategorias = response.data.categorias;
            });
        },
        showModalProducto(id) {
            this.id_seleccionado = id;
            this.muestra_modal_producto = true;
        },

        metodosProductos() {
            let self = this;
            /*==================================================================
            [ Filter / Search product ]*/
            $(".js-show-filter")
                .off("click")
                .on("click", function () {
                    $(this).toggleClass("show-filter");
                    $(".panel-filter").slideToggle(400);

                    if ($(".js-show-search").hasClass("show-search")) {
                        $(".js-show-search").removeClass("show-search");
                        $(".panel-search").slideUp(400);
                    }
                });

            $(".js-show-search")
                .off("click")
                .on("click", function () {
                    $(this).toggleClass("show-search");
                    $(".panel-search").slideToggle(400);

                    if ($(this).hasClass("show-search")) {
                        $("#btnBuscarProducto").focus();
                    }

                    if ($(".js-show-filter").hasClass("show-filter")) {
                        $(".js-show-filter").removeClass("show-filter");
                        $(".panel-filter").slideUp(400);
                    }
                });
        },
    },
};
</script>
<style></style>
