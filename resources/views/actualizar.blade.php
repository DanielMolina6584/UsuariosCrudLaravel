<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>Actualizar</title>

    <script>
        axios.defaults.headers.common = {
            "token": '<?= session()->get('token') ?>'
        }
    </script>
</head>

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Actualización de Datos</h1>
@stop

@section('content')
<body>
    <div>
        <div class="col-md-6 offset-md-3">
            
            <form id="FormActualizar" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= isset ($datos['id']) ? $datos['id'] : '' ?>">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                        value="<?= isset ($datos['nombre']) ? $datos['nombre'] : '' ?>">
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" id="apellido" name="apellido"
                        value="<?= isset ($datos['apellido']) ? $datos['apellido'] : '' ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email"
                        value="<?= isset ($datos['email']) ? $datos['email'] : '' ?>">
                </div>

                <div class="form-group">
                    <label for="cel">Celular:</label>
                    <input type="text" class="form-control" id="cel" name="cel"
                        value="<?= isset ($datos['cel']) ? $datos['cel'] : '' ?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="image">Imagen:</label>
                    <img src="<?= $datos['image'] ?>" alt="Imagen de perfil" width="100" height="80">
                </div>
                <br>
                <input type="file" class="form-control" id="image" name="image"> <br>

                <x-adminlte-button class="btn-flat" type="submit" label="Actualizar" theme="success" icon="fas fa-lg fa-save" id="btn-Act"/>
            </form>
        </div>
</body>
</html>
@stop

@section('js')
<script>
    jQuery('#btn-Act').on('click', function (event) {
        event.preventDefault();

        let form = document.getElementById('FormActualizar')
        const formData = new FormData(form);
        axios.post('<?= url('actualizar') ?>', formData, {
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
                        localStorage.removeItem('token')
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }

                } else {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Tu usuario ha sido actualizado",
                        showConfirmButton: false,
                        timer: 1500

                    });
                    setTimeout(function () {

                        location.href = '<?= url('crud') ?>';
                    }, 1000)
                }
            });
    });
</script>
@stop





