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

<main id="mainColaborador">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Dados do Perfil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="dadosPerfil" class="mt-3">

                <div id="imgPerfil"></div>

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

    <h2 class="text-center mt-2">LANÇAMENTO DE NOTAS </h2>
    <h4 class="text-center">Escola Tech</h4>

    <section id="selecionarTurma">
        <div class="card">
            <div class="conteudoCardAalunos">
                <select name="" id="turma" onchange="getAlunosPorTurma()">

                </select>

                <div class="containerContadorAlunos">
                    <div class="cardContadorAlunos">
                        <h4>totais de alunos</h4>

                        <p id="totaisAlunosPorTurma"></p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="tabelaTurma">
        <div class="card">
            <table class="table table-striped" id="tabelaDEfuncAtivos">
                <thead>
                    <tr>
                        <th class="text-center">nome</th>
                        <th class="text-center">Primeiro B</th>
                        <th class="text-center">Segundo B</th>
                        <th class="text-center">Terceiro B</th>
                        <th class="text-center">Quarto B</th>
                        <th class="text-center">Nota Final</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody id="resTabelaAluno"></tbody>
            </table>
        </div>

    </section>

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

<div class="modal" tabindex="-1" id="modalEditarAluno">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Aluno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Turma: <span id="nomeTurma" class="mb-4 text-primary fw-bold"></span></p>
                <div class="row">
                    <div class="card shadow-sm p-4">
                        <h6 class="mb-4 text-primary fw-bold">Dados pessoais</h6>

                        <input type="hidden" name="" id="idEdit">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nomAlunEdit" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nomAlunEdit" placeholder="Digite o nome">
                            </div>

                            <div class="col-md-6">
                                <label for="telAlunEdit" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telAlunEdit" placeholder="(00) 00000-0000">
                            </div>

                            <div class="col-md-4">
                                <label for="dtNascAlunEdit" class="form-label">Data de nascimento</label>
                                <input type="date" class="form-control" id="dtNascAlunEdit">
                            </div>

                            <div class="col-md-8">
                                <label for="endAlunEdit" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endAlunEdit"
                                    placeholder="Rua, número, bairro">
                            </div>
                        </div>


                        <button type="button" class="btn btn-primary mt-3" onclick="salvarEditPessoalAluno()">Salvar
                            dados pessoais</button>

                    </div>

                </div>
                <div class="row mt-2">
                    <div class="card shadow-sm p-4">
                        <h5 class="mb-4 text-primary fw-bold">Notas</h5>

                        <div class="row">
                            <!-- BLOCO 1 -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Período</label>
                                    <select class="form-select form-select-sm w-50" id="periodoNotas">

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Editar uma nota</label>
                                    <input type="number" class="form-control w-50" id="notaEdit1" min="0">
                                </div>

                                <button class="btn btn-primary btn-sm" onclick="salvarEditNotas()">
                                    Editar nota
                                </button>
                            </div>

                            <!-- BLOCO 2 -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Período</label>
                                    <select class="form-select form-select-sm w-50" id="periodoNotas2">

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Adicione uma nota</label>
                                    <input type="number" class="form-control w-50" id="notaEdit2" min="0">
                                </div>

                                <button class="btn btn-success btn-sm" onclick="adicionarNota()">
                                    Adicionar nota
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




<?php

include_once __DIR__ . '/../projetoescola/assets/pages/footer.php';

?>

<script src="assets/js/datatable.js"></script>
<script src="assets/js/colaborador.js"></script>
<script src="assets/js/lancamentoNota/lancamentoNota.js"></script>