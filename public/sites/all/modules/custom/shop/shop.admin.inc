<?php

function shop_admin_settings_form($form,&$form_state){
	$form['shop_form_nid'] = array(
		'#type' => 'textfield',
		'#title' => 'Shop Form Webform ID',
		'#default_value' => variable_get('shop_form_nid',''),
	);

	$form['shop_incorrect_code_msg'] = array(
		'#type' => 'textfield',
		'#title' => 'Incorrect Code Message',
		'#default_value' => variable_get('shop_incorrect_code_msg','Please enter a valid code which can be found on your gift certificate'),
	);

	$form['shop_expired_code_msg'] = array(
		'#type' => 'textfield',
		'#title' => 'Expired Code Message',
		'#default_value' => variable_get('shop_expired_code_msg','This promotion has expired'),
	);

	return system_settings_form($form);
}

function shop_admin_code_manager(){
	$header = array(
		'code' => array('data' => t('Code'), 'field' => 'code'),
		'start' => array('data' => t('Start'), 'field' => 'start', 'sort' => 'desc'),
		'end' => array('data' => t('End'), 'field' => 'end'),
		'delete' => array('data' => t('Delete')),
	);
	$rows = array();
	$result = shop_load_codes(TRUE, $header);
	foreach($result as $row){
		$rows[] = array(
			'code' => $row->code,
			'start' => date('m/d/Y',$row->start),
			'end' => date('m/d/Y',$row->end),
			'delete' => l('delete','admin/shop/code-manager/'.$row->code.'/delete'),
		);
	}

	$output = render(drupal_get_form('shop_admin_code_form'));
	$output .= theme('table', array('header' => $header, 'rows' => $rows));
	$output .= theme('pager');

	return $output;
}

function shop_admin_code_form($form,&$form_state){
	$form['new'] = array(
		'#type' => 'fieldset',
		'#title' => 'Create/Edit Code',
		'#collapsible' => TRUE,
		'#collapsed' => TRUE,
	);

	$form['new']['code'] = array(
		'#type' => 'textfield',
		'#title' => 'Code',
		'#required' => TRUE,
	);

	$form['new']['start'] = array(
		'#type' => 'date_popup',
		'#title' => 'Start Date',
		'#required' => TRUE,
		'#date_format' => 'm/d/Y',
		'#date_label_position' => 'within',
	);

	$form['new']['end'] = array(
		'#type' => 'date_popup',
		'#title' => 'End Date',
		'#required' => TRUE,
		'#date_format' => 'm/d/Y',
		'#date_label_position' => 'within',
	);

	$form['new']['submit'] = array(
		'#type' => 'submit',
		'#value' => 'Submit',
	);

	return $form;
}

function shop_admin_code_form_validate($form,&$form_state){
	if(strpos($form_state['values']['code'], ' ') !== FALSE){
		form_set_error('code','Can not have spaces in code');
	}
}

function shop_admin_code_form_submit($form,&$form_state){
	$record = array(
		'code' => $form_state['values']['code'],
		'start' => strtotime($form_state['values']['start']),
		'end' => strtotime($form_state['values']['end']),
	);

	if(shop_code_check($form_state['values']['code'],FALSE)){
		drupal_write_record('shop_codes',$record,'code');
	}
	else{
		drupal_write_record('shop_codes',$record);
	}
}

function shop_admin_code_delete_form($form,&$form_state,$code){
	$form['code'] = array(
		'#type' => 'hidden',
		'#value' => $code,
	);

	$form['submit'] = array(
		'#prefix' => '<p>Click delete to remove the code "'.$code.'"</p>',
		'#type' => 'submit',
		'#value' => 'Delete',
	);

	return $form;
}

function shop_admin_code_delete_form_submit($form,&$form_state){
	db_delete('shop_codes')->condition('code',$form_state['values']['code'])->execute();
	$form_state['redirect'] = 'admin/shop/code-manager';
	drupal_set_message(t('The code "@code" has been deleted.',array('@code' => $form_state['values']['code'])));
}