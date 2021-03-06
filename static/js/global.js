$(document).ready(function() {
    $('.dataTables').DataTable({
            "responsive": true,
            "oLanguage": {
                    "oPaginate": { "sFirst": "<<", "sLast": ">>", "sNext": ">", "sPrevious": "<" },
                    "sEmptyTable": 'Não foram encontrados registros. Tabela Vazia!',
                    "sInfo": "<span>Exibindo de <b>_START_</b> até <b>_END_</b> de <b>_TOTAL_</b> registros encontrados.</span>",
                    "sInfoEmpty": " ",
                    "sInfoFiltered": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Exibir _MENU_ registros",
                    "sLoadingRecords": "<center>Carregando...</center>",
                    "sProcessing": '<b>Processando...</b>', //"Processando...",
                    "sSearch": "Pesquisa:",
                    "sZeroRecords": "<center>Não foram encontrados registros.</center>"
            },
            "sPaginationType": "full_numbers",
            //"bFilter": true,
            "bProcessing": true,
            "bServerSide": true,
            "ajax": {
                "url": "./categoria/datatable",
                "type": "POST"
            }
    });
});