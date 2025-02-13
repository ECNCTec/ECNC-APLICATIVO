<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fafafa;
        }

        .buttonSideBar img {
            height: 30px;
            margin: 0px;
            margin-left: -10px;
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            font-weight: 300;
            line-height: 1.7em;
            color: #999;
        }

        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 0;
            margin-bottom: 10px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar-btn {
            box-shadow: none;
            outline: none !important;
            border: none;
        }

        .line {
            width: 100%;
            height: 1px;
            border-bottom: 1px dashed #ddd;
            margin: 0px 0;
        }

        /* ---------------------------------------------------
            SIDEBAR STYLE
        ----------------------------------------------------- */

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: linear-gradient(45deg, #5790d6, #477cbd, #5790d6, #477cbd);
            color: #fff;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            background: linear-gradient(0deg, #477cbd, #5790d6, #477cbd);
            padding: 20px;
        }

        .sidebar-header {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sidebar-header img {
            height: 45px;
        }

        #sidebar ul.components {
            padding-top: 20px;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1em;
            display: block;
            color: #fff;
            text-decoration: none;
        }

        #sidebar ul li a:hover {
            color: rgb(65, 65, 65);
            background: #fff;
        }

        #sidebar ul li a.active {
            color: rgb(73, 73, 73);
            background: #fff;
        }

        .content {
            max-height: 100vh;
            overflow-y: auto;
        }

        .clientes-dropdown {
            border-bottom: 0.3px solid rgba(255, 255, 255, 0.526);
        }

        .produtos-dropdown {
            border-bottom: 0.3px solid rgba(255, 255, 255, 0.526);
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out;
        }

        .submenu a::before {
            content: "• ";
            color: rgb(60, 60, 60);
            font-size: 18px;
        }

        .submenu.open {
            max-height: 300px;
        }

        .submenu.closing {
            max-height: 0;
            transition: max-height 0.5s ease-in;
        }

        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        .btn-custom {
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
            line-height: 1;
            min-height: 30px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        ul ul a {
            font-size: 0.9em !important;
            padding-left: 30px !important;
            background: #6d7fcc;
        }

        ul.CTAs {
            padding: 0px 20px 0px 20px;
        }

        ul.CTAs a {
            text-align: center;
            font-size: 0.9em !important;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        a.download {
            background: linear-gradient(0deg, #a0a0a0, #686868, #a0a0a0);
            color: #7386D5;
        }

        a.article,
        a.article:hover {
            background: linear-gradient(0deg, #7386D5, #384b99, #7386D5) !important;
            color: #fff !important;
        }

        a.sair {
            background: linear-gradient(0deg, #305d77, #24495f, #305d77);
            color: #7386D5;
        }

        .list-unstyled a {
            color: #ffffff;
            text-decoration: none;
        }

        /* ---------------------------------------------------
            CONTENT STYLE
        ----------------------------------------------------- */

        #content {
            background: linear-gradient(90deg, #dcdcdc, #eeeeee, #e8e8e8, #eeeeee, #dcdcdc);
            background-size: cover;
            background-position: center;
            width: 100%;
            padding: 0px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .top-container {
            padding: 5px;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        /* ---------------------------------------------------
            MEDIAQUERIES
        ----------------------------------------------------- */

        @media (max-width: 768px) {
            .buttonSideBar img {
                margin-top: -5px;
                margin-left: 5px;
            }

            #sidebar {
                margin-left: -250px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            .top-container {
                padding-bottom: 10px;
            }
        }

        /* ---------------------------------------------------
        SIDEBAR STYLE PARA TELAS PEQUENAS
        ----------------------------------------------------- */
        @media (max-width: 768px) {
            #sidebar {
                min-width: 100%;
                max-width: 100%;
                position: fixed;
                top: 0;
                left: -100%;
                height: 100%;
                z-index: 9999;
                transition: left 0.3s ease;
            }

            #sidebar.active {
                left: 0;
            }

            #sidebar ul li a {
                padding: 15px;
            }

            #sidebarCollapse {
                position: absolute;
                top: 20px;
                right: 10px;
                z-index: 10000;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('storage/images/logo2.png') }}" alt="">
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="dashboardAnaliseDados"><i class="fas fa-user-plus" style="margin: 0px 6px 0px 12px;"></i> Dashboard</a>
                </li>
                <li class="{{ request()->routeIs('gerarOrcamento') ? 'active' : '' }}">
                    <a href="{{ route('gerarOrcamento') }}"><i class="fas fa-file-alt"
                            style="margin: 0px 8px 0px 12px;"></i> Gerar Orçamento</a>
                </li>
                <li>
                    <a href="#" id="clientesDropdownToggle" class="clientes-dropdown" aria-expanded="false"
                        style="padding-left: 21px;">Clientes</a>
                    <div id="clientesSubmenu" class="submenu">
                        <a href="{{ route('cadastroClientes') }}" style="padding-left: 39px;">Cadastrar</a>
                        <a href="#" style="padding-left: 39px;">Cadastrados</a>
                        <a href="#" style="padding-left: 39px;">Relatório</a>
                    </div>
                </li>
                <li>
                    <a href="#" id="fornecedorDropdownToggle" class="produtos-dropdown" aria-haspopup="false"
                        style="padding-left: 21px;" aria-expanded="false">Fornecedores</a>
                    <div id="fornecedorSubmenu" class="submenu">
                        <a href="{{ route('cadastroFornecedor')}}" style="padding-left: 39px;">Cadastrar</a>
                        <a href="#" style="padding-left: 39px;">Item 2</a>
                        <a href="#" style="padding-left: 39px;">Item 3</a>
                    </div>
                </li>   
                <li>
                    <a href="#" id="produtosDropdownToggle" class="produtos-dropdown" aria-expanded="false"
                        style="padding-left: 21px;">Produtos</a>
                    <div id="produtosSubmenu" class="submenu">
                        <a href="{{ route('cadastroProdutos') }}" style="padding-left: 39px;">Cadastrar</a>
                        <a href="#" style="padding-left: 39px;">Cadastrados</a>
                        <a href="#" style="padding-left: 39px;">Relatório</a>
                    </div>
                </li> 
                <li>
                    <a href="#" id="estoqueDropdownToggle" class="estoque-dropdown" aria-expanded="false"
                        style="padding-left: 21px;">Estoque</a>
                    <div id="estoqueSubmenu" class="submenu">
                        <a href="{{ route('cadastroEstoque') }}" style="padding-left: 39px;">Cadastrar</a>
                        <a href="{{ route('estoque') }}" style="padding-left: 39px;">Produtos em Estoque</a>
                        <a href="#" style="padding-left: 39px;">Relatório</a>
                    </div>
                </li>          
                <li>
                    <a href="#"><i class="fas fa-user-plus" style="margin: 0px 6px 0px 12px;"></i> Clientes
                        Cadastrados</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-chart-line" style="margin: 0px 10px 0px 12px;"></i>
                        Relatórios</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-cogs" style="margin: 0px 6px 0px 12px;"></i> Configurações</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-headset" style="margin: 0px 10px 0px 12px;"></i> Suporte</a>
                </li>
            </ul>
            <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip"
                        class="download btn-custom">Download</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article btn-custom">Site</a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="sair btn-custom">Sair</a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <div id="content" class="content">
            {{-- <p>Bem-vindo, {{ auth()->user()->email }}!</p> --}}
            <nav class="top-container navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a href="#" id="sidebarCollapse" class="buttonSideBar">
                        <span><img src="{{ asset('storage/images/iconMenu.png') }}" alt=""></span>
                    </a>
                </div>
                <div class="container-fluid d-none d-md-flex justify-content-end">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="buttonSideBar"
                            style="background: transparent; border: none; padding: 0; outline: none;">
                            <span style="font-size: 24px; color: #555;">
                                <i class="fas fa-times"></i>
                            </span>
                        </button>
                    </form>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>
    <!-- Carregue o jQuery primeiro -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Carregue o Popper.js (necessário para o Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>

    <!-- Carregue o Bootstrap.js depois -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Código adicional para os links e sidebar -->
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });

            // Gerencia a adição da classe "active" nos links
            document.querySelectorAll('#sidebar ul li a').forEach(link => {
                link.addEventListener('click', function() {
                    document.querySelectorAll('#sidebar ul li a').forEach(link => {
                        link.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        });
    </script>
    <!-- Código para controlar a abertura e fechamento dos dropdowns -->
    <script> 
        document.addEventListener('DOMContentLoaded', function() {
            var clientesDropdownToggle = document.getElementById('clientesDropdownToggle');
            var produtosDropdownToggle = document.getElementById('produtosDropdownToggle');
            var fornecedorDropdownToggle = document.getElementById('fornecedorDropdownToggle');
            var estoqueDropdownToggle = document.getElementById('estoqueDropdownToggle'); 
    
            var clientesSubmenu = document.getElementById('clientesSubmenu');
            var produtosSubmenu = document.getElementById('produtosSubmenu');
            var fornecedorSubmenu = document.getElementById('fornecedorSubmenu');
            var estoqueSubmenu = document.getElementById('estoqueSubmenu');
    
            clientesDropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                clientesSubmenu.classList.toggle('open');
                var isExpanded = clientesSubmenu.classList.contains('open');
                clientesDropdownToggle.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            });
    
            produtosDropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                produtosSubmenu.classList.toggle('open');
                var isExpanded = produtosSubmenu.classList.contains('open');
                produtosDropdownToggle.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            });
    
            fornecedorDropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                fornecedorSubmenu.classList.toggle('open');
                var isExpanded = fornecedorSubmenu.classList.contains('open');
                fornecedorDropdownToggle.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            });
    
            estoqueDropdownToggle.addEventListener('click', function(e) { 
                e.preventDefault();
                estoqueSubmenu.classList.toggle('open');
                var isExpanded = estoqueSubmenu.classList.contains('open');
                estoqueDropdownToggle.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            });
        });
    </script>
</body>

</html>
