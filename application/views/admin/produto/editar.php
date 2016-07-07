<?php 

//Pega o seguimento 4 da url
$slug = $this->uri->segment(4);

if($slug == null) redirect('admin/produto');

$produto = $this->ProdutoModel->getBySlug($slug)->row();

//if($this->session->flashdata('edicaook'));
?>
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
                    <div class="input-field col s12 l6">
                      <select name="fk_categoria" id="fk_categoria">
                        <option value="" disabled selected>Escolha uma categoria</option>
                        <?php foreach ($categorias as $row ): ?>
                            <option value="<?php echo $row->id_categoria; ?>"><?php echo $row->nome; ?></option>
                        <?php endforeach;?>
                      </select>
                      <label for="fk_categoria">Categoria</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                      <input type="text" id="nome" name="nome" value="<?php echo $produto->nome; ?>" class="validate" placeholder="Digite o Produto" maxlength="45" required autofocus/>
                      <label for="nome">Produto</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                      <input type="text" onKeyUp="maskIt(this,event,'###.###.###,##',true)" id="valor_venda" name="valor_venda" value="<?php echo set_value('valor_venda'); ?>" class="validate" placeholder="Digite o valor" required/>
                      <label for="valor_venda">Valor</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                      <input type="text" id="argumento" name="argumento" value="<?php echo set_value('argumento'); ?>" class="validate" placeholder="Digite o argumento" maxlength="45" required/>
                      <label for="argumento">Argumento</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                        <input type="hidden" id="descricao" name="descricao" class="validate" placeholder="Digite a descrição" title="Digite a descrição" required/>
                        <h6 class="header green-text">Descrição</h6>
                    </div>
                </div>
                <div class="row">
                    <div id="editor" class="input-field col s12 l6"></div>
                </div>
                <div class="row">
                    <div class="file-field input-field col s12 l6">
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
    
<script type="text/javascript">
function maskIt(w,e,m,r,a){
// Cancela se o evento for Backspace
if (!e) var e = window.event
if (e.keyCode) code = e.keyCode;
else if (e.which) code = e.which;
// Variáveis da função
var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
var mask = (!r) ? m : m.reverse();
var pre  = (a ) ? a.pre : "";
var pos  = (a ) ? a.pos : "";
var ret  = "";
if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;
// Loop na máscara para aplicar os caracteres
for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
if(mask.charAt(x)!='#'){
ret += mask.charAt(x); x++; } 
else {
ret += txt.charAt(y); y++; x++; } }
// Retorno da função
ret = (!r) ? ret : ret.reverse()    
w.value = pre+ret+pos; }
// Novo método para o objeto 'String'
String.prototype.reverse = function(){
return this.split('').reverse().join(''); };

/*    $("#valor_venda").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });*/
</script>

