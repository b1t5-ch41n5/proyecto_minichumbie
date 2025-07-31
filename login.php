
<?php
    // =============================
    // Inclusión de dependencias y protección de sesión
    // =============================
    include 'database/Coneccion.php'; // Conexión a la base de datos
    include 'database/Usuario.php';   // Lógica de usuario y autenticación
    include 'includes/sesion.php';    // Inicia la sesión PHP

    // =============================
    // Si ya hay sesión iniciada y es GET, redirige al home
    // =============================
    if (isset($_SESSION['login']) && $_SERVER['REQUEST_METHOD'] == 'GET'):
        header("Location: home.php");
        exit();
    endif;

    // =============================
    // Lógica de autenticación al enviar el formulario
    // =============================
    if ($_SERVER['REQUEST_METHOD'] == 'POST'):

        // Si se recibieron usuario y contraseña y no hay sesión activa
        if (isset($_POST['userName']) && isset($_POST['password']) && !isset($_SESSION['login'])):
            $nombreUsuario = trim($_POST['userName']); // Sanitiza el usuario
            $Contrasena = trim($_POST['password']);    // Sanitiza la contraseña
            $UsuarioInstancia = new UsuarioDriver($Conexion); // Instancia de usuario
            $ContrasenaHasheada = hash('sha256', $Contrasena); // Hash seguro de la contraseña
            $Credenciales = $UsuarioInstancia->ConsultarUsaurio($nombreUsuario, $ContrasenaHasheada); // Consulta en BD
            if ($Credenciales && is_array($Credenciales)):
                // Si las credenciales son válidas, guarda datos en sesión y redirige
                $_SESSION['id_usuario'] = $Credenciales['id_user'];
                // El campo correcto es 'nombre_de_usuario' según tu base de datos
                $_SESSION['usuario'] = $Credenciales['nombre_de_usuario'];
                $_SESSION['login'] = true;
                header("Location: home.php");
                exit();
            else:
                // Si no son válidas, muestra error de login
                $error_login = true;
            endif;

        // Si falta usuario o contraseña, muestra error de campos vacíos
        elseif (empty($_POST['userName']) or empty($_POST['password'])):
            $error_empty = true;
        endif;
    endif;
?>




<!doctype html>
<html>
<!--
        #cbced1
    -->

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Login - COMPLEMENTARIOS MINICHUMBIE</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <style>
        /* =============================
           Estilos generales y layout del login
        ============================== */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Importación de fuente Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        /* Reset de estilos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Fondo para toda la pantalla con imagen y capa oscura */
        body {
            background: url('img/back.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        body::before {
            /* Capa oscura para mejorar contraste */
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        /* Cuadro de login centrado y con sombra */
        .wrapper {
            position: relative;
            background: #ecf3ee;
            padding: 40px;
            max-width: 350px;
            min-height: 500px;
            margin: 80px auto;
            border-radius: 15px;
            box-shadow: 13px 13px 20px #f40303, -13px -13px 20px #f40303;
        }

        /* Logo circular en la parte superior */
        .logo {
            width: 80px;
            margin: auto;
        }

        .logo img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0px 0px 3px #5f5f5f,
                0px 0px 0px 5px #ecf0f3,
                8px 8px 15px #a7aaa7,
                -8px -8px 15px #fff;
        }

        /* Nombre de la empresa */
        .wrapper .name {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 1.3px;
            padding-left: 10px;
            color: #555;
        }

        /* Campos del formulario de login */
        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.2rem;
            color: #666;
            padding: 10px 15px 10px 10px;
        }

        .wrapper .form-field {
            padding-left: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
        }

        .wrapper .form-field .fas {
            color: #555;
        }

        /* Botón de login */
        .wrapper .btn {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-color: #f40303;
            color: #fff;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1,
                -3px -3px 3px #fff;
            letter-spacing: 1.3px;
        }

        .wrapper .btn:hover {
            background-color: #520606;
        }

        /* Enlaces de ayuda */
        .wrapper a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4;
        }

        .wrapper a:hover {
            color: #039BE5;
        }

        /* Responsive para móviles */
        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px;
            }
        }
    </style>
</head>

<body className='snippet-body'>
    <div class="wrapper">
        <!-- Logo de la empresa -->
        <div class="logo">
            <img src="img/login_in.png" alt="">
        </div>
        <!-- Nombre de la empresa -->
        <div class="text-center mt-4 name">
            COMPLEMENTARIOS MINICHUMBIE
        </div>
        <!-- Mensaje de error si las credenciales son incorrectas -->
        <?php if (isset($error_login) && $error_login): ?>
            <div class="alert alert-danger text-center" role="alert">
                <strong>Error: </strong> Usuario o contraseña incorrectos
            </div>
        <?php endif; ?>
        <!-- Mensaje de error si faltan campos -->
        <?php if (isset($error_empty) && $error_empty): ?>
            <div class="alert alert-danger text-center" role="alert">
                <strong>Error: </strong> Falta el nombre de usuario o la contraseña
            </div>
        <?php endif; ?>
        <!-- Formulario de inicio de sesión -->
        <form class="p-3 mt-3" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="post">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="userName" id="userName" placeholder="Usuario">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Contraseña">
            </div>
            <button class="btn mt-3" >Ingresar</button>
        </form>
    </div>
    <!-- =============================
         Scripts y plugins adicionales
    ============================== -->
    <script type='text/javascript'
        src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript'>
        // Previene el comportamiento por defecto de enlaces vacíos
        var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener('click', function (e) {
            e.preventDefault();
        });
    </script>

</body>

</html>
