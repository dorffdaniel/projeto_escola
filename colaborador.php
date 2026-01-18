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
                        <a class="btn btn-primary" aria-current="page" href="#">Cadastrar alunos</a>
                    </li>
                    <li class="nav-item m-2">
                        <a class="btn btn-primary" href="#">Lançar notas</a>
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
                <button class="btn btn-warning">editar dados</button>
            </div>
        </div>
    </div>

</main>





<?php

include_once __DIR__ . '/../projetoescola/assets/pages/footer.php';

?>

<script src="assets/js/colaborador.js"></script>