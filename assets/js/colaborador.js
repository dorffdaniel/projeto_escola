
function getColaborador() {
    let dados = new FormData();
    dados.append('op', 1);

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
            console.log(resp)
            console.log(resp.nome)
            $("#nomeColab").html(resp.nome);
        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}


$(() => {
    getColaborador();
})

