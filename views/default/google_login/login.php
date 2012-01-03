<?php
/**
 * 
 */


$url = 	elgg_get_site_url() . 'google_login?google_login=true';
$img_url = elgg_get_site_url() . 'mod/google_login/graphics/google_login.png';

$login = <<<__HTML
<div id="login_with_google">
	<a href="$url"><img src="$img_url" alt="Google" /></a>
</div>
__HTML;

echo $login;
