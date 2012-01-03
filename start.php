<?php

elgg_register_event_handler('init', 'system', 'google_login_init');

function google_login_init() {
    global $CONFIG;

    $base = elgg_get_plugins_path() . 'google_login';
    elgg_register_library('googleopid', "$base/vendors/googleopid/openid.php");
    elgg_register_library('google_login', "$base/lib/google_login.php");

    elgg_load_library('google_login');

    elgg_extend_view('css/elgg', 'google_login/css');

    // sign on with google
    if (google_login_allow_sign_on_with_google ()) {
        elgg_extend_view('login/extend', 'google_login/login');
    }

    // register page handler
    elgg_register_page_handler('google_login', 'google_login_pagehandler');

 
}

function google_login_pagehandler($page) {
    global $CONFIG;
    elgg_load_library('googleopid');


    $openid = new LightOpenID;

    if (!$openid->mode) {

        if (get_input('google_login')) {
            $openid->identity = 'https://www.google.com/accounts/o8/id';
            $openid->required = array('namePerson/first', 'namePerson/last', 'contact/email');
            forward($openid->authUrl());


        }
    } else {
        if ($openid->validate()) {
           
            $identity = $openid->identity;
            $attributes = $openid->getAttributes();
            $email = $attributes['contact/email'];
            $first_name = $attributes['namePerson/first'];
            $last_name = $attributes['namePerson/last'];

            google_login_login($email, $first_name, $last_name);

            
        } else {

            system_message(elgg_echo('google_login:login:not_logged_in'));
            forward();

        }
    }

}



/**
 * Send password for new user who is registered using google connect
 *
 * @param $email
 * @param $name
 * @param $username
 * @param $password
 */
function google_send_user_password_mail($email, $name, $username, $password) {
    $site = elgg_get_site_entity();
    $email = trim($email);

    // send out other email addresses
    if (!is_email_address($email)) {
        return false;
    }

    $message = elgg_echo('google_login:email:body', array(
                $name,
                $site->name,
                $site->url,
                $username,
                $email,
                $password,
                $site->name,
                $site->url
                    )
    );

    $subject = elgg_echo('google_login:email:subject', array($name));

    // create the from address
    $site = get_entity($site->guid);
    if (($site) && (isset($site->email))) {
        $from = $site->email;
    } else {
        $from = 'noreply@' . get_site_domain($site->guid);
    }

    elgg_send_email($from, $email, $subject, $message);
}