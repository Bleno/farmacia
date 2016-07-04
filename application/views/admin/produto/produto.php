    <div class="container">
        <div class="section">
            <h5 class="header green-text">Gerenciar Produto</h3>
        </div>
        <div class="section">
            <div class="divider"></div>
        </div>
        <div class="section">
            <form class="col s12" method="post" action="<?php echo base_url("admin/produto/cadastrar")?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col s6">
                      <select name="fk_categoria" id="fk_categoria">
                        <option value="" disabled selected>Escolha uma categoria</option>
                        <?php foreach ($categorias as $row ): ?>
                            <option value="<?php echo $row->idtb_categoria; ?>"><?php echo $row->nome; ?></option>
                        <?php endforeach;?>
                      </select>
                      <label for="fk_categoria">Categoria</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                      <input type="text" id="nome" name="nome" value="<?php echo set_value('nome'); ?>" class="validate" placeholder="Digite o Produto" required autofocus>
                      <label for="nome">Produto</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <textarea id="descricao" name="descricao" class="validate materialize-textarea" placeholder="Digite a descrição" title="Digite a descrição" required></textarea>
                        <label for="descricao">Descrição</label>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field col s6">
                          <div class="btn">
                            <span>Imagem</span>
                            <input type="file" name="imagem">
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                          </div>
                    </div>
                </div>
                <div class="row">
                    <button title="Cadastrar produto"  type="submit" class="btn waves-effect waves-light">Cadastrar</button>
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
            <table class="responsive-table striped highlight centered" id="tabela-categoria">
                <thead>
                    <tr>
                        <th># </th>
                        <th>Produto</th>
                        <th></th>
                    </tr>
                </thead>
                 <tbody>
                <?php 
                    foreach($produtos as $row):
                ?>
                    <tr>
                        <td><?php echo $row->idtb_produto;?></td>
                        <td><?php echo $row->nome;?></td>
                        <td>
                            <a title="Editar essa categoria" class="btn-floating btn-large waves-effect waves-light" href="<?php echo base_url('admin/categoria/editar/'); echo "/". $row->slug;?>"><i class="large material-icons">mode_edit</i></a>
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