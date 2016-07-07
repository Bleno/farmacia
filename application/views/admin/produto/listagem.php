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

    // $(document).ready(function() {
    //     $('.dataTables').DataTable({
    //             "responsive": true,
    //             "oLanguage": {
    //                     "oPaginate": { "sFirst": "<<", "sLast": ">>", "sNext": ">", "sPrevious": "<" },
    //                     "sEmptyTable": 'Não foram encontrados registros. Tabela Vazia!',
    //                     "sInfo": "<span>Exibindo de <b>_START_</b> até <b>_END_</b> de <b>_TOTAL_</b> registros encontrados.</span>",
    //                     "sInfoEmpty": " ",
    //                     "sInfoFiltered": "",
    //                     "sInfoThousands": ".",
    //                     "sLengthMenu": "Exibir _MENU_ registros",
    //                     "sLoadingRecords": "<center>Carregando...</center>",
    //                     "sProcessing": '<b>Processando...</b>', //"Processando...",
    //                     "sSearch": "Pesquisa:",
    //                     "sZeroRecords": "<center>Não foram encontrados registros.</center>"
    //             },
    //             "sPaginationType": "full_numbers",
    //             "bFilter": true,
    //             "bProcessing": true,
    //             "bServerSide": false
    //     });
    // });

</script>