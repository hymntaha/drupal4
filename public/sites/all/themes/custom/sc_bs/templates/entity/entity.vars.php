<?php

/**
 * Process variables for entity.tpl.php.
 */
function sc_bs_preprocess_entity(&$variables, $hook) {
  $id = drupal_html_id($variables['title']);

  $variables['attributes_array']['id'] = $variables['entity_type'] . '-' . $id;

  $variables['theme_hook_suggestions'][] = $variables['entity_type'] . '__' .$id;

  unset($variables['attributes_array']['about']);
  unset($variables['attributes_array']['typeof']);

  $function = __FUNCTION__ . '_' . $variables['entity_type'];
  if (function_exists($function)) {
    $function($variables, $hook);
  }

}

function sc_bs_preprocess_entity_uc_cart_item(&$variables, $hook){
  $variables['page'] = TRUE;
}