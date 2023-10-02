<?php

/**
 * Class WPML_OT_Big_Tabs
 */
class WPML_OT_Big_Tabs extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'ot_tabs';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'tab_title', 'tab_content', 'tabs_link' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			
			case 'tab_title':
				return esc_html__( 'Title', 'sandbox' );

			case 'tab_content':
				return esc_html__( 'Tab Content', 'sandbox' );

			case 'tabs_link':
				return esc_html__( 'Tab Link', 'sandbox' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch( $field ) {

			case 'tab_title':
			case 'tabs_link':
				return 'LINE';

			case 'tab_content':
				return 'VISUAL';
			
			default:
				return '';
		}
	}

}
