<div class="wrap">
	<h1><?php esc_html_e( 'Socialise Options', 'socialise' ); ?></h1>

	<form method="post" action="options.php">
		<h3><?php esc_html_e( 'Social Networks', 'socialise' ); ?></h3>

		<div>
			<ul id="sc-tiles">
			<?php foreach ( $this->networks->get_networks() as $network ) { ?>
			<li class="sc-tile-<?php echo $network->get_slug(); ?> <?php echo (($network->is_enabled()) ? 'sc-tile-enabled' : ''); ?>">
					<i class="socialise-icons-<?php echo $network->get_slug(); ?>"></i>
						<input name="socialise_<?php esc_attr_e( $network->get_slug() ); ?>_enabled" id="socialise_<?php esc_attr_e( $network->get_slug() ); ?>_enabled" type="hidden" value="<?php echo (($network->is_enabled()) ? '1' : '0'); ?>" />
				</li>
			<?php } ?>
			</ul>
		
			<p><?php esc_html_e( 'Click to enable / disable networks, and drag to re-order.', 'socialise' ); ?></p>
		</div>

		<?php settings_fields( 'socialise_options' ); ?>
		<?php do_settings_sections( 'socialise_options' ); ?>
		<?php submit_button(); ?>
	</form>
</div>
