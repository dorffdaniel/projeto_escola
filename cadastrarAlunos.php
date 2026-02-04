<?php

include_once __DIR__ . '/../projetoescola/assets/pages/head.php';

?>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <a class="btn btn-warning " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample">
                    Infos
                </a>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item m-2">
                        <a class="btn btn-primary" href="colaborador.php">Lançar notas</a>
                    </li>

                    <li class="nav-item m-2">
                        <a class="btn btn-primary" aria-current="page" href="cadastrarAlunos.php">Cadastrar alunos</a>
                    </li>

                </ul>

                <button type="submit" class="btn btn-outline-danger" onclick="logout()">Sair</button>

            </div>
        </div>
    </nav>

</header>

<main>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Dados do Perfil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="dadosPerfil" class="mt-3">
                <p>Nome: <span id="nomeColab"></span></p>
                <p>Cpf: <span id="cpfColab"></span></p>
                <p>Data Nascimento: <span id="dtNascColab"></span></p>
                <p>Email: <span id="emailColab"></span></p>
                <p>Telefone: <span id="telColab"></span></p>
                <p>Endereço: <span id="endColab"></span></p>
            </div>
            <div class="dropdown mt-3 text-center mt-5">
                <button class="btn btn-warning" onclick="editarDados()">editar dados</button>
            </div>
        </div>
    </div>

    <div class="row m-0">
        <div class="col-12 d-flex justify-content-center mt-3">
            <div class="col-5 m-2">
                <div class="card p-2">
                    <h3 class="mb-3">Cadastrar uma turma</h3>
                    <p>a turma sera criada no ano que se encontra de momento </p>
                    <input type="text" class="form-control w-50" placeholder="Digite o nome da turma" id="novaTurma">
                    <button class="btn btn-primary mt-4 w-25" onclick="cadastrarTurma()">adicionar turma</button>


                </div>
            </div>
            <div class="col-5 m-2">
                <div class="card p-3">
                    <h3 class="mb-2">Cadastrar aluno</h3>
                    <select name="" id="turmaCadAlun" class="w-25 mb-3">

                    </select>

                    <input type="text" class="form-control w-75 mb-2" placeholder="nome do aluno" id="nomeAlunCad">

                    <input type="date" class="form-control w-75 mb-2" id="dataAlunCad">

                    <input type="text" class="form-control w-75 mb-2" placeholder="telefone do aluno" id="telAlunCad">

                    <input type="text" class="form-control w-75 mb-2" placeholder="endereco do aluno" id="endAlunCad">

                    <button onclick="cadastrarAlunos()" class="btn btn-primary w-25">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row m-0">
        <div class="col-12 d-flex align-items-center justify-content-center ">
            <div class="col-5 m-2">
                <div class="card p-2">
                    <h3 class="mb-3">Cadastrar uma turma</h3>
                    <p>a turma sera criada no ano que se encontra de momento </p>
                    <input type="text" class="form-control w-50" placeholder="Digite o nome da turma" id="novaTurma">
                    <button class="btn btn-primary mt-4 w-25" onclick="cadastrarTurma()">adicionar turma</button>


                </div>
            </div>
            <div class="col-5 m-2">
                <div class="card">
                    <h3>Cadastrar aluno</h3>
                </div>
            </div>
        </div>
    </div>
 -->



</main>


<div class="modal" tabindex="-1" id="modalEditColab">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar dados pessoais</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nomAlunEdit" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomColabEdit" placeholder="Digite o nome">
                    </div>

                    <div class="col-md-6">
                        <label for="telAlunEdit" class="form-label">Cpf</label>
                        <input type="text" class="form-control" id="cpfColabEdit">
                    </div>

                    <div class="col-md-4">
                        <label for="dtNasColabEdit" class="form-label">Data de nascimento</label>
                        <input type="date" class="form-control" id="dtNasColabEdit">
                    </div>

                    <div class="col-md-8">
                        <label for="endAlunEdit" class="form-label">Email</label>
                        <input type="text" class="form-control" id="emailColabEdit">
                    </div>

                    <div class="col-md-8">
                        <label for="endAlunEdit" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telColabEdit">
                    </div>

                    <div class="col-md-8">
                        <label for="endColabEdit" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="endColabEdit" placeholder="Rua, número, bairro">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="salvarDadosPessoais()">Salvar</button>
            </div>
        </div>
    </div>
</div>




<?php

include_once __DIR__ . '/../projetoescola/assets/pages/footer.php';

?>
<script src="assets/js/colaborador.js"></script>
<script src="assets/js/cadastrarAlunos/cadastrarAlunos.js"></script>