<?php 

//Pega o seguimento 4 da url
$id = $this->uri->segment(4);

if($id == null) redirect('admin/categoria');

$categoria = $this->CategoriaModel->getById($id)->row();

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
            <h5 class="header green-text">Gerenciar Categoria</h3>
        </div>
        <div class="section">
            <div class="divider"></div>
        </div>
        <div class="section">
            <form class="col s12" method="post" action="<?php echo base_url("admin/categoria/editar")?>">
                <div class="row">
                    <div class="input-field col s12 l6">
                      <input value="<?php echo $categoria->nome; ?>" type="text" id="categoria" name="categoria" class="validate" placeholder="Digite a Categoria" required autofocus>
                      <input value="<?php echo $categoria->slug; ?>" type="hidden" name="slug">
                      <label for="categoria">Categoria</label>
                    </div>
                </div>
                <div class="row">
                    <button title="Editar categoria"  type="submit" class="btn waves-effect waves-light">Editar</button>
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

            </form>
        </div>
    </div>
    
