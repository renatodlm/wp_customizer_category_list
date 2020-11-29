<?php

/**
 * Renato Theme Customizer
 *
 * @package Renato
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function inside_customize_register($wp_customize)
{


	/*=====
	Category List
	======*/

	$wp_customize->add_section(
		'sec_category_list',
		array(
			'title' => 'Category List',
			'description' => 'Here you can choose a list of categories.'
		)
	);

	require_once 'custom-control.php';

	$wp_customize->add_setting('set_category_list');

	$wp_customize->add_control(
		new Cstmzr_Category_Checkboxes_Control(
			$wp_customize,
			'set_category_list',
			array(
				'label' => 'Categories:',
				'section' => 'sec_category_list',
				'settings' => 'set_category_list'
			)
		)
	);
}
add_action('customize_register', 'inside_customize_register');
