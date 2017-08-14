<?php

/**
 * Implements hook_form_FORM_ID_alter().
 */
function sc_bs_form_uc_cart_checkout_form_alter(&$form, &$form_state){
  $form['actions']['#prefix'] = '<div class="row form-actions"><div class="col-md-6">';
  $form['actions']['#suffix'] = '</div></div>';

  $form['actions']['cancel']['#prefix'] = '<div class="row"><div class="col-sm-6">';
  $form['actions']['cancel']['#suffix'] = '</div>';
  $form['actions']['continue']['#prefix'] = '<div class="col-sm-6">';
  $form['actions']['continue']['#suffix'] = '</div></div>';
}