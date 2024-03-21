
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
        
    <title>Inicio</title>
</head>

@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])


@section('auth_header', 'Entra con tu cuenta!')

@section('auth_body')
<form action="" id="IniciarForm">       
        <div class="input-group mb-3">
        <input type="text" class="form-control" id="email" name="email" placeholder='Email'>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder='Password'>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
        </div>

        <div class="row">
           

            <div class="col-14">
                <button type=submit id="btnLogin" class="btn btn-block  {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    Iniciar Sesion
                </button>
            </div>
        </div>

    </form>
@stop

@section('auth_footer')   
    <p class="my-0">
            <a href="<?= url('viewRegister')?>">
                Aun no tienes cuenta? Registrate
            </a>
        </p>
  
@stop


@section('js')
<script>
    /*Iniciar Sesion*/
    jQuery('#btnLogin').on("click", function (event) {
        event.preventDefault();

        let form = document.getElementById('IniciarForm')
        const formData = new FormData(form);
        axios.post('<?= url('iniciar') ?>', formData, {

        })

            .then(response => {
                if (response.data.errors) {

                    const errorMessages = Object.values(response.data.errors).join('<br>');

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        html: errorMessages
                    });

                } else {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Tu usuario es correcto",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function () {
                        location.href = '<?= url('crud') ?>'
                    }, 1000)

                }
            });
    });
</script>
@stop

