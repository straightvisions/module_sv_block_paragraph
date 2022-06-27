<?php
	namespace sv100;

	class sv_block_paragraph extends init {
		public function init() {
			$this->set_module_title( __( 'Block: Paragraph', 'sv100' ) )
				->set_module_desc( __( 'Settings for Gutenberg Block', 'sv100' ) )
				->set_css_cache_active()
				->set_section_title( $this->get_module_title() )
				->set_section_desc( $this->get_module_desc() )
				->set_section_template_path()
				->set_section_order(5000)
				->set_section_icon('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9.737 0c-3.72 0-6.737 2.779-6.737 6.5s3.279 6.5 7 6.5v11h2v-22h5v22h1.969v-20c0-1.592.381-2 2.031-2v-2h-11.263z"/></svg>')
				->set_block_handle('wp-block-paragraph')
				->set_block_name('core/paragraph')
				->get_root()
				->add_section( $this );
		}

		protected function load_settings(): sv_block_paragraph {
			$this->get_setting( 'font' )
				->set_title( __( 'Font Family', 'sv100' ) )
				->set_description( __( 'Choose a font for your text.', 'sv100' ) )
				->set_options( $this->get_module( 'sv_webfontloader' ) ? $this->get_module( 'sv_webfontloader' )->get_font_options() : array('' => __('Please activate module SV Webfontloader for this Feature.', 'sv100')) )
				->set_is_responsive(true)
				->load_type( 'select' );

			$this->get_setting( 'font_size' )
				->set_title( __( 'Font Size', 'sv100' ) )
				->set_description( __( 'Font Size in Pixel', 'sv100' ) )
				->set_default_value( $this->get_module( 'sv_common' ) ? $this->get_module( 'sv_common' )->get_setting('font_size')->get_data() : false )
				->set_is_responsive(true)
				->load_type( 'number' );

			$this->get_setting( 'line_height' )
				->set_title( __( 'Line Height', 'sv100' ) )
				->set_description( __( 'Set line height as multiplier or with a unit.', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'text' );

			$this->get_setting( 'text_color' )
				->set_title( __( 'Text Color', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'color' );

			$this->get_setting( 'margin' )
				->set_title( __( 'Margin', 'sv100' ) )
				->set_is_responsive(true)
				->set_default_value(array(
					'top'		=> '10px',
					'right'		=> 'auto', // could be wrong
					'bottom'	=> '20px',
					'left'		=> 'auto' // could be wrong
				))
				->load_type( 'margin' );

			$this->get_setting( 'padding' )
				->set_title( __( 'Padding', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'margin' );

			$this->get_setting( 'border' )
				->set_title( __( 'Border', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'border' );

			return $this;
		}
		protected function register_scripts(): sv_block_paragraph {
			parent::register_scripts();

			// Register Styles
			$this->get_script( 'align-wide' )
				->set_is_gutenberg()
				->set_block_style(__('Align Wide', 'sv100'))
				->set_path( 'lib/css/common/style_align_wide.css' );

			$this->get_script( 'align-full' )
				->set_is_gutenberg()
				->set_block_style(__('Align Full', 'sv100'))
				->set_path( 'lib/css/common/style_align_full.css' );

			return $this;
		}
	}