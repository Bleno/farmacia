     <div class="container">
        <div class="section">
            <h5 class="header green-text">Listagem</h3>
            <div class="divider"></div>
        </div>
        <div class="section">
            <table class="dataTables responsive-table striped highlight centered" id="tabela-usuario">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Data Cadastro</th>
                        <th>Data Atualização</th>
                        <th>Ativo</th>
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
        <h5 class="red-text">Inativar usuário ?</h5>
        <p id="info" data-info="BLeno"></p>
    </div>
    <div class="modal-footer">
      <a href="javascript: move_to_trash();" id="move-to-trash" data-reg="" class=" modal-action modal-close waves-effect waves-green btn-flat">Sim</a>
      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Não</a>
    </div>
  </div>
<script type="text/javascript">
    var url_usuario = "<?php echo base_url('admin/usuario/editar/'); ?>";
    function columns(){
        var cols = [
            {"data": "nome"},
            {"data": "email"},
            {"data": function(data){ //dt_cadastro
                //TODO Criar função global para formatar data
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
            {"data": function(data){
                        if(data.ativo == "1"){
                            return "Sim"
                        }else{
                            return "Não"
                        }
                    }
            },
            {"orderable":      false, "data": function(data){ //options
                        var id_usuario = data.id_usuario;
                        var options = '<a title="Editar essa categoria" class="btn-floating btn waves-effect waves-light" href="'+ url_usuario + "/" + id_usuario +'"><i class="small material-icons">mode_edit</i></a>';
                        if(data.ativo == "1"){
                            options += '<a onclick="get_id(this);" title="Inativar usuário" data-id="'+ id_usuario +'" class="btn-floating btn waves-effect waves-light red modal-trigger" href="#modal1"><i class="small material-icons">thumb_down</i></a>';
                        }else{
                            options += '<a onclick="ativar_usuario(this);" title="Ativar usuário" data-id="'+ id_usuario +'" class="btn-floating btn waves-effect waves-light green"><i class="small material-icons">thumb_up</i></a>';
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
        $.post(base_url + 'admin/usuario/inativar', {id_usuario: id}, function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            Materialize.toast('Usuário inativado com sucesso!', 6000)
        });
    }

    function ativar_usuario(element){
        var id = $(element).data('id');
        $.post(base_url + 'admin/usuario/ativar', {id_usuario: id}, function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            Materialize.toast('Usuário ativado com sucesso!', 6000)
        });
    }

</script>