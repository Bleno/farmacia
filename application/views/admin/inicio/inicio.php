<div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Seja Bem Vindo!</h1>
      <div class="row center">
      <?php if(empty($this->session->userdata('ultimo_login')) ) { ?>
        <h5 class="header col s12 light">Hoje foi seu primeito login</h5>
      <?php 
  			} else { 
  			$s = $this->session->userdata('ultimo_login');
			$date = strtotime($s);
			?>
        <h5 class="header col s12 light">Seu último login foi em <b><?php echo date('d/m/Y H:i:s', $date);?></b></h5>
       <?php } ?>
      </div>
      <br><br>

    </div>
</div>