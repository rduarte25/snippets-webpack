import Vue from 'vue'
import Router from 'vue-router'
import IniciarSesion from '@/components/iniciarSesion'
import Registro from '@/components/registro'
import Inicio from '@/components/inicio'
import Categorias from '@/components/categorias'
import Alta from '@/components/alta'
import Editar from '@/components/editar'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'IniciarSesion',
      component: IniciarSesion
    },
    {
      path: '/registro',
      name: 'Registro',
      component: Registro
    },
    {
      path: '/inicio',
      name: 'Inicio',
      component: Inicio
    },
    {
      path: '/categorias/:cat',
      name: 'categorias',
      component: Categorias
    },
    {
      path: '/alta',
      name: 'alta',
      component: Alta
    },
    {
      path: '/editar/:id',
      name: 'editar',
      component: Editar
    }

  ]
})
