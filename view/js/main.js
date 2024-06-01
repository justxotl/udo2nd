$(document).ready(function () {
    $('#example').DataTable({
        "lengthMenu": [3, 5, 10],
        "pageLength": 5,
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

/*funcion especificamente hecha para la tabla de reposo individual*/
$(document).ready(function () {
    $('#example2').DataTable({
        "lengthMenu": [3, 5, 10],
        "pageLength": 5,
        columnDefs: [
            {width: '6%', target:[0]},
            {width: '12%', target:[4,5]},
         //codigo para centrar. El target es para indicar las colunmas en donde se aplicaran los cambios   {className: 'text-center', target:[0,1,2,3,4]}
        ],
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