<?php
namespace LoftOcean\Elementor\Control;

class Control_Switcher extends \Elementor\Base_Data_Control {
	/**
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'loftocean-switcher-control';
	}
	/**
	 * Get sortable select control default settings.
	 *
	 * Retrieve the default settings of the sortable select control.
	 * @access protected
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'label_off' => esc_html__( 'No', 'loftocean' ),
			'label_on' => esc_html__( 'Yes', 'loftocean' ),
			'disabled' => false,
			'return_value' => 'yes',
		];
	}
	/**
	 * Enqueue sortable select control scripts and styles.
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'loftocean-switcher-control', LOFTOCEAN_ASSETS_URI . 'scripts/admin/elementor/control-switcher.min.js', array( 'jquery' ), LOFTOCEAN_ASSETS_VERSION, true );
	}

	/**
	 * Render sortable select control output in the editor.
	 * @access public
	 */
	public function content_template() { ?>
		<div class="elementor-control-field">
			<label for="<?php $this->print_control_uid(); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<label class="elementor-switch elementor-control-unit-2">
					<input id="<?php $this->print_control_uid(); ?>" type="checkbox" data-setting="{{ data.name }}" class="elementor-switch-input" value="{{ data.return_value }}"<# if ( data.disabled ) { #> disabled<# } #>>
					<span class="elementor-switch-label" data-on="{{ data.label_on }}" data-off="{{ data.label_off }}"></span>
					<span class="elementor-switch-handle"></span>
				</label>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}
}
