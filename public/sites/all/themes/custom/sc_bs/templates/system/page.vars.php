<?php
/**
 * @file
 * page.vars.php
 */

/**
 * Implements hook_preprocess_page().
 *
 * @see page.tpl.php
 */
function sc_bs_preprocess_page(&$variables) {
  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-sm-6"';
  }
  elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-sm-9"';
  }
  else {
    $variables['content_column_class'] = ' class="col-sm-12"';
  }

  // Primary nav.
  $variables['primary_nav'] = FALSE;
  if ($variables['main_menu']) {
    // Build links.
    $variables['primary_nav'] = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
    // Provide default theme wrapper function.
    $variables['primary_nav']['#theme_wrappers'] = array('menu_tree__primary');
  }

  // Primary nav.
  if ($variables['primary_nav']) {
    $variables['primary_nav_mobile'] = $variables['primary_nav'];
    foreach($variables['primary_nav_mobile'] as $delta => $menu){
      if(isset($menu['#theme'])){
        $variables['primary_nav_mobile'][$delta]['#theme'] = 'menu_link__main_menu_mobile';
      }
      if(isset($menu['#below'])){
        foreach($menu['#below'] as $sub_delta => $sub_menu){
          if(isset($variables['primary_nav_mobile'][$delta]['#below'][$sub_delta]['#theme'])){
            $variables['primary_nav_mobile'][$delta]['#below'][$sub_delta]['#theme'] = 'menu_link__main_menu_mobile';
          }
        }
      }
    }
  }

  $variables['page']['navigation_mobile'] = array();
  if($variables['page']['navigation']){
    $variables['page']['navigation_mobile'] = $variables['page']['navigation'];
    unset($variables['page']['navigation_mobile']['contact_contact_header']);
    $variables['page']['navigation_mobile']['search_form']['search_block_form']['#mobile'] = TRUE;
  }

  $variables['navbar_classes_array'] = array('navbar');

  if (theme_get_setting('bootstrap_navbar_position') !== '') {
    $variables['navbar_classes_array'][] = 'navbar-' . theme_get_setting('bootstrap_navbar_position');
  }
  else {
    $variables['navbar_classes_array'][] = 'container';
  }
  if (theme_get_setting('bootstrap_navbar_inverse')) {
    $variables['navbar_classes_array'][] = 'navbar-inverse';
  }
  else {
    $variables['navbar_classes_array'][] = 'navbar-default';
  }
}

