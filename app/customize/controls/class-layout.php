<?php
/**
 * Layout customize control.
 *
 * Customize control class to handle theme layouts. Only layouts that have an
 * image will be shown.
 *
 * @package   Hybrid
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2018, Justin Tadlock
 * @link      https://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Customize\Controls;

/**
 * Theme Layout customize control class.
 *
 * @since  5.0.0
 * @access public
 */
class Layout extends RadioImage {

	/**
	 * The default customizer section this control is attached to.
	 *
	 * @since  5.0.0
	 * @access public
	 * @var    string
	 */
	public $section = 'hybrid-layout';

	/**
	 * Set up our control.
	 *
	 * @since  5.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = [] ) {

		// Array of allowed layouts. Pass via `$args['layouts']`.
		$allowed = ! empty( $args['layouts'] ) ? $args['layouts'] : array_keys( \Hybrid\get_layouts() );

		// Loop through each of the layouts and add it to the choices array with proper key/value pairs.
		foreach ( \Hybrid\get_layouts() as $layout ) {

			if ( in_array( $layout->name, $allowed ) && ! ( 'theme_layout' === $id && false === $layout->is_global_layout ) && $layout->image ) {

				$args['choices'][ $layout->name ] = [
					'label' => $layout->label,
					'url'   => \Hybrid\sprintf_theme_uri( $layout->image )
				];
			}
		}

		// Let the parent class handle the rest.
		parent::__construct( $manager, $id, $args );
	}
}
