<div class="socialise">
	<ul>
		<?php foreach ( $this->get_networks() as $network ) { ?>
			<?php if ( $network->is_enabled() ) { ?>
			<?php echo $network->html_li_tag(); ?>
				<?php echo $network->html_link_tag(); ?>
					<i class="socialise-icons-<?php echo $network->get_slug(); ?>"></i>
					<?php echo $network->get_name(); ?>
				</a>
			</li>
			<?php } ?>
		<?php } ?>
	</ul>
</div>
