<?php

/**
 * This file contains the Select Setting class.
 *
 * @since      0.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes/lib/settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This class represents a Select setting.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes/lib/settings
 * @author     Your Name <your.name@example.com>
 */
class Plugin_Name_Select_Setting extends Plugin_Name_Abstract_Setting {

	/**
	 * The currently-selected value of this select.
	 *
	 * @since    0.0.0
	 * @access   protected
	 * @var      string
	 */
	protected $value;

	/**
	 * The list of options.
	 *
	 * @since    0.0.0
	 * @access   protected
	 * @var      array
	 */
	protected $options;

	/**
	 * Creates a new instance of this class.
	 *
	 * @param    string   $name     The name that identifies this setting.
	 * @param    string   $desc     A text that describes this field.
	 * @param    string   $more     A link pointing to more information about this field.
	 * @param    array    $options  The list of options.
	 *
	 * @since    0.0.0
	 * @access   public
	 */
	public function __construct( $name, $desc, $more, $options ) {
		parent::__construct( $name, $desc, $more );
		$this->options = $options;
	}

	/**
	 * Specifies which option is selected.
	 *
	 * @param    string   $value    The currently-selected value of this select.
	 *
	 * @since    0.0.0
	 * @access   public
	 */
	public function set_value( $value ) {
		$this->value = $value;
	}

	// @Implements
	public function display() {

		// Preparing data for the partial
		// -----------------------------------------------
		$id       = str_replace( '_', '-', $this->name );
		$name     = $this->option_name . '[' . $this->name . ']';
		$value    = $this->value;
		$options  = $this->options;
		$desc     = $this->desc;
		$more     = $this->more;
		// -----------------------------------------------
		include PLUGIN_NAME_INCLUDES_DIR . '/lib/settings/partials/plugin-name-select-setting.php';

	}

	// @Implements
	public function sanitize( $input ) {
		if ( ! isset( $input[$this->name] ) ) {
			$input[$this->name] = $this->value;
		}
		$is_value_correct = false;
		foreach ( $this->options as $option ) {
			if ( $option['value'] === $input[$this->name] ) {
				$is_value_correct = true;
			}
		}
		if ( ! $is_value_correct ) {
			$input[$this->name] = $this->value;
		}
		return $input;
	}

}