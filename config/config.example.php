<?php
/** Application Name **/
define( 'APPNAME',  'Fixometer'); 
define( 'APPKEY',   'l[56pOkjg_I8874.');  // should be a random string

/** Secret! **/
define( 'SECRET',   strrev(md5(APPKEY)));

/** system status: can be development or production **/
define( 'SYSTEM_STATUS', 'production');

/** system root path and directory separator **/
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] );
/** system directories **/
define('DIR_UPLOADS', ROOT . DS . 'public' . DS . 'uploads');

/** session keys **/
define('SESSIONKEY', md5(APPKEY));
define('SESSIONNAME', md5(APPKEY . SESSIONKEY));
define('SESSIONSALT', strrev(SESSIONKEY));

/** urls **/
define('HTTP_PROTOCOL', 'http');
define('BASE_URL', HTTP_PROTOCOL . '://' . $_SERVER['HTTP_HOST']);
define('UPLOADS_URL', BASE_URL . '/' . 'uploads' . '/' );

/** date/time 
 * w/out this PHP throws warnings all over the place.
 * Should be set to same timezone as MySQL server for consistency.
 * */
date_default_timezone_set('Europe/London');

/** Wordpress Remote Publishing endpoint **/
define('CONNECT_TO_WORDPRESS', true);
define('WP_XMLRPC_ENDPOINT', 'http://wordpress.yavin/xmlrpc.php');
define('WP_XMLRPC_USER', 'xml-bot');
define('WP_XMLRPC_PSWD', 'dna%ba$MXF^x6#UW$fuigUkX');
