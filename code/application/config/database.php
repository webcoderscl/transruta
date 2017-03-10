<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'development'; //default
$active_record = TRUE;

$db['development']['hostname'] = '127.0.0.1'; //o localhost
$db['development']['username'] = 'root';
$db['development']['password'] = 'doceanrootrih';//'zu79pm5GaF';
$db['development']['database'] = 'dev_bolsa_de_carga_transporte';
$db['development']['dbdriver'] = 'mysqli';
$db['development']['dbprefix'] = '';
$db['development']['pconnect'] = FALSE; // antes: TRUE
$db['development']['db_debug'] = FALSE; // antes: TRUE
$db['development']['cache_on'] = FALSE;
$db['development']['cachedir'] = '';
$db['development']['char_set'] = 'utf8';
$db['development']['dbcollat'] = 'utf8_general_ci';
$db['development']['swap_pre'] = '';
$db['development']['autoinit'] = TRUE;
$db['development']['stricton'] = FALSE;

/*
        $mysql_host = "mysql8.000webhost.com";
		$mysql_database = "u987460150_app";
		$mysql_user = "u987460150_root";
		$mysql_password = "5CPHYMY8I";
        */
        /*
        $mysql_host = "mysql.hostinger.com.ar";
		$mysql_database = "a1692813_rihtest";
		$mysql_user = "a1692813_rihroot";
		$mysql_password = "rotingwh1536";
*/

$db['production']['hostname'] = 'localhost';
$db['production']['username'] = 'cherita';
$db['production']['password'] = 'lpndyy';//'zu79pm5GaF';
$db['production']['database'] = 'cherita_bolsa_de_carga_transporte';
$db['production']['dbdriver'] = 'mysqli';
$db['production']['dbprefix'] = '';
$db['production']['pconnect'] = TRUE;
$db['production']['db_debug'] = TRUE;
$db['production']['cache_on'] = FALSE;
$db['production']['cachedir'] = '';
$db['production']['char_set'] = 'utf8';
$db['production']['dbcollat'] = 'utf8_general_ci';
$db['production']['swap_pre'] = '';
$db['production']['autoinit'] = TRUE;
$db['production']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */
