    <div class="container">
        <div class="section">
            <h5 class="header green-text">Gerenciar Usuário</h3>
        </div>
        <div class="section">
            <div class="divider"></div>
        </div>
        <div class="section">
            <form class="col s12" method="post" action="<?php echo base_url("admin/usuario/cadastrar")?>">
                <div class="row">
                    <div class="input-field col s12 l6">
                      <input type="text" id="nome" name="nome" value="<?php echo set_value('nome'); ?>" class="validate" placeholder="Digite o nome" maxlength="45" required autofocus>
                      <label for="nome">Nome</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                      <input type="text" id="sobrenome" name="sobrenome" value="<?php echo set_value('sobrenome'); ?>"  placeholder="Digite o sobrenome" maxlength="45">
                      <label for="sobrenome">Sobrenome</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                      <input type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" value= "<?php echo set_value('email'); ?>" class="validate" placeholder="Digite o email" maxlength="45" required>
                      <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                      <input type="password" id="senha" name="senha" value= "" class="validate" placeholder="Digite a senha" maxlength="45" required>
                      <label for="senha">Senha</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6">
                      <input type="password" id="conf_senha" name="conf_senha" value= "" class="validate" placeholder="Confirme a senha" maxlength="45" required>
                      <label for="conf_senha">Confirmar senha</label>
                    </div>
                </div>
                <div class="row">
                    <button title="Cadastrar usuário"  type="submit" class="btn waves-effect waves-light">Cadastrar</button>
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
    
