<?php

	echo $_s->build_css(
		'.wp-site-blocks,
		.editor-styles-wrapper',
		array_merge(
			$module->get_setting('font')->get_css_data('font-family'),
			$module->get_setting('font_size')->get_css_data('font-size','','px'),
			$module->get_setting('line_height')->get_css_data('line-height'),
			$module->get_setting('text_color')->get_css_data(),
		)
	);

	echo $_s->build_css(
		'.wp-site-blocks p,
		.editor-styles-wrapper p',
		array_merge(
			$module->get_setting('padding')->get_css_data('padding'),
			$module->get_setting('margin')->get_css_data()
		)
	);
	