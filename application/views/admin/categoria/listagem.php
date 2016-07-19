    <div class="container">
        <div class="section">
            <h5 class="header green-text">Listagem</h3>
            <div class="divider"></div>
        </div>
        <div class="section">
            <table class="dataTables responsive-table striped highlight centered" id="tabela-categoria">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Usuário cadastro </th>
                        <th>Data cadastro</th>
                        <th>Data atualização</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                 <tbody>

                 </tbody>    
            </table>
        </div>
    </div>


  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
        <h5 class="red-text">Mover para lixeira ?</h5>
        <p id="info">Mover para lixeira vai impedir de cadastrar novos produtos com essa <b>categoria</b></p>
    </div>
    <div class="modal-footer">
      <a href="javascript: move_to_trash();" id="move-to-trash" data-reg="" class=" modal-action modal-close waves-effect waves-green btn-flat">Sim</a>
      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Não</a>
    </div>
  </div>
<script type="text/javascript">
    var url_categoria = "<?php echo base_url('admin/categoria/editar/'); ?>";
    function columns(){
        var cols = [
            {"data": "categoria"},
            {"data": "usuario"},
            {"data": function(data){ //dt_cadastro
                        var dt_array = data.dt_cadastro.split(" ");
                        var date = dt_array[0].split("-");
                        return date[2] + "/" + date[1] + "/" + date[0] + " " + dt_array[1]
                    }
            },
            {"data": function(data){ //dt_update
                        var dt_array = data.dt_update.split(" ");
                        var date = dt_array[0].split("-");
                        return date[2] + "/" + date[1] + "/" + date[0] + " " + dt_array[1]
                    }
            },
            {"orderable":      false, "data": function(data){ //slug options
                        //var slug = data.slug;
                        //var options = '<a title="Editar essa categoria" class="btn-floating btn waves-effect waves-light" href="'+ url_categoria + "/" + slug +'"><i class="small material-icons">mode_edit</i></a>';
                        //options += '<a onclick="get_id(this);" title="Enviar para lixeira" data-id="'+ data.id_categoria +'" class="btn-floating btn waves-effect waves-light red modal-trigger" href="#modal1"><i class="small material-icons">delete</i></a>';
                        //return options
                        var id_categoria = data.id_categoria;
                        var options = '<a title="Editar essa categoria" class="btn-floating btn waves-effect waves-light" href="'+ url_categoria + "/" + id_categoria +'"><i class="small material-icons">mode_edit</i></a>';
                        if(data.ativo == "1"){
                            options += '<a onclick="get_id(this);" title="Inativar categoria" data-id="'+ id_categoria +'" class="btn-floating btn waves-effect waves-light red modal-trigger" href="#modal1"><i class="small material-icons">thumb_down</i></a>';
                        }else{
                            options += '<a onclick="ativar_categoria(this);" title="Ativar categoria" data-id="'+ id_categoria +'" class="btn-floating btn waves-effect waves-light green"><i class="small material-icons">thumb_up</i></a>';
                        }
                        return options
                    }
            }


        ];
        return cols        
    }
    function get_id(element){
        var anchor = $(element);
        var id = $(element).data('id');
        $("#move-to-trash").attr('data-reg', id);
    }
    function move_to_trash(){
        var id = $("#move-to-trash").data('reg')
        $.post(base_url + 'admin/categoria/inativar', {id_categoria: id}, function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            Materialize.toast('Categoria inativada com sucesso!', 6000)
            var table = $(".dataTable" ).dataTable().api();
            table.ajax.reload();
        });
    }
    function ativar_categoria(element) {
        var id = $(element).data('id');
        $.post(base_url + 'admin/categoria/ativar', {id_categoria: id}, function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            Materialize.toast('Categoria ativada com sucesso!', 6000);
            var table = $(".dataTable" ).dataTable().api();
            table.ajax.reload();
        });
    }

</script>