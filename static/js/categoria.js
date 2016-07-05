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
                    "sProcessing": '<div class="preloader-wrapper big active">    <div class="spinner-layer spinner-blue-only">      <div class="circle-clipper left">        <div class="circle"></div>      </div><div class="gap-patch">        <div class="circle"></div>      </div><div class="circle-clipper right">        <div class="circle"></div>      </div>    </div>  </div>', //"Processando...",
                    "sSearch": "Pesquisa:",
                    "sZeroRecords": "<center>Não foram encontrados registros.</center>"
            },
            "sPaginationType": "full_numbers",
            "bFilter": false,
            "bProcessing": true,
            "bServerSide": true,
            "ajax": {
                "url": base_url + "admin/categoria/datatable",
                "type": "POST"
            },
            "columns": columns()
    });
});