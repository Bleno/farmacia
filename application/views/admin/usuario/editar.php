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
    