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
                    <div class="input-field col s12 l6">
                      <input type="text" id="categoria" name="categoria" value= "" class="validate" placeholder="Digite a Categoria" required autofocus>
                      <label for="categoria">Categoria</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                        <button title="Cadastrar categoria"  type="submit" class="btn waves-effect waves-light">Cadastrar</button>
                    </div>
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
    
