<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title><?php echo ucfirst($pasta); ?> - Painel administrativo</title>

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
  <script type="text/javascript">
      var base_url = "<?php echo base_url() ;?>";
  </script>
</head>
<main>
<body>
    <nav class="teal lighten-2" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="<?php echo base_url("admin");?>" class="brand-logo">Painel Administrativo</a>
            <ul class="right hide-on-med-and-down">
                <li <?php if ($pasta == 'produto'): ?> class="active" <?php endif; ?> ><a href="<?php echo base_url("admin/produto"); ?>">Produto</a></li>
                <li <?php if ($pasta == 'categoria'): ?> class="active" <?php endif; ?> ><a href="<?php echo base_url("admin/categoria"); ?>">Categoria</a></li>
                <li <?php if ($pasta == 'usuario'): ?> class="active" <?php endif; ?> ><a href="<?php echo base_url("admin/usuario"); ?>">Usuários</a></li>
                <li><a href="#" data-activates="slide-out" id="lateral"><i class="material-icons">settings</i></a></li>
            </ul>
            <ul id="nav-mobile" class="side-nav">
                <li><a href="<?php echo base_url("admin/produto"); ?>">Produto</a></li>
                <li><a href="<?php echo base_url("admin/categoria"); ?>">Categoria</a></li>
                <li><a href="<?php echo base_url("admin/usuario"); ?>">Usuários</a></li>
                <li><a href="#" data-activates="slide-out" id="lateral2"><i class="material-icons">settings</i></a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <ul id="slide-out" class="side-nav">
    <li>
      <div class="userView">
        <a href="#!user" class="center"><i class="material-icons large white-text">supervisor_account</i></a>
        <a href="#!name"><span class="white-text name"><b><?php echo strtoupper($this->session->userdata('nome')); ?></b></span></a>
        <a href="#!email"><span class="white-text email"><?php echo $this->session->userdata('email'); ?></span></a>
      </div>
    </li>
    <li><a href="<?php echo base_url("admin/usuario/alterar_senha"); ?>">Mudar Senha</a></li>
    <li><div class="divider"></div></li>
    <li><a href="<?php echo base_url("admin/login/logout"); ?>">Sair</a></li>
    </ul>