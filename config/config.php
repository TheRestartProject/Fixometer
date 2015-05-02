<?php
/** Application Name **/
define('APPNAME', 'Fixometer'); 
define('APPKEY', 'l[56pOkjg_I8874.');  // should be a random string

/** Secret! **/
define('SECRET', strrev(md5(APPKEY)));

/** system status: can be development or production **/
define('SYSTEM_STATUS', 'development');

/** system root path and directory separator **/
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] );

/** session keys **/
define('SESSIONKEY', md5(APPKEY));
define('SESSIONNAME', md5(APPKEY . SESSIONKEY));
define('SESSIONSALT', strrev(SESSIONKEY));