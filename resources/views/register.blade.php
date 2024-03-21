
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


@section('auth_header', 'Registrate!')

@section('auth_body')
<form action="" id="RegisterForm">
    
<!-- EMAIL -->
        <div class="input-group mb-3">
        <input type="text" class="form-control" id="email" name="email" placeholder='Email'>
        <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
        </div>
<!-- PASSWORD -->
        <div class="input-group mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder='Password'>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
        </div>

        <button type="submit" id="btnRegister" class="btn btn-success btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>
    </form>
@stop

@section('auth_footer')   
    <p class="my-0">
            <a href="<?= url('inicio')?>">
                Tienes cuenta registrada? Inicia Sesion!
            </a>
        </p>
  
@stop


@section('js')
<script>
   /*Register*/
   jQuery('#btnRegister').on("click", function (event) {
        event.preventDefault();

        let form = document.getElementById('RegisterForm')
        const formData = new FormData(form);
        axios.post('<?= url('register') ?>', formData, {

        })

            .then(response => {
                if (response.data.errors) {

                    console.log(response)
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
                        title: "Tu usuario ha sido añadido",
                        showConfirmButton: false,
                        timer: 1500

                    });
                    setTimeout(function () {
                        $('#LoginForm').trigger("reset")
                    }, 1500)
                }
            });
    });
</script>
@stop
