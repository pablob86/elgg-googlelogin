<?php
/**
 * An english language definition file
 */

$spanish = array(
	'google_login' => 'Google Login',

	'google_login:authorize:error' => 'No se pudo autorizar con Google.',
	'google_login:authorize:success' => 'El acceso a Google ha sido autorizado.',
        'google_login:login:not_logged_in' => 'Has cancelado el intento de inicio de sesión',

	'google_login:usersettings:authorized' => "Has autorizado %s para acceder a tu cuenta de Google: @%s.",
	'google_login:usersettings:revoke' => 'Haz clic <a href="%s">aquí</a> para revocar el acceso.',
	'google_login:revoke:success' => 'el acceso a Google ha sido revocado.',

	'google_login:login' => 'Permitir a los usuarios existentes que tengan cuenta en Google autenticarse en el sitio?',
	'google_login:new_users' => 'Permitir a los usuarios autenticarse con su cuenta de Google aunque la autenticación manual esté deshabilitada?',
	'google_login:login:success' => 'Te has autenticado.',
	'google_login:login:error' => 'Imposible autenticarse con Google.',
	'google_login:login:email' => "Debes introducir una dirección de correo electrónico válida para tu nueva cuenta %s.",
	'google_login:email:subject' => '%s te has registrado con éxito',
	'google_login:email:body' => '
Hola %s,

¡Felicitaciones! Te has registrado exitosamente. Por favor visita nuestra comunidad %s %s.

Tu información de autenticación es-

Nombre de usuario: %s
Correo electrónico: %s
Contraseña: %s

Pueds iniciar sesión utilizando tu nombre de usuario o tu dirección de correo y tu contraseña.

%s
%s'

	);

add_translation('es', $spanish);
