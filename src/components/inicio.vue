<template>
  <div>
    <cabezera></cabezera>
    <nav>
      <div class="nav-wrapper indigo lighten-4">
          <form>
          <div class="input-field">
              <input id="search" type="search" v-model='buscar' required>
              <label class="label-icon" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
          </div>
          </form>
      </div>
    </nav>
    <div class="container">
        <div class="row" v-for="item in datosFiltrados" :key="item.id">
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                    <span class="card-title"><img :src="item.foto" alt="item.foto" width="50" class="circle">{{item.user}}</span>
                    <span class="card-title">{{item.titulo}}</span>
                        <div class="row">
                            <pre>
                                {{item.codigo}}
                            </pre>
                            <p>{{item.descripcion}}</p>
                            <div class="card-action">
                                <router-link  v-if="item.user == userPost" :to="'/editar/'+item.id">Editar</router-link>
                                <a v-if="item.user == userPost" href="#" @click="eliminar(item.id)">Eliminar</a>
                                <button href="#" v-clipboard="item.codigo">Copiar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
import cabezera from './cabezera'
import axios from 'axios'
import eliminar from '../mixins/eliminar'
export default {
  name: 'Inicio',
  data () {
    return {
      response: '',
      listar: [],
      buscar: '',
      itemId: '',
      act: '',
      userPost: ''
    }
  },
  components: {
    cabezera
  },
  created () {
    this.getCategoria()
    this.getUser()
  },
  computed: {
    datosFiltrados () {
      return this.listar.filter((filtro) => {
        return filtro.titulo.toUpperCase().match(this.buscar.toUpperCase()) || filtro.descripcion.toUpperCase().match(this.buscar.toUpperCase())
      })
    }
  },
  methods: {
    getUser () {
      const token = JSON.parse(this.$localStorage.get('token'))
      axios.get('http://snippets.local/api/crud/getUser.php?token=' + token).then(res => {
        this.userPost = res.data
      })
    },
    getCategoria () {
      axios.get('http://snippets.local/api/crud/getPost.php').then(res => {
        this.listar = res.data
      })
    }
  },
  mixins: [eliminar]
}
</script>
