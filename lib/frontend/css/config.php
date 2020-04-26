<?php
	// ##### SETTINGS #####

	// Fetches all settings and creates new variables with the setting ID as name and setting data as value.
	// This reduces the lines of code for the needed setting values.
	foreach ( $script->get_parent()->get_settings() as $setting ) {
		if ( $setting->get_type() !== false ) {
			${ $setting->get_ID() } = $setting->get_data();
		}
	}

	$properties					= array();

	// Font
	// @todo: double code
	$value						= $font;
	$font_family				= false;
	$font_weight				= false;
	foreach($value as $breakpoint => $val) {
		if($val) {
			$f							= $setting->get_parent()->get_module('sv_webfontloader')->get_font_by_label($val);
			$font_family[$breakpoint]	= $f['family'];
			$font_weight[$breakpoint]	= $f['weight'];
		}else{
			$font_family[$breakpoint]	= false;
			$font_weight[$breakpoint]	= false;
		}
	}
	if($font_family && (count(array_unique($font_family)) > 1 || array_unique($font_family)['mobile'] !== false)){
		$properties['font-family']	= $setting->prepare_css_property_responsive($font_family,'',', sans-serif;');
		$properties['font-weight']	= $setting->prepare_css_property_responsive($font_weight,'','');
	}

	if($font_size) {
		$properties['font-size']	= $setting->prepare_css_property_responsive($font_size,'','px');
	}

	if($line_height) {
		$properties['line-height']	= $setting->prepare_css_property_responsive($line_height);
	}

	if($text_color){
		$properties['color']		= $setting->prepare_css_property_responsive($text_color,'rgba(',')');
	}

	// Margin
	if($margin) {
		$imploded		= false;
		foreach($margin as $breakpoint => $val) {
			$top = (isset($val['top']) && strlen($val['top']) > 0) ? $val['top'] : false;
			$right = (isset($val['right']) && strlen($val['right']) > 0) ? $val['right'] : false;
			$bottom = (isset($val['bottom']) && strlen($val['bottom']) > 0) ? $val['bottom'] : false;
			$left = (isset($val['left']) && strlen($val['left']) > 0) ? $val['left'] : false;

			if($top !== false || $right !== false || $bottom !== false || $left !== false) {
				$imploded[$breakpoint] = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
			}
		}
		if($imploded) {
			$properties['margin'] = $setting->prepare_css_property_responsive($imploded, '', ''); // unnecessary , returns the same as line 56?
		}
	}

	// Padding
	// @todo: same as margin, refactor to avoid doubled code
	if($padding) {
		$imploded		= false;
		foreach($padding as $breakpoint => $val) {
			$top = (isset($val['top']) && strlen($val['top']) > 0) ? $val['top'] : false;
			$right = (isset($val['right']) && strlen($val['right']) > 0) ? $val['right'] : false;
			$bottom = (isset($val['bottom']) && strlen($val['bottom']) > 0) ? $val['bottom'] : false;
			$left = (isset($val['left']) && strlen($val['left']) > 0) ? $val['left'] : false;

			if($top !== false || $right !== false || $bottom !== false || $left !== false) {
				$imploded[$breakpoint] = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
			}
		}
		if($imploded) {
			$properties['padding'] = $setting->prepare_css_property_responsive($imploded, '', '');
		}
	}

	// border
	if($border) {

		foreach ($border as $breakpoint => &$query) {

			if ($query['top_width']) {
				$val = $query['top_width'] . ' ' . $query['top_style'] . ' rgba(' . $query['color'] . ')';
				$properties['border-top'][$breakpoint] 		= $val;
			}

			if ($query['right_width']) {
				$val = $query['right_width'] . ' ' . $query['right_style'] . ' rgba(' . $query['color'] . ')';
				$properties['border-right'][$breakpoint] 	= $val;
			}

			if ($query['bottom_width']) {
				$val = $query['bottom_width'] . ' ' . $query['bottom_style'] . ' rgba(' . $query['color'] . ')';
				$properties['border-bottom'][$breakpoint] 	= $val;
			}

			if ($query['left_width']) {
				$val = $query['left_width'] . ' ' . $query['left_style'] . ' rgba(' . $query['color'] . ')';
				$properties['border-left'][$breakpoint] 	= $val;
			}

			$query['top_left_radius'] 		= (empty($query['top_left_radius'])) ? 0 : (int)$query['top_left_radius'];
			$query['top_right_radius'] 		= (empty($query['top_right_radius'])) ? 0 : (int)$query['top_right_radius'];
			$query['bottom_right_radius'] 	= (empty($query['bottom_right_radius'])) ? 0 : (int)$query['bottom_right_radius'];
			$query['bottom_left_radius'] 	= (empty($query['bottom_left_radius'])) ? 0 : (int)$query['bottom_left_radius'];

			if ($query['top_left_radius'] + $query['top_right_radius'] + $query['bottom_right_radius'] + $query['bottom_left_radius'] > 0) {
				// @todo: implement unit settings here
				//$query_radius = $query['top_left_radius'] . ' ' . $query['top_right_radius'] . ' ' . $query['bottom_right_radius'] . ' ' . $query['bottom_left_radius'];
				$query_radius = $query['top_left_radius'] . 'px ' . $query['top_right_radius'] . 'px ' . $query['bottom_right_radius'] . 'px ' . $query['bottom_left_radius'] . 'px';
				$properties['border-radius'][$breakpoint] 	= $query_radius;
			}
		}
    
	}

	echo $setting->build_css(
		is_admin() ? '.editor-styles-wrapper p' : '.sv100_sv_content_wrapper article p',
		$properties
	);