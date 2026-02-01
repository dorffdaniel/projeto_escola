
function getTurmas() {
    let dados = new FormData();
    dados.append('op', 'getTurma');

    $.ajax({
        url: 'assets/controller/lancamentoNota/controllerLanc.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false

    })

        .done(function (resp) {

            let op = '<option value="-1">selecione uma turma </option>';

            console.log(resp)

            resp.msg.forEach((el, index) => {
                op += `<option value='${el.idTurm}'> ${el.nome} - ${el.ano}  </option>`

            })

            $("#turma").html(op);

            if (resp.erro) {
                console.log(resp.erro);
            }

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}


function getAlunosPorTurma() {

    if ($.fn.DataTable.isDataTable('#tabelaDEfuncAtivos')) {
        $('#tabelaDEfuncAtivos').DataTable().destroy();
    }

    let idTurm = $("#turma").val();

    if (idTurm == "-1") {
        alerta("warning", "Selecione uma turma");
        return;
    }

    let dados = new FormData();
    dados.append('idTurm', idTurm);
    dados.append('op', 'getAlunoTurma')

    $.ajax({
        url: 'assets/controller/lancamentoNota/controllerLanc.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {

            let mens = `<tr>`;
            if (msg.length > 0) {
                msg.forEach((el, index) => {
                    mens += `<td class="text-center"> ${el.nome} </td>`
                    mens += `<td class="text-center">${el.nota_b1 || '--'} </td>`
                    mens += `<td class="text-center">${el.nota_b2 || '--'}</td>`
                    mens += `<td class="text-center">${el.nota_b3 || '--'}</td>`
                    mens += `<td class="text-center">${el.nota_b4 || '--'}</td>`
                    mens += `<td class="text-center">${el.nota_final}</td>`
                    mens += `<td class="text-center"> 
                <button class="btn btn-warning" onclick="editarAluno(${el.idAlun})">editar</button>
                <button class="btn btn-success">info</button>
                <button class="btn btn-danger">apgar</button>
                </td>`
                    mens += `</tr>`;
                })
            } else {
                mens += `<td class="text-center"> Sem alunos</td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"> 
                </td>`
                mens += `</tr>`;
            }



            $("#resTabelaAluno").html(mens);

            $('#tabelaDEfuncAtivos').DataTable({
                responsive: true,
                autoWidth: false
            });

            if (msg.erro) {
                alerta("warning", msg.erro);
                return;
            }

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })
}



function getTodosAlunos() {
    if ($.fn.DataTable.isDataTable('#tabelaDEfuncAtivos')) {
        $('#tabelaDEfuncAtivos').DataTable().destroy();
    }

    let dados = new FormData();
    dados.append('op', 'getTodosAlunos');

    $.ajax({
        url: 'assets/controller/lancamentoNota/controllerLanc.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })


        .done(function (resp) {
            console.log(resp)

            let mens = `<tr>`;
            if (resp.length > 0) {
                resp.forEach((el, index) => {
                    mens += `<td class="text-center"> ${el.nome} </td>`
                    mens += `<td class="text-center">${el.nota_b1 || '--'}</td>`
                    mens += `<td class="text-center">${el.nota_b2 || '--'}</td>`
                    mens += `<td class="text-center">${el.nota_b3 || '--'}</td>`
                    mens += `<td class="text-center">${el.nota_b4 || '--'}</td>`
                    mens += `<td class="text-center"> ${el.nota_final}</td>`
                    mens += `<td class="text-center"> 
                <button class="btn btn-warning" onclick="editarAluno(${el.idAlun})">editar</button>
                <button class="btn btn-success">info</button>
                <button class="btn btn-danger">apgar</button>
                </td>`
                    mens += `</tr>`;
                })
            } else {
                mens += `<td class="text-center"> sem alunos </td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center"></td>`
                mens += `<td class="text-center">
                </td>`
                mens += `</tr>`;
            }

            $("#resTabelaAluno").html(mens);

            $('#tabelaDEfuncAtivos').DataTable({
                responsive: true,
                autoWidth: false
            });


        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })
}


function editarAluno(idAlun) {

    console.log("valor: " + idAlun)

    let dados = new FormData();
    dados.append('op', 'editarAluno')
    dados.append('idAlun', idAlun);

    $.ajax({
        url: 'assets/controller/lancamentoNota/controllerLanc.php',
        method: 'POST',
        data: dados,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (resp) {

            console.log(resp)

            $("#nomeTurma").html(resp.nomeTurma);

            $("#idEdit").val(resp.idAlun);

            $("#nomAlunEdit").val(resp.nome);
            $("#telAlunEdit").val(resp.telefone);
            $("#dtNascAlunEdit").val(resp.dataNasci);
            $("#endAlunEdit").val(resp.endereco);

            // notas
            $("#not1Edit").val(resp.nota_b1 || '--');
            $("#not2Edit").val(resp.nota_b2 || '--');
            $("#not3Edit").val(resp.nota_b3 || '--');
            $("#not4Edit").val(resp.nota_b4 || '--');


            $("#modalEditarAluno").modal("show");

        })

        .fail(function (textStatus) {
            console.log(textStatus)
        })

}



function salvarEditPessoalAluno() {

    let dados = new FormData();
    dados.append('op', 'salvarEditPessoalAluno');
    dados.append('idAlun', $("#idEdit").val());
    dados.append('nomeEdit', $("#nomAlunEdit").val());
    dados.append('telEdit', $("#telAlunEdit").val());
    dados.append('dtNascEdit', $("#dtNascAlunEdit").val());
    dados.append('endEdit', $("#endAlunEdit").val());

    $.ajax({
        url: 'assets/controller/lancamentoNota/controllerLanc.php',
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
                getTodosAlunos();
            } else {
                console.log(resp.erro);
            }

        })

        .fail(function (textStatus) {
            console.log(textStatus);
        })

}






$(() => {
    getTurmas();
    getTodosAlunos();
})