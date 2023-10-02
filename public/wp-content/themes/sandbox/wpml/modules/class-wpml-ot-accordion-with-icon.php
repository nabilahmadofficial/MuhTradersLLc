<?php

/**
 * Class WPML_OT_Accordion_With_Icon
 */
class WPML_OT_Accordion_With_Icon extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'ot_accs';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'acc_title', 'acc_content' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'acc_title':
				return esc_html__( 'Accordion Title', 'sandbox' );

			case 'acc_content':
				return esc_html__( 'Accordion Content', 'sandbox' );

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
			case 'acc_title':
				return 'LINE';

			case 'acc_content':
				return 'VISUAL';

			default:
				return '';
		}
	}

}
