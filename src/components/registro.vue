<template>
  <div>
    <nav class="blue">

    </nav>
    <div class="container center">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                    <span class="card-title">Registro</span>
                        <div class="row">
                            <form action="" id="formRegistro" autocomplete="off" @submit.prevent="register" enctype="multipart/form-data" class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="text" name="user" id="user" required pattern="[A-Za-z]{5,30}" class="validate" value="">
                                        <label for="user">Nombre de Usuario</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="password" v-model="password" name="password" id="password" required pattern="[A-Za-z0-9]{8,15}" class="validate">
                                        <label for="password">Contraseña</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="password" name="confirm-password" v-model="confirmarPassword" id="confirm-password" required pattern="[A-Za-z0-9]{8,15}" class="validate">
                                        <label for="confirm-password">Confirmar Contraseña</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="email" name="email" id="email" required class="validate" @blur="validarCorreo" v-model="correo">
                                        <label for="email" >Correo electronico</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="file-field input-field" style="height: 1rem; bottom:0;">
                                        <div class="btn">
                                            <span>Imagen de Perfil</span>
                                            <input type="file" name="foto">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                        <label for="foto">Imagen de Perfil</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="submit" value="Registrar usuario" :class="boton">
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="card-action">
                      <router-link to="/">Iniciar Sesión</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
import swal from 'sweetalert'
import axios from 'axios'
export default {
  name: 'registro',
  data () {
    return {
      password: '',
      confirmarPassword: '',
      response: '',
      correo: '',
      boton: 'btn blue disabled',
      menu: false
    }
  },
  methods: {
    register () {
      if (this.password === this.confirmarPassword) {
        const form = document.getElementById('formRegistro')
        console.log(new FormData(form))
        axios.post('http://snippets.local/api/loginRegistro/registro.php', new FormData(form)).then(res => {
          this.response = res.data
          console.log(res.data)
          this.direccionamiento()
        })
      } else {
        swal({
          icon: 'error',
          title: 'Error',
          text: 'Las contraseñas no coinsiden'
        })
      }
    },
    direccionamiento () {
      if (this.response === 'success') {
        console.log(this.response)
        this.$router.push('/')
      } else {
        swal({
          icon: 'error',
          title: 'Error',
          text: 'No se pudo registrar'
        })
      }
    },
    validarCorreo () {
      if (this.validEmail(this.correo)) {
        const formData = new FormData()
        formData.append('correo', this.correo)
        axios.post('http://snippets.local/api/loginRegistro/validarEmail.php', formData).then(res => {
          this.response = res.data
          console.log(this.response)
          if (this.response === 'success') {
            this.boton = 'btn blue'
          } else {
            swal({
              icon: 'error',
              title: 'Error',
              text: 'El correo ya existe'
            })
          }
        })
      } else {
        swal({
          icon: 'error',
          title: 'Error',
          text: 'Escribe el correo de forma correcta'
        })
      }
    },
    validEmail: function (email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      return re.test(email)
    }
  }

}
</script>
