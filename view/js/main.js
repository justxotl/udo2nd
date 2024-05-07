$(document).ready(function () {
    $('#example').DataTable({
        "language":{
            "lengthMenu":"Mostrar _MENU_ registros.",
            "zeroRecords":"No se encontraron registros.",
            "info":"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros.",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros.",
            "infoFiltered":"(Filtrado de un total de _MAX_ registros.)",
            "sSearch":"Buscar:",
            "oPaginate":{
                "sFirst":"Primero",
                "sLast":"Ultimo",
                "sNext":"Siguiente",
                "sPrevious":"Anterior",
            },
            "sProcessing":"Procesando...",
        }
    });
});