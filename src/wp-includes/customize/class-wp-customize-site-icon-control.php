<?php
/**
 * Customize API: WP_Customize_Site_Icon_Control class
 *
 * @package WordPress
 * @subpackage Customize
 * @since 4.4.0
 */

/**
 * Customize Site Icon control class.
 *
 * Used only for custom functionality in JavaScript.
 *
 * @since 4.3.0
 *
 * @see WP_Customize_Cropped_Image_Control
 */
class WP_Customize_Site_Icon_Control extends WP_Customize_Cropped_Image_Control {

	/**
	 * Control type.
	 *
	 * @since 4.3.0
	 * @access public
	 * @var string
	 */
	public $type = 'site_icon';

	/**
	 * Constructor.
	 *
	 * @since 4.3.0
	 * @access public
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		add_action( 'customize_controls_print_styles', 'wp_site_icon', 99 );
	}

	/**
	 * Render a JS template for the content of the site icon control.
	 *
	 * @since 4.5.0
	 */
	public function content_template() {
		?>
		<label for="{{ data.settings['default'] }}-button">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
		</label>

		<# if ( data.attachment && data.attachment.id ) { #>
		<div class="current">
			<div class="container">
				<div class="attachment-media-view attachment-media-view-{{ data.attachment.type }} {{ data.attachment.orientation }} site-icon-preview">
					<strong><?php _e( 'As a browser icon' ); ?></strong>
					<div class="favicon-preview">
						<img src="images/browser.png" class="browser-preview" width="182" height="" alt="" />

						<div class="favicon">
							<img id="preview-favicon" src="{{ data.attachment.sizes.full.url }}" alt="<?php esc_attr_e( 'Preview as a browser icon' ); ?>"/>
						</div>
						<span class="browser-title"><?php bloginfo( 'name' ); ?></span>
					</div>

					<strong><?php _e( 'As an app icon' ); ?></strong>
					<p class="app-icon-preview">
						<img id="preview-app-icon" src="{{ data.attachment.sizes.full.url }}" alt="<?php esc_attr_e( 'Preview as an app icon' ); ?>"/>
					</p>
				</div>
			</div>
		</div>
		<div class="actions">
			<# if ( data.canUpload ) { #>
				<button type="button" class="button remove-button"><?php echo $this->button_labels['remove']; ?></button>
				<button type="button" class="button upload-button" id="{{ data.settings['default'] }}-button"><?php echo $this->button_labels['change']; ?></button>
				<div style="clear:both"></div>
			<# } #>
		</div>
		<# } else { #>
		<div class="current">
			<div class="container">
				<div class="placeholder">
					<div class="inner">
						<span><?php echo $this->button_labels['placeholder']; ?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="actions">
			<# if ( data.defaultAttachment ) { #>
				<button type="button" class="button default-button"><?php echo $this->button_labels['default']; ?></button>
			<# } #>
			<# if ( data.canUpload ) { #>
				<button type="button" class="button upload-button" id="{{ data.settings['default'] }}-button"><?php echo $this->button_labels['select']; ?></button>
			<# } #>
			<div style="clear:both"></div>
		</div>
		<# } #>
		<?php
	}
}
