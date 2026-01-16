
function alerta(icone, msg) {
    Swal.fire({
        position: "top-end",
        icon: icone,
        title: msg,
        showConfirmButton: false,
        timer: 1500
    });
}