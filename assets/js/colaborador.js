
function getColaborador() {
    let dados = new FormData();
    dados.append('op', 'getColab');

    $.ajax({
        url: 'assets/controller/colaborador/controllerColab.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (resp) {

            if (resp.erro) {
                console.log(resp.erro);
            }

            console.log(resp)
            $("#nomeColab").html(resp.nome);
            $("#cpfColab").html(resp.cpf);
            $("#dtNascColab").html(resp.dataNasc);
            $("#emailColab").html(resp.email);
            $("#telColab").html(resp.telefone);
            $("#endColab").html(resp.endereco);
            if (resp.imgPerfil) {
                let img = `<img src="assets/imagens/imgColab/${resp.imgPerfil}" id="fotoPerfilColab">`;
                $("#imgPerfil").html(img);
            } else {
                let img = `<img src="assets/imagens/imgColab/noimg.jpg">`;
                $("#imgPerfil").html(img);
            }




            // modal edit
            $("#nomColabEdit").val(resp.nome);
            $("#cpfColabEdit").val(resp.cpf);
            $("#dtNasColabEdit").val(resp.dataNasc);
            $("#emailColabEdit").val(resp.email);
            $("#telColabEdit").val(resp.telefone);
            $("#endColabEdit").val(resp.endereco);

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}


function editarDados() {
    $("#modalEditColab").modal("show");
}


function salvarDadosPessoais() {
    let dados = new FormData();
    let nome = $("#nomColabEdit").val();
    let cpf = $("#cpfColabEdit").val();
    let dtNasc = $("#dtNasColabEdit").val();
    let email = $("#emailColabEdit").val();
    let tel = $("#telColabEdit").val();
    let endEdit = $("#endColabEdit").val();

    if (!nome || !email) {
        alerta("error", "campo em falta");
        return;
    }

    dados.append('op', 'salvarDadosPessoais');
    dados.append('nome', nome);
    dados.append('cpf', cpf);
    dados.append('dtNasc', dtNasc);
    dados.append('email', email);
    dados.append('tel', tel);
    dados.append('endEdit', endEdit);


    $.ajax({
        url: 'assets/controller/colaborador/controllerColab.php',
        method: 'Post',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (resp) {

            if (resp.msg) {
                alerta("success", resp.msg);
                getColaborador();
                $("#modalEditColab").modal("hide");
            }

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}

//primeira parte 
// abro o input files para adicionar img
function editarFoto() {
    let img = $("#fotoPerfilColab").attr('src');

    $("#selecImg").click();

    console.log(img);

}

// no input files tem um onchange colocando esta img onde fica mesmoa a tag img
function imgAtual() {
    let imgSelecionada = $("#selecImg")[0].files[0];

    if (imgSelecionada) {
        const urlTemp = URL.createObjectURL(imgSelecionada);

        $("#fotoPerfilColab").attr("src", urlTemp);

        $("#btnSalvarImg").removeClass('ocultar');
    }

}

function SalvarFoto() {
    let imgFinal = $("#selecImg")[0].files[0];

    console.log(imgFinal)

    let dados = new FormData();
    dados.append('op', 'salvarImg');
    dados.append('img', imgFinal);

    $.ajax({
        url: 'assets/controller/colaborador/controllerColab.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (resp) {

            if (resp.status) {
                alerta("success", resp.msg);
            } else {
                console.log(resp);
            }

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}




$(() => {
    getColaborador();
})






