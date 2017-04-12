<div class="container">
<!-- 	<div class="section">
		<div class="row">
			<div class="col s12 l12">
				<h4 class="orange-text center">PRODUTOS</h4>
			</div>
		</div>
	</div> -->
	<div class="">
		<div class="row">
			<div class="col s12 l12">
				<h4 class="orange-text center">PRODUTOS</h4>
			</div>
		</div>
		<div class="card-content">
			<div class="row">
				<div class="col s12 l2">
					<div class="collection">
					<?php foreach ($categorias as $categoria): ?>
						<a class="collection-item" href="<?php echo base_url("produtos/categoria/$categoria->slug"); ?>"><?php echo $categoria->nome; ?></a>
					<?php endforeach; ?>
					</div>
				</div>
				<div class="col s12 l10">
					<?php $count = 1; ?>
					<?php foreach ($produtos as $produto): ?>
						<?php if ($count > 3): $count = 1; endif;?>
					<?php if( $count == 1 ): ?>	<div class="row"> <?php endif; ?>
		  				<div class="col s6 l4">
							<div class="card small">
								<div class="card-image">
									<img src="<?php echo base_url("produtos_images/$produto->imagem"); ?>" alt="<?php echo $produto->nome; ?>">
								</div>
								<div class="card-content">
									<p><?php echo $produto->nome; ?></p>
								</div>
								<div class="card-action">
									<a href="<?php echo base_url("produtos/$produto->categoria_slug/$produto->slug"); ?>"><b>R$ <?php echo $produto->valor; ?></b></a>
								</div>
							</div>
		  				</div>
						<?php $count++; ?>
					<?php if( $count == 1 ): ?>	</div> <?php endif; ?>
		  				<?php endforeach; ?>
				</div>
			</div>
			<div class="row">
				<div class="col s12 l12">
				 	<p><?php echo $links; ?></p>
				 </div>
			</div>
		</div>
	</div>
</div>

