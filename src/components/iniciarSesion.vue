<template>
  <div>
    <nav class="blue">

    </nav>
    <div class="container center">
      <div class="row">
          <div class="col s12 m12 l12">
              <div class="card">
                  <div class="card-content">
                  <span class="card-title">Iniciar Sesión</span>
                      <form action="" id="iniciaSesion" autocomplete="off" @submit.prevent="login">
                              <div class="row">
                                  <div class="input-field col s12">
                                      <input type="email" name="email" id="email" required class="validate">
                                      <label for="email" >Correo electronico</label>
                                  </div>
                              </div>
                          <div class="row">
                              <div class="input-field col s12">
                                  <input type="password" name="password" id="password" required pattern="[A-Za-z0-9]{8,15}" class="validate">
                                  <label for="password">Contraseña</label>
                              </div>
                          </div>
                          <div class="row">
                              <input type="submit" value="Entrar" class="btn blue">
                          </div>
                      </form>
                  </div>
                  <div class="card-action">
                    <router-link to="registro">Registrarse</router-link>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
</template>

<script>
import Swal from 'sweetalert'
import axios from 'axios'
export default {
  name: 'IniciarSesion',
  data () {
    return {
      password: '',
      confirmarPassword: '',
      response: '',
      correo: '',
      boton: 'btn blue disabled',
      menu: false,
      msg: ''
    }
  },
  methods: {
    login () {
      const form = document.getElementById('iniciaSesion')
      axios.post('http://snippets.local/api/loginRegistro/login.php', new FormData(form)).then(res => {
        this.response = res.data
        if (this.response.response === 'success') {
          this.$localStorage.set('token', JSON.stringify(this.response.token))
          this.$router.push('inicio')
        } else {
          Swal({
            icon: 'error',
            title: 'Error',
            text: 'Datos incorrectos'
          })
        }
      })
    }
  },
  created () {
    const token = JSON.parse(this.$localStorage.get('token'))
    // this.$localStorage.remove('token')
    if (token) {
      this.$router.push('inicio')
    }
  }
}
</script>
