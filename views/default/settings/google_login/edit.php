<?php
/**
 *
 */
$insert_view = elgg_view('googlesettings/extend');





$sign_on_with_google_string = elgg_echo('google_login:login');
$sign_on_with_google_view = elgg_view('input/dropdown', array(
	'name' => 'params[sign_on]',
	'options_values' => array(
		'yes' => elgg_echo('option:yes'),
		'no' => elgg_echo('option:no'),
	),
	'value' => $vars['entity']->sign_on ? $vars['entity']->sign_on : 'yes',
));

$new_users_with_google = elgg_echo('google_login:new_users');
$new_users_with_google_view = elgg_view('input/dropdown', array(
	'name' => 'params[new_users]',
	'options_values' => array(
		'yes' => elgg_echo('option:yes'),
		'no' => elgg_echo('option:no'),
	),
	'value' => $vars['entity']->new_users ? $vars['entity']->new_users : 'no',
));

$settings = <<<__HTML
<div>$insert_view</div>
<div>$sign_on_with_google_string $sign_on_with_google_view</div>
<div>$new_users_with_google $new_users_with_google_view</div>
__HTML;

echo $settings;
