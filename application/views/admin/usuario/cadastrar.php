    <div class="container">
        <div class="section">
            <h5 class="header green-text">Gerenciar Usuário</h3>
        </div>
        <div class="section">
            <div class="divider"></div>
        </div>
        <div class="section">
            <form class="col s12" method="post" action="<?php echo base_url("admin/usuario/cadastrar")?>">
                <div class="row">
                    <div class="input-field col s6">
                      <input type="text" id="nome" name="nome" value="<?php echo set_value('nome'); ?>" class="validate" placeholder="Digite o nome" required autofocus>
                      <label for="nome">Nome</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                      <input type="email" id="email" name="email" value= "<?php echo set_value('email'); ?>" class="validate" placeholder="Digite o email" required autofocus>
                      <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                      <input type="password" id="senha" name="senha" value= "" class="validate" placeholder="Digite a senha" required autofocus>
                      <label for="senha">Senha</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                      <input type="password" id="conf_senha" name="conf_senha" value= "" class="validate" placeholder="Confirme a senha" required autofocus>
                      <label for="conf_senha">Confirmar senha</label>
                    </div>
                </div>
                <div class="row">
                    <button title="Cadastrar usuário"  type="submit" class="btn waves-effect waves-light">Cadastrar</button>
                    <!-- <button  type="submit" class="btn btn-lg btn-primary" >Alterar</button> -->
                    <button title="Limpar campos" id="btn-limpar" type="reset" class="btn waves-effect waves-light">Limpar</button><br/>
                </div>



    
            <?php if($this->session->flashdata('erro')): ?>
                <script>
                    setTimeout(function(){
                        $('#erro').fadeOut(3000);
                    }, 4000);
                </script>
                <div id="erro">
                    <font color="#FC5555"><?php echo $this->session->flashdata('erro'); ?></font>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('edicaook')): ?>
                <script>
                    setTimeout(function(){
                        $('#edicaook').fadeOut(3000);
                    }, 4000);
                </script>
                <div id="edicaook">
                    <font color="#009688"><?php echo $this->session->flashdata('edicaook'); ?></font>
                </div>
            <?php endif; ?>
            <?php echo validation_errors('<font color="#FC5555">','</font>'); ?>
            </form>
        </div>
    </div>
    
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
            {"orderable":      false, "data": function(data){ //options
                        var id_usuario = data.id_usuario;
                        var options = '<a title="Editar essa categoria" class="btn-floating btn waves-effect waves-light" href="'+ url_usuario + "/" + id_usuario +'"><i class="small material-icons">mode_edit</i></a>';
                        options += '<a onclick="get_id(this);" title="Enviar para lixeira" data-id="'+ id_usuario +'" class="btn-floating btn waves-effect waves-light red modal-trigger" href="#modal1"><i class="small material-icons">delete</i></a>';
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
        // fazer uma chamada ajax para mover para lixeira
        alert($("#move-to-trash").data('reg'));
    }

</script>