<template>
  <div>
    <nav class="blue">
      <div class="nav-wrapper" v-if="menu == true">
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><router-link to="/alta"><i class="material-icons">add</i></router-link></li>
          <li><router-link to="/inicio"><i class="material-icons">home</i></router-link></li>
          <li><router-link to="/categorias/php">PHP</router-link></li>
          <li><router-link to="/categorias/css">CSS</router-link></li>
          <li><router-link to="/categorias/html5">HTML5</router-link></li>
          <li><router-link to="/categorias/vue">VUE</router-link></li>
          <li><router-link to="/categorias/mysql">MYSQL</router-link></li>
          <li><a href="#" @click="salir">Salir</a></li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  name: 'Cabezera',
  data () {
    return {
      datos: '',
      menu: true,
      response: '',
      listar: [],
      buscar: '',
      itemId: '',
      formEditar: '',
      act: '',
      userPost: ''
    }
  },
  methods: {
    salir () {
      const token = JSON.parse(this.$localStorage.get('token'))
      axios.get('http://snippets.local/api/loginRegistro/salir.php?token=' + token).then(res => {
        this.response = res.data
        if (this.response === 'success') {
          this.$localStorage.remove('token')
          this.$router.push('/')
        }
      })
    }
  }
}
</script>
