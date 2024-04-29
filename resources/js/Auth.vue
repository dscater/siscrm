<template>
    <div class="login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card border border-primary">
                <div class="card-header text-center">
                    <img :src="logo" alt="Logo" />
                    <router-link :to="{ name: 'login' }" class="h1 text-white"
                        ><b v-text="empresa"></b
                    ></router-link>
                </div>
                <div class="card-body">
                    <p class="login-box-msg text-white font-weight-bold">
                        Ingresa tu Correo/Usuario y Contraseña para inicar
                        sesión
                    </p>

                    <div>
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Correo/Usuario"
                                v-model="usuario"
                                @keypress.enter="login()"
                                autofocus
                            />
                            <div class="input-group-append">
                                <div class="input-group-text bg-primary">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input
                                type="password"
                                class="form-control"
                                placeholder="Contraseña"
                                v-model="password"
                                @keypress.enter="login()"
                            />
                            <div class="input-group-append">
                                <div class="input-group-text bg-primary">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="error">
                            <div class="col-12">
                                <div class="callout callout-danger">
                                    <h5>¡Error!</h5>
                                    <p>
                                        El usuario o contraseña son incorrectos
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-block btn-flat font-weight-bold"
                                    @click.prevent="login()"
                                    v-loading.fullscreen.lock="
                                        fullscreenLoading
                                    "
                                >
                                    Acceder
                                </button>
                            </div>
                            <div class="col-12 mt-2">
                                <a
                                    :href="url_registro"
                                    class="btn btn-outline-primary btn-block btn-flat font-weight-bold"
                                    v-loading.fullscreen.lock="
                                        fullscreenLoading
                                    "
                                >
                                    Registrarme
                                </a>
                            </div>
                            <div class="col-12 mt-2 text-center">
                                <a
                                    :href="url_olvide_mi_contrasenia"
                                    class="w-100 text-center"
                                >
                                    ¿Olvidaste tú contraseña?
                                </a>
                            </div>
                            <div class="col-12 mt-2 text-center">
                                <a href="/" class="w-100 text-center text-info">
                                    Volver al portal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        empresa: { String, default: "Nombre Empresa" },
        logo: {
            String,
            default:
                "https://www.logodesign.net/logo/eye-and-house-5806ld.png?size=2&industry=All",
        },
        configuracion: {
            String,
            default: "",
        },
        url_registro: {
            type: String,
            default: "/registro",
        },
        url_olvide_mi_contrasenia: {
            type: String,
            default: "/olvide_mi_contrasenia",
        },
    },
    data() {
        return {
            usuario: "",
            password: "",
            error: false,
            fullscreenLoading: false,
        };
    },
    methods: {
        login() {
            this.fullscreenLoading = true;
            axios
                .post("/login", {
                    usuario: this.usuario,
                    password: this.password,
                })
                .then((res) => {
                    let user = res.data.user;
                    setTimeout(() => {
                        this.obtienePermisos(user);
                    }, 50);
                })
                .catch((error) => {
                    console.log(error.response);
                    if (error.response.status == 401) {
                        if (error.response.data.message) {
                            Swal.fire({
                                icon: "info",
                                title: "Acceso restringido",
                                html: `<strong>${error.response.data.message}</strong>`,
                                confirmButtonColor: "#149FDA",
                                confirmButtonText: "Aceptar",
                            });
                        } else {
                            this.error = true;
                        }
                        this.password = "";
                    }
                    this.fullscreenLoading = false;
                });
        },
        obtienePermisos(user) {
            axios.get("/admin/usuarios/getPermisos/" + user.id).then((res) => {
                this.error = false;
                this.$router.push({ name: "inicio" });
                localStorage.setItem("configuracion", this.configuracion);
                localStorage.setItem("permisos", JSON.stringify(res.data));
                localStorage.setItem("user", JSON.stringify(user));
                location.reload();
            });
        },
    },
};
</script>

<style>
.login-page {
    background: #00000081;
}

.login-page .card {
    border-radius: 0px;
    box-shadow: 0px 0px 1px 1px var(--primary);
    background: var(--transparente);
}
.login-page .card-header {
    border-bottom: solid 1px var(--primary);
}
</style>
