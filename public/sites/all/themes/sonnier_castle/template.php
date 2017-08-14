<?php

/**
 * Override or insert variables into the node template.
 */
function sonnier_castle_preprocess_node(&$vars) {
  if($vars['node']->nid == variable_get('shop_form_nid','')){
  	$vars['classes_array'][] = 'node-shop-form';
  }
}