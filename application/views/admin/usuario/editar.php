<?php 

//Pega o seguimento 4 da url
$id_usuario = $this->uri->segment(4);

if($id_usuario == null) redirect('admin/usuario');

$usuario = $this->UsuarioModel->getById($id_usuario)->row();

if($this->session->flashdata('edicaook')):
?>
<div style="position: absolute; top: 128px;">
    <script>
        setTimeout(function(){
            $('#marcaSucessoEditar').fadeOut(3000);
        }, 4000);
    </script>
    <div id="marcaSucessoEditar" class="alert alert-success fade in" style="width: 1038px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('edicaook'); ?>
    </div>
</div>
<?php endif; ?>
    <div class="container">
        <div class="section">
            <h5 class="header green-text">Gerenciar Usuário</h3>
        </div>
        <div class="section">
            <div class="divider"></div>
        </div>
        <div class="section">
            <form class="col s12" method="post" action="<?php echo base_url("admin/usuario/editar")?>">
                <div class="row">
                    <div class="input-field col s6">
                      <input type="hidden" name="id_usuario" value="<?php echo $usuario->id_usuario; ?>"/>
                      <input type="text" id="nome" name="nome" value="<?php echo $usuario->nome; ?>" class="validate" placeholder="Digite o nome" required autofocus>
                      <label for="nome">Nome</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                      <input disabled type="email" id="email" name="email" value="<?php echo $usuario->email; ?>" class="validate" placeholder="Digite o email" required autofocus>
                      <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                      <input type="password" id="senha" name="senha" value="" class="validate" placeholder="Digite a senha" required autofocus>
                      <label for="senha">Senha</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                      <input type="password" id="conf_senha" name="conf_senha" value="" class="validate" placeholder="Confirme a senha" required autofocus>
                      <label for="conf_senha">Confirmar senha</label>
                    </div>
                </div>
                <div class="row">
                    <button title="Editar usuário"  type="submit" class="btn waves-effect waves-light">Editar</button>
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
            <?php echo validation_errors('<font color="#FC5555">','<font/>'); ?>
            </form>
        </div>
    </div>
    
    <div class="container">
        <div class="section">
            <h5 class="header green-text">Listagem</h3>
            <div class="divider"></div>
        </div>
        <div class="section">
            <table class="responsive-table striped highlight centered" id="tabela-categoria">
                <thead>
                    <tr>
                        <th># </th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Data Cadastro</th>
                        <th></th>
                    </tr>
                </thead>
                 <tbody>
                <?php 
                    foreach($usuarios as $row):
                ?>
                    <tr>
                        <td><?php echo $row->id_usuario;?></td>
                        <td><?php echo $row->nome;?></td>
                        <td><?php echo $row->email;?></td>
                        <td><?php echo $row->dt_cadastro;?></td>
                        <td>
                            <a title="Editar essa categoria" class="btn-floating btn-large waves-effect waves-light" href="<?php echo base_url('admin/usuario/editar/'); echo "/". $row->id_usuario;?>"><i class="large material-icons">mode_edit</i></a>
                            &nbsp;&nbsp;
                            <a title="Enviar para lixeira" class="btn-floating btn-large waves-effect waves-light red" href="#"><i class="large material-icons">delete</i></a>
                        </td>
                    </tr>
                <?php 
                    endforeach;
                 ?>
                 </tbody>    
            </table>
        </div>
    </div>

<script type="text/javascript">

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
                "bFilter": true,
                "bProcessing": true,
                "bServerSide": false
        });
    });

</script>