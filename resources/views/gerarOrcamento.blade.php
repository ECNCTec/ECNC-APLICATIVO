<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Orçamento</title>
</head>

<body>
    @extends('dashboard')
    @section('content')
        <style>
            #form {
                margin: 0px 10px 0px 10px;
            }

            #form-container {
                background: #f8f9fa;
                padding: 10px;
                border: 1px solid #ddd;
                font-size: 12px;
            }

            #form-container label {
                font-weight: bold;
                font-size: 12px;
            }

            #form-container .form-control {
                height: 27px;
                padding: 2px 5px;
                font-size: 12px;
            }

            #form-container select {
                height: 27px;
                font-size: 12px;
            }

            #form-container .btn {
                padding: 3px 10px;
                font-size: 12px;
            }

            .button-adicionar {
                background: linear-gradient(to bottom, #3387fb, #4242ff, #3387fb);
                color: #fff;
                height: 27px;
                padding: 0 20px;
                border: none;
                border-radius: 3px;
                font-size: 13px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                transition: background 0.3s ease;
            }

            .button-enviar {
                background: linear-gradient(to bottom, #32d758, #218838, #32d758);
                color: #fff;
                height: 27px;
                padding: 0 20px;
                border: none;
                border-radius: 3px;
                font-size: 13px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                transition: background 0.3s ease;
            }

            .form-row-wrapper {
                position: relative;
                width: 100%;
            }

            .buttonExcluir {
                position: absolute;
                top: -8px;
                right: 0;
                padding: 5px;
                z-index: 10;
            }

            .buttonExcluir img {
                height: 20px;
            }

            .form-row {
                border: 1px solid rgb(143, 143, 143);
                margin-top: 5px;
                padding: 10px;
            }

            @media (max-width: 768px) {
                #form {
                    margin: 30px 10px 30px 10px;
                }

                .buttonExcluir img {
                    height: 25px;
                }
            }
        </style>
        <div id="form">
        </div>
        <div id="form-container">
            <div class="lucro-multiplicador col-md-2">
                <label>Lucro Miltiplicador:</label>
                <input type="number" name="lucro" class="form-control" required>
            </div>
            <div id="formsContainer">
                <div class="form-row" id="formTemplate">
                    <div class="form-row-wrapper"> <!-- Novo contêiner para o botão -->
                        <a class="buttonExcluir remove-btn d-none" onclick="removeForm(this)">
                            <img src="{{ asset('storage/images/buttonExcluir.png') }}" alt="">
                        </a>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Material:</label>
                        <input type="text" name="material" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Comprimento da Arte:</label>
                        <input type="number" class="form-control comprimentoCalculo" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Largura da Arte:</label>
                        <input type="number" class="form-control larguraCalculo" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Tempo de Usinagem (min):</label>
                        <input type="number" class="form-control tempoUsinagem" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button id="addFormBtn" type="button" class="button-adicionar btn btn-sm d-none d-sm-inline-block mt-1 mr-1"
                onclick="addForm()">Adicionar</button>
            <button type="submit" class="button-enviar btn btn-sm d-none d-sm-inline-block mt-1 mr-2 mb-3">Gerar Orçamento</button>
        </div>
        <div class="mt-2 ml-2 mr-2">
            <button id="addFormBtn" type="button" class="button-adicionar btn btn-sm btn-block d-inline-block d-sm-none"
                onclick="addForm()">Adicionar</button>
            <button type="submit" class="button-enviar btn btn-sm btn-block d-inline-block d-sm-none mb-3">Gerar Orçamento</button>
        </div>
        </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Adiciona um novo formulário ao container
        function addForm() {
            const formsContainer = document.getElementById('formsContainer');
            const formTemplate = document.getElementById('formTemplate');
            const newForm = formTemplate.cloneNode(true);

            newForm.querySelectorAll('input').forEach(input => {
                input.value = '';
                input.classList.remove('is-invalid', 'is-valid');
            });

            newForm.querySelector('.remove-btn').classList.remove('d-none');
            newForm.querySelector('.remove-btn').onclick = () => removeForm(newForm.querySelector('.remove-btn'));

            formsContainer.appendChild(newForm);
            updateRemoveButtons();
        }

        // Remove um formulário
        function removeForm(button) {
            button.closest('.form-row').remove();
            updateRemoveButtons();
        }

        // Controla visibilidade dos botões "Remover"
        function updateRemoveButtons() {
            const forms = document.querySelectorAll('.form-row');
            const showRemove = forms.length > 1;

            forms.forEach(form => {
                const removeButton = form.querySelector('.remove-btn');
                showRemove ? removeButton.classList.remove('d-none') : removeButton.classList.add('d-none');
            });
        }
    </script>

</body>

</html>
