<div class="container">
			<div class="section">
				
			</div>
			<div class="section">
				
			</div>
				<div class="col s12 m12 l6">
					<div class="card">
						<div class="card-content light-blue lighten-1">
							<h5 class="center white-text">CONTATO</h5>
						</div>
						<div class="card-content">
						<div class="row">
							<form class="col s12 m12 l6" method="post">
								<div class="row">	
									<div class="input-field col s12 m12 l12">
										<input type="text" id="nome" name="nome"  value="<?php echo set_value("nome"); ?>" class="validate" required autofocus>
										<label for="nome">Nome</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l12">
										<input type="email" id="email" name="email" value="<?php echo set_value("email"); ?>" class="validate" required>
										<label for="email">E-mail</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l12">
										<input type="text" id="telefone" name="telefone" value="<?php echo set_value("telefone"); ?>" class="validate" required>
										<label for="telefone">Telefone</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l12">
										<textarea id="mensagem" name="mensagem" class="materialize-textarea"><?php echo set_value("mensagem"); ?></textarea>
										<label for="mensagem">Mensagem</label>
									</div>
								</div>
								<div class="row">
									<div class="file-field input-field">
									    <div class="btn">
									        <span>Carregar receita</span>
									        <input type="file">
									    </div>
									    <div class="file-path-wrapper">
									        <input class="file-path validate" type="text">
									    </div>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l12">
										 <input title="Digite os valores da imagem" id="captcha" name="captcha" type="text" class="validate" required>
										<label for="captcha">Captcha</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l12">
										 <?php echo $image; ?>										
									</div>
								</div>
								<div class="row">
									<div class="divider"></div>
									<div class="center input-field col s12 m12 l12">
						 				<button type="submit" class="btn waves-effect waves-light"><i class="material-icons left">send</i>ENVIAR</button>
									</div>
								</div>
							</form>
							<div class="center hide-on-small-only">
								<br/>
								<br/>
								<br/>
								<br/>
								<br/>
								<img src="<?php echo base_url("static/img/logo.png"); ?>" alt="">
							</div>
						</div>
						</div>
					</div> <!-- card -->
				</div>
		</div>