<?php
/** Application Name **/
define('APPNAME', 'Fixometer');

/** Secret! **/
define('SECRET', strrev(md5(APPNAME)));

/** system status: can be development or production **/
define('SYSTEM_STATUS', 'development');

/** system root path and directory separator **/
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] );

/** session keys **/
define('SESSIONKEY', md5(APPNAME));
define('SESSIONNAME', md5(APPNAME . SESSIONKEY));
define('SESSIONSALT', strrev(SESSIONKEY));