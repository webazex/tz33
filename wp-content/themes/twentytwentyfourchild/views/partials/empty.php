<?php ?>
<section id="features">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="empty-content-container">
					<div class="empty-content-container__content">
						<div class="content__centered-empty-block">
							<p>
								<?php _e($args['text'], 'tt');?>
							</p>
							<a href="<?php echo $args['link-to'];?>">
								<span>
									<?php _e($args['text-to-link'], 'tt');?>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
