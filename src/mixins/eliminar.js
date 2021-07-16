import axios from 'axios'
import Swal from 'sweetalert'
export default {
  methods: {
    eliminar (id) {
      Swal({
        icon: 'warning',
        title: '¿Estas seguro que deseas eliminar el Post?',
        text: 'Al eliminarlo no podras recuperarlo',
        buttons: true,
        dangerMode: true,
        showCancelButton: true
      }).then((aceptar) => {
        if (aceptar) {
          axios.get('http://snippets.local/api/crud/eliminar.php?id=' + id).then(res => {
            //  this.getCategoria

            if (res.data === 'success') {
              Swal({
                icon: 'success',
                title: 'Post Eliminado',
                text: 'Post Eliminado',
                button: 'Ok'
              })
              this.getCategoria()
            } else {
              Swal({
                icon: 'error',
                title: 'Post No Eliminado',
                text: 'Post No Eliminado',
                button: 'Ok'
              })
            }
          })
        } else {
          return false
        }
      })
    }
  }
}
