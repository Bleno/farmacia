<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

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
    <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Painel Administrativo</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#">Produto</a></li>
                <li><a href="<?php echo base_url("admin/categoria"); ?>">Categoria</a></li>
                <li><a href="#">Usuários</a></li>
                <li><a href="#"><?php echo $this->session->userdata('nome'); ?></a></li>
            </ul>
            <ul id="nav-mobile" class="side-nav">
                <li><a href="#"><?php echo $this->session->userdata('nome'); ?></a></li>
                <li><a href="#">Produto</a></li>
                <li><a href="<?php echo base_url("admin/categoria"); ?>">Categoria</a></li>
                <li><a href="#">Usuários</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>