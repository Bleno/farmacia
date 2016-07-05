    <div class="container">
        <div class="section">
            <h5 class="header green-text">Gerenciar Categoria</h3>
        </div>
        <div class="section">
            <div class="divider"></div>
        </div>
        <div class="section">
            <form class="col s12" method="post" action="<?php echo base_url("admin/categoria/cadastrar")?>">
                <div class="row">
                    <div class="input-field col s6">
                      <input type="text" id="categoria" name="categoria" value= "" class="validate" placeholder="Digite a Categoria" required autofocus>
                      <label for="categoria">Categoria</label>
                    </div>
                </div>
                <div class="row">
                    <button title="Cadastrar categoria"  type="submit" class="btn waves-effect waves-light">Cadastrar</button>
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


<!-- <td>
                            <a title="Editar essa categoria" class="btn-floating btn-large waves-effect waves-light" href="<?php echo base_url('admin/categoria/editar/'); echo "/". $row->slug;?>"><i class="large material-icons">mode_edit</i></a>
                            &nbsp;&nbsp;
                            <a title="Enviar para lixeira" class="btn-floating btn-large waves-effect waves-light red" href="#"><i class="large material-icons">delete</i></a>
                        </td> -->

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
            {"sorted": false, "data": function(data){ //slug options
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