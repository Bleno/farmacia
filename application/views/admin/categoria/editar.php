<?php 

//Pega o seguimento 4 da url
$slug = $this->uri->segment(4);

if($slug == null) redirect('admin/categoria');

$categoria = $this->CategoriaModel->getBySlug($slug)->row();

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
                        var slug = data.slug;
                        var options = '<a title="Editar essa categoria" class="btn-floating btn waves-effect waves-light" href="'+ url_categoria + "/" + slug +'"><i class="small material-icons">mode_edit</i></a>';
                        options += '<a title="Enviar para lixeira" class="btn-floating btn waves-effect waves-light red" href=""><i class="small material-icons">delete</i></a>';
                        return options
                    }
            }


        ];
        return cols        
    }
</script>