<!DOCTYPE html>
<html lang="pt-br">
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
      background: #eceff1;
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
				<div class="col s12 m12 l6">
					<div class="card">
						<div class="card-content teal lighten-2">
							<h5 class="center white-text">LOGIN</h5>
						</div>
						<div class="card-content">
						<div class="row">
							<form class="col s12 m12 l6" method="post" action="<?php echo base_url("admin/login/logar") ?>">
								<div class="row">	
									<div class="input-field col s12 m12 l12">
										<i class="material-icons prefix">account_circle</i>
										<input type="text" id="login" name="login"  value="" class="validate" required autofocus>
										<label for="login">Usuário</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l12">
										<i class="material-icons prefix">vpn_key</i>
										<input type="password" id="senha" name="senha" class="validate" required>
										<label for="senha">Senha</label>
									</div>
								</div>
								<div class="row">
									<div class="center input-field col s12 m12 l12">
						 				<button type="submit" class="btn waves-effect waves-light">ENTRAR</button>
									</div>
								</div>
							</form>
							<div class="center hide-on-small-only">
								<img src="<?php echo base_url("static/img/logo.png"); ?>" alt="">
							</div>
						</div>
						</div>
					</div> <!-- card -->
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