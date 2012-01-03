<?php
/**
 * Common library of functions used by Google Authentication
 *
 * @package google_login
 */

/**
 * Tests if the system admin has enabled Sign-On-With-google
 *
 * @param void
 * @return bool
 */


function google_login_allow_sign_on_with_google()
{

    
	return elgg_get_plugin_setting('sign_on', 'google_login') == 'yes';
}

/**
 * Log in a user with google.
 */
function google_login_login($email, $name, $lastname)
{
	global $CONFIG;
	elgg_load_library('googleopid');
	// sanity check
	if (!google_login_allow_sign_on_with_google())
	{
		forward();
	}
	


	// attempt to find user and log them in.
	// else, create a new user.


	$users = get_user_by_email($email);

	if ($users)
	{
		if (count($users) == 1 && login($users[0]))
		{
			system_message(elgg_echo('google_login:login:success'));
			

		}
		else
		{
			system_message(elgg_echo('google_login:login:error'));
		}
		forward();
	}
	else
	{
		

	

		// create new user
		if (!$user)
		{
			// check new registration allowed
			if (!google_login_allow_new_users_with_google())
			{
				register_error(elgg_echo('registerdisabled'));
				forward();
			}
			$userSave=0;
			
			$users= get_user_by_email($email);
			if(!$users)
			{
				// Elgg-ify google credentials

                $uname = explode("@",$email);
				$username = str_replace(' ', '', strtolower($uname[0]));
				
				//Added a critical validation
				if (empty($username)){

					register_error(elgg_echo('registerbad'));
					forward();

				}
				

				while (get_user_by_username($username))
				{
					$username = str_replace(' ', '', strtolower($uname[0])) . '_' . rand(1000, 9999);
				}
				$password = generate_random_cleartext_password();
				
				$user = new ElggUser();
				$user->username = $username;
				$user->name = $name . " " .  $lastname;
				$user->email = $email;
				$user->access_id = ACCESS_PUBLIC;
				$user->salt = generate_random_cleartext_password();
				$user->password = generate_user_password($user, $password);
				$user->owner_guid = 0;
				$user->container_guid = 0;
				$userSave=1;
			}
			else
			{
				$user= $users[0];
			}

			$site = elgg_get_site_entity();
			
		
			if($userSave)
			{
				if (!$user->save())
				{
					register_error(elgg_echo('registerbad'));
					forward();
				}
				google_send_user_password_mail($email, $name, $username, $password);
				$forward = "profile/{$user->username}";
			}
			else
			{
				$forward='';
			}
		}



		// login new user
		if (login($user))
		{
			system_message(elgg_echo('google_login:login:success'));
		}
		else
		{
			system_message(elgg_echo('google_login:login:error'));
		}
		forward($forward, 'google_login');
	}
	// register login error
	register_error(elgg_echo('google_login:login:error'));
	forward();
}




/**
 * Checks if this site is accepting new users.
 * Admins can disable manual registration, but some might want to allow
 * google-only logins.
 */
function google_login_allow_new_users_with_google()
{
	$site_reg = elgg_get_config('allow_registration');
	$google_reg = elgg_get_plugin_setting('new_users');
	if ($site_reg || (!$site_reg && $google_reg == 'yes'))
	{
		return true;
	}
	return false;
}