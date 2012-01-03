<?php
/**
 * An english language definition file
 */

$english = array(
	'google_login' => 'Google Login',



	'google_login:authorize:error' => 'Unable to authorize google.',
	'google_login:authorize:success' => 'Google access has been authorized.',
        'google_login:login:not_logged_in' => 'You have canceled login attemp.',

	'google_login:usersettings:authorized' => "You have authorized %s to access your google account: @%s.",
	'google_login:usersettings:revoke' => 'Click <a href="%s">here</a> to revoke access.',
	'google_login:revoke:success' => 'google access has been revoked.',

	'google_login:login' => 'Allow existing users who have connected their google account to sign in with google?',
	'google_login:new_users' => 'Allow new users to sign up using their google account even if manual registration is disabled?',
	'google_login:login:success' => 'You have been logged in.',
	'google_login:login:error' => 'Unable to login with google.',
	'google_login:login:email' => "You must enter a valid email address for your new %s account.",
	'google_login:email:subject' => '%s registration successful',
	'google_login:email:body' => '
Hi %s,

Congratulations! You have been successfully registered. Please visit our network here on %s %s.

Your login details are-

Username: %s
Email: %s
Password: %s

You can login using either email id or username.

%s
%s'
	
	);

add_translation('en', $english);
