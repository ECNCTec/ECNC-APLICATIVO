<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script>
        // Impede a navegação para trás
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.pushState(null, null, location.href);
        };
    </script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");

        * {
            margin: 0;
            padding: 0;
            font-family: "Roboto", sans-serif;
        }

        body {
            background-image: url(https://img.freepik.com/fotos-gratis/renderizacao-3d-de-fundo-de-textura-hexagonal_23-2150796421.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        .conteiner {
            display: flex;
            justify-content: center;
            align-items: center;
            display: flex;
            justify-content: center;
            height: 100vh;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="conteiner">
        @include('formLogin')
    </div>
</body>

</html>
