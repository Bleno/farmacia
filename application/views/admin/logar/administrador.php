<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Login - Painel Administrativo</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url("static/css/materialize.css"); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url("static/css/style.css"); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  <style>
     body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
      #background: #FFC1C1;
    }
    main {
     flex: 1 0 auto;
    }
  </style>
</head>
<main>
<body>
    <nav class="teal lighten-2" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Painel Administrativo</a>
    </nav>
		<div class="container">
			<div class="section">
				
			</div>
			<div class="section">
				
			</div>
			<div class="section">
				<div class="row">
					<div class="col s12 m4 l2">&nbsp;</div>
					<div class="col s12 m4 l6">
						<div class="card-panel teal lighten-2">
							<h5 class="center white-text">Login</h5>
						</div>
					</div>
					<div class="col s12 m4 l2">&nbsp;</div>
				</div>
			</div>
			<div class="section">
				<form class="col s12" method="post" action="<?php echo base_url("admin/login/logar") ?>">
					<div class="row">
						<div class="col s12 m4 l2">&nbsp;</div>
						<div class="input-field col s12 m4 l6">
							<i class="material-icons prefix">account_circle</i>
							<input type="text" id="login" name="login"  value="" class="validate" placeholder="Usuário" required autofocus>
							<label for="login">Usuário</label>
						</div>
						<div class="col s12 m4 l2">&nbsp;</div>
					</div>
					<div class="row">
						<div class="col s12 m4 l2">&nbsp;</div>
						<div class="input-field col s12 m4 l6">
							<i class="material-icons prefix">vpn_key</i>
							<input type="password" id="senha" name="senha" class="validate" placeholder="Senha" required>
							<label for="senha">Senha</label>
						</div>
						<div class="col s12 m4 l2">&nbsp;</div>
					</div>
					<div class="row">
						<div class="col s12 m4 l2">&nbsp;</div>
						<div class="input-field col s12 m4 l6">
					 		<button type="submit" class="btn waves-effect waves-light">ENTRAR</button>
						</div>
						<div class="col s12 m4 l2">&nbsp;</div>
					</div>
				</form>
			</div>
		</div>

		<?php if($this->session->flashdata('loginInvalido')): ?>
			<script>
				setTimeout(function(){
					$('#loginInvalido').fadeOut(3000);
				}, 4000);
			</script>
			<div id="loginInvalido">
				<font color="#FC5555"><?php echo $this->session->flashdata('loginInvalido'); ?></font>
			</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('loginVazio')): ?>
			<script>
				setTimeout(function(){
					$('#loginVazio').fadeOut(3000);
				}, 4000);
			</script>
			<div id="loginVazio">
				<font color="#FC5555"><?php echo $this->session->flashdata('loginVazio'); ?></font>
			</div>
		<?php endif; ?>

			<div class= "alert aler-danger" role="alert">
				<div class="alert aler-danger" role="alert"></div>
		</div>


</main>
  <footer class="page-footer teal lighten-2">
    <div class="footer-copyright">
      <div class="container">
      Feito com <a class="red-text" href="#"><3</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="<?php echo base_url("static/js/jquery-2.1.1.min.js"); ?>"></script>
  <script src="<?php echo base_url("static/js/materialize.js"); ?>"></script>
  <script src="<?php echo base_url("static/js/init.js"); ?>"></script>

  </body>
</html>