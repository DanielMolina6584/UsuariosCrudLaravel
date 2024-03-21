

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

<h2>Formulario de Registro</h2>

@stop
@section('content')


    <div class="col-md-6 offset-md-3">

        <form id="miFormulario" enctype="multipart/form-data">

            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">

            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" id="apellido" name="apellido">

            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email">

            <label for="cel">Celular:</label>
            <input type="text" class="form-control" id="cel" name="cel">

            <label for="image">Imagen:</label>
            <input type="file" class="form-control" id="image" name="image"><br>

            <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success" icon="fas fa-lg fa-save" id="btnGuardar"/>
        </form>
    </div>


@stop


@section('css')
<style>
    body {
        background-color: cornflowerblue
    }

</style>
@stop


@section('js')
<script>


    /**************************Agregar************************************ */


    jQuery('#btnGuardar').on("click", function (event) {
        event.preventDefault();

        let form = document.getElementById('miFormulario')
        const formData = new FormData(form);
        axios.post('<?= url('crear') ?>', formData, {


        })
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
                        position: "center",
                        icon: "success",
                        title: "Tu usuario ha sido añadido",
                        showConfirmButton: false,
                        timer: 1500

                    });
                    setTimeout(function () {
                        location.reload();

                    }, 1500);
                }
            })
            .catch(error => {
                console.error('Error:', error);

            });
    });


</script>
@stop