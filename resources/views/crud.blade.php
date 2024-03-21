<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css ">
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <script>
        axios.defaults.headers.common = {
            "token": '<?= session()->get('token') ?>'
        }
    </script>
    <title>Users</title>
</head>


    
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Usuarios</h1>
    @stop
    @section('content')
    
    <body>
    <x-adminlte-button label="Logout" theme="danger" icon="fas fa-ban" onclick="logout()"/>
   
    <div class="divTable">

    <table id="miTabla" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Celular</th>
                <th>Imagen</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
    <tbody>
        <?php foreach ($datos as $usuario): ?>
            <tr>
                <td>
                    <?= $usuario['id'] ?>
                </td>
                <td>
                    <?= $usuario['nombre'] ?>
                </td>
                <td>
                    <?= $usuario['apellido'] ?>
                </td>
                <td>
                    <?= $usuario['email'] ?>
                </td>
                <td>
                    <?= $usuario['cel'] ?>
                </td>
                <td>
                    <?php    if (!empty ($usuario['image'])): ?>
                        <img src="<?= url($usuario['image']) ?>" alt="Imagen de Usuario" width="100" height="80">
                    <?php    else: ?>
                        Sin imagen
                    <?php    endif; ?>
                </td>
            <td>
              <a href="<?= url('obtenerId?id=' . $usuario['id']) ?>">
              <button class="btn btn-success">
                            <i class="fas fa-info-circle" ></i> 
                        </button>          
                        </a>
                </td>
                <td>
                <button class="btn btn-danger" onclick="confirmarEliminacion(<?= $usuario['id']; ?>)" padding='3px 30px'>
                    <i class="fas fa-lg fa-trash" ></i> 
                
                </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</body>

</html>
@stop


@section('css')
    <style>
        body {
            background-color: cornflowerblue
        }

        .divTable {
            margin: 0 60px;
        }

        a {
            text-decoration: none;
            color: black;
        }

        button {
            border: black 2px solid;
            border-radius: 10px;
        }

        tr {
            text-align: center;
        }
    </style>
    @stop


    @section('js')
    <script>

new DataTable('#miTabla');


/**********************Eliminar******************************/

function confirmarEliminacion(id) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás deshacer esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarlo",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            console.log(id);
            eliminarUsuario(id);
        }
    });

}
function eliminarUsuario(id) {

    axios.get('<?= url('eliminar?id=') ?>' + id)
        .then(response => {
            if (response.data.errors) {
                const errorMessages = Object.values(response.data.errors).join('<br>');
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    html: errorMessages
                });
                if (response.data.error == false) {
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            } else {

                Swal.fire({
                    title: "Borrado!",
                    text: "Tu usuario ha sido borrado.",
                    icon: "success"
                });
                setTimeout(function () {
                    location.reload();
                }, 1000)
            }

        })
        .catch(errore => {
            console.error('Error:', error);
        });
}


/********************Logout*******************/

function logout() {
    axios.get('<?= url('logout') ?>')
    setTimeout(function () {
        location.reload()
    }, 300)

}
</script>
    @stop

        
    
