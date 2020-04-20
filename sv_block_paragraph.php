<?php
	namespace sv100;

	/**
	 * @version         4.001
	 * @author			straightvisions GmbH
	 * @package			sv100
	 * @copyright		2019 straightvisions GmbH
	 * @link			https://straightvisions.com
	 * @since			1.000
	 * @license			See license.txt or https://straightvisions.com
	 */

	class sv_block_paragraph extends init {
		public function init() {
			$this->set_module_title( __( 'Block: Paragraph', 'sv100' ) )
				->set_module_desc( __( 'Settings for Gutenberg Block', 'sv100' ) )
				->load_settings()
				->register_scripts()
				->set_section_title( $this->get_module_title() )
				->set_section_desc( $this->get_module_desc() )
				->set_section_type( 'settings' )
				->set_section_template_path( $this->get_path( 'lib/backend/tpl/settings.php' ) )
				->set_section_order(130)
				->get_root()
				->add_section( $this );
		}

		protected function load_settings(): sv_block_paragraph {
			$this->get_setting( 'font_family' )
				->set_title( __( 'Font Family', 'sv100' ) )
				->set_description( __( 'Choose a font for your text.', 'sv100' ) )
				->set_options( $this->get_module( 'sv_webfontloader' )->get_font_options() )
				->set_is_responsive(true)
				->load_type( 'select' );

			$this->get_setting( 'font_size' )
				->set_title( __( 'Font Size', 'sv100' ) )
				->set_description( __( 'Font Size in pixel.', 'sv100' ) )
				->set_default_value( 16 )
				->set_is_responsive(true)
				->load_type( 'number' );

			$this->get_setting( 'line_height' )
				->set_title( __( 'Line Height', 'sv100' ) )
				->set_description( __( 'Set line height as multiplier or with a unit.', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'text' );

			$this->get_setting( 'text_color' )
				->set_title( __( 'Text Color', 'sv100' ) )
				->set_default_value( '#1e1e1e' )
				->set_is_responsive(true)
				->load_type( 'color' );

			$this->get_setting( 'margin' )
				->set_title( __( 'Margin', 'sv100' ) )
				->set_is_responsive(true)
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
			// Register Styles
			$this->get_script( 'common' )
				->set_is_gutenberg()
				->set_path( 'lib/frontend/css/common.css' );

			$this->get_script( 'config' )
				->set_path( 'lib/frontend/css/config.php' )
				->set_is_gutenberg()
				->set_inline( true );

			add_action('wp', array($this,'enqueue_scripts'));
			add_action('admin_init', array($this,'enqueue_scripts'));

			return $this;
		}
		public function enqueue_scripts(): sv_block_paragraph {
			if( ! is_admin() ) {
				$post = get_post();

				if ( !has_block( 'paragraph', $post )) {
					return $this;
				}
			}

			$this->get_script( 'common' )->set_is_enqueued();
			$this->get_script( 'config' )->set_is_enqueued();

			return $this;
		}
	}