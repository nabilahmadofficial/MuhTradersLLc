<?php

/**
 * Class WPML_OT_Progress_Bars
 */
class WPML_OT_Progress_Bars extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'ot_progress';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'title', 'desc_text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'title':
				return esc_html__( 'Title', 'sandbox' );

			case 'desc_text':
				return esc_html__( 'Description', 'sandbox' );

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
			
			case 'title':
				return 'LINE';

			case 'desc_text':
				return 'AREA';

			default:
				return '';
		}
	}

}
