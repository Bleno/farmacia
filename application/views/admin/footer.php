</main>
  <footer class="page-footer teal lighten-2">
    <div class="container">
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="<?php echo base_url("static/js/jquery-2.1.1.min.js"); ?>"></script>
  <script src="<?php echo base_url("static/js/materialize.js"); ?>"></script>
  <script src="<?php echo base_url("static/js/init.js"); ?>"></script>
  <?php if(isset($js)): foreach($js as $value):?>
  <script src="<?php echo base_url("static/$value"); ?>" type="text/javascript"></script>
  <?php   endforeach; endif; ?>
  <?php if (isset($css)): foreach($css as $value):?>
  <link href="<?php echo base_url("static/$value"); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  <?php endforeach; endif;?>
  </body>
</html>