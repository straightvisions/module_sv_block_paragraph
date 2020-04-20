<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
	<div class="sv_section_description"><?php echo $module->get_section_desc(); ?></div>
	<h3 class="divider"><?php _e( 'Font', 'sv100' ); ?></h3>
	<div class="sv_setting_flex">
		<?php
			echo $module->get_setting( 'font' )->form();
			echo $module->get_setting( 'font_size' )->form();
			echo $module->get_setting( 'line_height' )->form();
			echo $module->get_setting( 'text_color' )->form();
		?>
	</div>
	<div class="sv_setting_flex">
		<?php
			echo $module->get_setting( 'margin' )->form();
			echo $module->get_setting( 'padding' )->form();
		?>
	</div>
	<div class="sv_setting_flex">
		<?php
			echo $module->get_setting( 'border' )->form();
		?>
	</div>
<?php } ?>