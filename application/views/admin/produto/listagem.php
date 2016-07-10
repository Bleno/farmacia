    <div class="container">
        <div class="section">
            <h5 class="header green-text">Listagem</h3>
            <div class="divider"></div>
        </div>
        <div class="section">
            <table class="dataTables responsive-table striped highlight centered" id="tabela-categoria">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Imagem</th>
                        <th>Categoria</th>
                        <th>Valor</th>
                        <th>Argumento</th>
                        <th>Descrição</th>
                        <th>Usuário cadastro</th>
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
        <p id="info"></p>
    </div>
    <div class="modal-footer">
      <a href="javascript: confirm_delete();" id="move-to-trash" data-reg="" class=" modal-action modal-close waves-effect waves-green btn-flat">Sim</a>
      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Não</a>
    </div>
  </div>

<!-- Modal Structure description -->
<div id="show-descricao-modal" class="modal modal-fixed-footer">
    <div class="modal-content" id="show-descricao">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>
    </div>
</div>


<!-- Modal Structure argumento -->
<div id="show-argumento-modal" class="modal modal-fixed-footer">
    <div class="modal-content" id="show-argumento">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>
    </div>
</div>

<script type="text/javascript">
    var url_categoria = "<?php echo base_url('admin/produto/editar/'); ?>";
    function columns(){
        var cols = [
            {"data": "nome"},
            {"orderable":  false, "data": function(data){
                        return '<img class="materialboxed" width="30" height="30" src="'+ base_url + 'produtos/'+ data.imagem +'" alt="'+ data.nome +'">'
                        //return 'imagem'
                    }
            },
            {"data": "categoria"},
            {"data": function(data){
                        return "R$ " + data.valor
                    }
            },
            {"orderable":  false, "data": function(data){
                        return '<a data-id="'+ data.id_produto +'" href="javascript: show_argumento('+ data.id_produto +')"><i class="small material-icons">zoom_in</i></a>'
                    }
            },
            {"orderable":  false, "data": function(data){
                        return '<a data-id="'+ data.id_produto +'" href="javascript: show_descricao('+ data.id_produto +')"><i class="small material-icons">zoom_in</i></a>'
                    }
            },
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
            {"orderable":  false, "data": function(data){ // options
                        var slug = data.slug;
                        var options = '<a title="Editar esse produto" class="btn-floating btn waves-effect waves-light" href="'+ url_categoria + "/" + slug +'"><i class="small material-icons">mode_edit</i></a>';
                        options += '<a onclick="move_to_trash(this);" title="Enviar para lixeira" data-id="'+ data.id_produto +'" class="btn-floating btn waves-effect waves-light red modal-trigger" href="#modal1"><i class="small material-icons">delete</i></a>';
                        options += '<a title="Previsão" data-id="'+ data.id_produto +'" class="btn-floating btn waves-effect waves-light blue modal-trigger" href="#modal1"><i class="small material-icons">visibility</i></a>';
                        return options
                    }
            }


        ];
        return cols        
    }
    function get_id(element){
        var anchor = $(element);
        var id = $(element).data('id');
        return id
    }
    function move_to_trash(element){
        var id = get_id(element);
        $("#move-to-trash").attr('data-reg', id);
        
    }

    function confirm_delete(){
        // fazer uma chamada ajax para mover para lixeira
        var id = $("#move-to-trash").data('reg');
        alert(id);
        $.post(base_url + 'admin/produto/delete', {'id_produto': id}, function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            console.log("DELETADO!");
        });
    }

    function show_descricao(element){
        //var id = get_id(element);
        
        $.get(base_url+'admin/produto/get_descricao/' + element,
            function(data){ //alert(data)  
                $("#show-descricao").html(data);
                $('#show-descricao-modal').openModal();
            }
        )
    }

    function show_argumento(element){
        //var id = get_id(element);
        
        $.get(base_url+'admin/produto/get_argumento/' + element,
            function(data){ //alert(data)  
                $("#show-argumento").html(data);
                $('#show-argumento-modal').openModal();
            }
        )
    }

</script>