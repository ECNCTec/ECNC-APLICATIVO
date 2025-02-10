<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formLogin</title>
    <style>

        .card {
            background-color: #ffffffc4;
            padding: 30px;
            box-shadow: 0px 10px 13px -7px #262626;
            height: auto;
            width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #0f3540;
        }

        .label-float input {
            width: 100%;
            padding: 5px;
            display: inline-block;
            border: 0;
            border-bottom: 2px solid #0f3540;
            background-color: transparent;
            outline: none;
            min-width: 180px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease-out;
            border-radius: 0;
        }

        .label-float {
            position: relative;
            padding-top: 13px;
            margin-top: 5%;
            margin-bottom: 5%;
        }

        .label-float input:focus {
            border-bottom: 2px solid #8a897b;
        }

        .label-float label {
            color: #0f3540;
            pointer-events: none;
            position: absolute;
            top: 0;
            left: 0;
            margin-top: 13px;
            transition: all 0.3s ease-out;
        }

        .label-float input:focus+label,
        .label-float input:valid+label {
            font-size: 11px;
            margin-top: 0;
            color: #8a897b;
        }

        .button {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-bottom: 20px;
        }

        button {
            background-color: transparent;
            color: #0f3540;
            font-weight: bold;
            padding: 9px;
            border-radius: 20px;
            width: 60%;
            cursor: pointer;
            margin-top: 20px;
            border: 2px solid #0f3540;
            outline: none;
        }

        button:hover {
            background-color: #0f3540;
            color: #fff;
            transition: all 0.3s ease-out;
        }

        .justify-center {
            display: flex;
            justify-content: center;
        }

        .hr {
            display: flex;
            justify-content: center;
        }

        hr {
            margin: 10% 0;
            width: 70%;
        }

        p {
            font-size: 23px;
            color: #0f3540;
            font-size: 11px;
            text-align: center;
        }

        a {
            font-size: 13px;
            color: #0e172a;
            font-weight: bold;
            text-decoration: none;
        }

        a:hover {
            color: #8a897b;
            transition: all 0.3s ease-out;
        }

        .fa-eye {
            position: absolute;
            top: 13px;
            right: 10px;
            cursor: pointer;
            color: #0f3540;
        }

        #msgError {
            text-align: center;
            color: #ff0000;
            background-color: #ffbbbb;
            padding: 10px;
            display: none;
        }

        @media (max-width: 768px) {
            .card {
            margin: 0px 10px 0px 10px;
            background-color: #ffffffc4;
            padding: 30px;
            box-shadow: 0px 10px 13px -7px #262626;
            height: auto;
            width: 400px;
        }
        }
    </style>
</head>

<body>
    <div class="conteiner">
        <div class="card">
            <div>
                <h1><img src="{{ asset('storage/images/logo.png') }}" alt=""></h1>
            </div>
            <h1>Login</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="label-float">
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    <label for="email">Email:</label>
                </div>
                <div class="label-float">
                    <input type="password" name="password" required>
                    <label for="password">Senha:</label>
                </div>
                <input type="hidden" name="access_level" value="usuario">
                <div class="button">
                    <button type="submit">Entrar</button>
                </div>
                <div>
                    @if (session('success'))
                        <div class="message success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="message error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="message error">{{ session('error') }}</div>
                    @endif
                </div>
            </form>            
            <p>Não tem uma conta? <a href="{{ route('register.form') }}">Cadastre-se</a></p>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const messages = document.querySelectorAll('.message');

            messages.forEach(function(message) {
                setTimeout(function() {
                    message.style.transition = 'opacity 1s ease-out';
                    message.style.opacity = '0';

                    setTimeout(function() {
                        message.remove();
                    }, 1000);
                }, 5000);
            });
        });
    </script>
</body>

</html>
