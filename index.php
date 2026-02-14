<?php

include_once __DIR__ . '/../projetoescola/assets/pages/head.php';

?>

<main class="main">

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center flex-column g-2">
            <div id="cardLogin" class="col-6 cardInicial">
                <h2 class="text-center">Login</h2>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Email: </label>
                    <input type="email" class="form-control" id="emailLogin" placeholder="Digite o nome de usuario">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Senha: </label>
                    <input type="password" class="form-control" id="senhaLogin" placeholder="Digite sua senha">
                </div>

                <button type="button" class="btn btn-primary mb-2" onclick="login()">Entrar</button>

                <p>nao tem uma conta <span onclick="btnCadastrar()">Cadastrar</span></p>

            </div>

            <div id="cardCad" class="col-6 cardInicial ocultar">
                <h2 class="text-center">Cadastrar</h2>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Nome: </label>
                    <input type="text" class="form-control" id="nomeCad" placeholder="Digite seu nome">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Cpf: </label>
                    <input type="number" class="form-control" id="cpfCad" placeholder="Digite seu cpf">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Data Nascimento: </label>
                    <input type="date" class="form-control" id="dataCad">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Email: </label>
                    <input type="email" class="form-control" id="emailCad" placeholder="Digite seu email">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Telefone: </label>
                    <input type="number" class="form-control" id="telCad" placeholder="Digite seu telefone">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Endereço: </label>
                    <input type="text" class="form-control" id="endCad" placeholder="Digite seu endereço">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Senha: </label>
                    <input type="password" class="form-control" id="senhaCad" placeholder="Digite uma senha">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Adicione uma foto: </label>
                    <input type="file" class="form-control" id="imgPerfil">
                </div>

                <button type="button" class="btn btn-primary mb-2" onclick="cadastrar()">Cadastrar</button>

                <p>ja tenho uma conta <span onclick="btnLogin()">Login</span></p>

            </div>
        </div>
    </div>

</main>

<?php

include_once __DIR__ . '/../projetoescola/assets/pages/footer.php';

?>