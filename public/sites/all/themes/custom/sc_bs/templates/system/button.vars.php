<?php
/**
 * @file
 * button.vars.php
 */

/**
 * Implements hook_preprocess_button().
 */
function sc_bs_preprocess_button(&$vars) {
	if($vars['element']['#value'] == 'Remove'){
		$vars['element']['#attributes']['class'] = array('btn','btn-link');
	}
}
