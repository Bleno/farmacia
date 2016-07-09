$(document).ready(function($) {
	initSample();
	var editor = CKEDITOR.instances.editor;//CKEDITOR.replace('editor');

	// The "change" event is fired whenever a change is made in the editor.
	editor.on( 'change', function( evt ) {
	    // getData() returns CKEditor's HTML content.
	    //console.log( 'Total bytes: ' + evt.editor.getData().length );
	    $("#descricao").val(evt.editor.getData());
	});

    //if($("#descricao").data('action') == "editar"){
        var editorElement = CKEDITOR.document.getById( 'editor' );
        editorElement.setHtml( $("#descricao").val());

    //}

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
                "url": base_url + "admin/produto/datatable",
                "type": "POST"
            },
            "columns": columns()
    });
    $('.dataTables').on( 'draw.dt', function () {
            $('.materialboxed').materialbox();
             $('.modal-trigger').leanModal({
                ready: function() { console.log("start") }
            });
    } );


});