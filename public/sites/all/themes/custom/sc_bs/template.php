<?php

require_once('templates/entity/entity.vars.php');

require_once('templates/menu/menu-link.func.php');

require_once('templates/node/node.vars.php');

require_once('templates/system/button.vars.php');
require_once('templates/system/page.vars.php');
require_once('templates/system/table.vars.php');

require_once('templates/alter.inc');

/**
 * Themes the shopping cart block content.
 *
 * @param $variables
 *   An associative array containing:
 *   - help_text: Text to place in the small help text area beneath the cart
 *     block title or FALSE if disabled.
 *   - items: An associative array of cart item information containing:
 *     - qty: Quantity in cart.
 *     - title: Item title.
 *     - price: Item price.
 *     - desc: Item description.
 *   - item_count: The number of items in the shopping cart.
 *   - item_text: A textual representation of the number of items in the
 *     shopping cart.
 *   - total: The unformatted total of all the products in the shopping cart.
 *   - summary_links: An array of links used in the cart summary.
 *   - collapsed: TRUE or FALSE indicating whether or not the cart block is
 *     collapsed.
 *
 * @ingroup themeable
 */
function sc_bs_uc_cart_block_content($variables) {
  $output = '';

  if(count(uc_cart_get_contents()) > 0){
    $output .= l('Shopping Bag | '.$variables['item_count'],'cart');
  }

  return $output;
}

/**
 * Default theme implementation for the coupon submit form.
 */
function sc_bs_uc_coupon_form($variables) {
  $form = $variables['form'];
  $output = '';
  $form['code']['#title'] = 'Enter Promo Code:';
  $output .= drupal_render_children($form);
  return $output;
}

/**
 * Formats the cart contents table on the checkout page.
 *
 * @param $variables
 *   An associative array containing:
 *   - show_subtotal: TRUE or FALSE indicating if you want a subtotal row
 *     displayed in the table.
 *   - items: An associative array of cart item information containing:
 *     - qty: Quantity in cart.
 *     - title: Item title.
 *     - price: Item price.
 *     - desc: Item description.
 *
 * @return
 *   The HTML output for the cart review table.
 *
 * @ingroup themeable
 */
function sc_bs_uc_cart_review_table($variables) {
  $items = $variables['items'];
  $show_subtotal = $variables['show_subtotal'];

  $subtotal = 0;

  // Set up table header.
  $header = array(
  	array('data' => t('Item:'), 'class' => array('products')),
    array('data' => t('Quantity:'), 'class' => array('qty')),
    array('data' => t('Price:'), 'class' => array('price')),
  );

  // Set up table rows.
  $display_items = uc_order_product_view_multiple($items);
  if (!empty($display_items['uc_order_product'])) {
    foreach (element_children($display_items['uc_order_product']) as $key) {
      $display_item = $display_items['uc_order_product'][$key];

      $subtotal += $display_item['total']['#price'];

      $color = '--';
      if(isset($display_item['#entity']->data['attributes']['Color'])){
      	$color = reset($display_item['#entity']->data['attributes']['Color']);
      }

      $size = '--';
      if(isset($display_item['#entity']->data['attributes']['Size'])){
      	$size = reset($display_item['#entity']->data['attributes']['Size']);
      }

      $rows[] = array(
        array('data' => $display_item['product'], 'class' => array('products')),
        array('data' => $display_item['qty'], 'class' => array('qty')),
        array('data' => $display_item['total'], 'class' => array('price')),
      );
    }
  }

  // Add the subtotal as the final row.
  if ($show_subtotal) {
    $rows[] = array(
      'data' => array(
        array(
          'data' => '',
          // Cell attributes
          'colspan' => 2,
        ),
        array(
          'data' => array(
            '#theme' => 'uc_price',
            '#prefix' => '<span id="subtotal-title">' . t('Subtotal:') . '</span> ',
            '#price' => $subtotal,
          ),
          // Cell attributes
          'colspan' => 1,
          'class' => array('subtotal'),
        ),
      ),
      // Row attributes
      'class' => array('subtotal'),
    );
  }

  return theme('table', array('header' => $header, 'rows' => $rows, 'attributes' => array('class' => array('cart-review'))));
}


/**
 * Themes the checkout review order page.
 *
 * @param $variables
 *   An associative array containing:
 *   - form: A render element representing the form, that by default includes
 *     the 'Back' and 'Submit order' buttons at the bottom of the review page.
 *   - panes: An associative array for each checkout pane that has information
 *     to add to the review page, keyed by the pane title:
 *     - <pane title>: The data returned for that pane or an array of returned
 *       data.
 *
 * @return
 *   A string of HTML for the page contents.
 *
 * @ingroup themeable
 */
function sc_bs_uc_cart_checkout_review($variables) {
  $panes = $variables['panes'];
  $form = $variables['form'];

  drupal_add_css(drupal_get_path('module', 'uc_cart') . '/uc_cart.css');

  $output = '<div id="review-instructions">' . filter_xss_admin(variable_get('uc_checkout_review_instructions', uc_get_message('review_instructions'))) . '</div>';

  $output .= '<table class="order-review-table">';

  $counter = 0;

  foreach ($panes as $title => $data) {

    if($counter == 0){
      $output .= '<tr class="pane-title-row visible-xs">';
      $output .= '<td colspan="2">' . $title . '</td>';
      $output .= '</tr>';
    }elseif($counter == 1){
      $output .= '<tr class="pane-title-row hidden-xs">';
      $output .= '<td colspan="2">' . $title . '</td>';
      $output .= '</tr>';
    }else{
      $output .= '<tr class="pane-title-row">';
      $output .= '<td colspan="2">' . $title . '</td>';
      $output .= '</tr>';
    }
    if (is_array($data)) {
      foreach ($data as $row) {
        if (is_array($row)) {
          if (isset($row['border'])) {
            $border = ' class="row-border-' . $row['border'] . '"';
          }
          else {
            $border = '';
          }
          $output .= '<tr' . $border . '>';
          $output .= '<td class="title-col">' . $row['title'] . ':</td>';
          $output .= '<td class="data-col">' . $row['data'] . '</td>';
          $output .= '</tr>';
        }
        else {
          $output .= '<tr><td colspan="2">' . $row . '</td></tr>';
        }
      }
    }
    else {
      $output .= '<tr><td colspan="2">' . $data . '</td></tr>';
    }

    $counter++;
  }

  $output .= '<tr class="review-button-row">';
  $output .= '<td colspan="2">' . drupal_render($form) . '</td>';
  $output .= '</tr>';

  $output .= '</table>';

  return $output;
}

/**
 * Displays an attribute option with an optional total or adjustment price.
 *
 * @param $variables
 *   An associative array containing:
 *   - option: The option name.
 *   - price: The price total or adjustment, if any.
 *
 * @see _uc_attribute_alter_form()
 * @ingroup themeable
 */
function sc_bs_uc_attribute_option($variables) {
  $output = $variables['option'];
  if ($variables['price']) {
    $output .= ', ' . str_replace('+','',$variables['price']);
  }
  return $output;
}