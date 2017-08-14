<?php

/**
 * Override or insert variables into the node template.
 */
function sc_bs_preprocess_node(&$vars) {
	$vars['theme_hook_suggestions'][] = 'node__'.$vars['view_mode'];
	$vars['theme_hook_suggestions'][] = 'node__' . $vars['node']->type . '__'.$vars['view_mode'];
	$vars['theme_hook_suggestions'][] = 'node__' . $vars['node']->nid . '__'.$vars['view_mode'];
	
	if($vars['node']->nid == variable_get('shop_form_nid','')){
		$vars['classes_array'][] = 'node-shop-form';
	}
}