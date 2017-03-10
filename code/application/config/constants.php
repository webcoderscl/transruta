<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code




/*
*
*
Config Aplications Data
*
*
*/

	$_tables = array();
	$_table = array();

	define("SYSTEM_NAME", "TRANSRuta");
	define("EMAIL_SYSTEM", "no-reply@transruta.cl");
	// Tipos de usuario
	define("ADMIN", "Admin");
	define("TRANSPORTISTA", "Transportista");
	define("GENERADORCARGA", "GeneradorCarga");
	define("ADMIN_NAME", "Administrador");
	define("TRANSPORTISTA_NAME", "Transportista");
	define("GENERADORCARGA_NAME", "Generador de Carga");
	// Modalidad de query
	define("RECIBIDAS", "recibidas");
	define("ENVIADAS", "enviadas");
	// Modalidad de ofertas
	define("OFERTA", "oferta");
	define("SOLICITUD", "solicitud");


	//nombres
	$_tables[] = "camion";
	$_tables[] = "chofer";
	$_tables[] = "generadorcarga";
	$_tables[] = "ofertacarga";
	$_tables[] = "carga";
	$_tables[] = "tipocamion";
	$_tables[] = "transportista";
	$_tables[] = "ofertatransportista";
	$_tables[] = "match_ofertas";
	$_tables[] = "estado";

	$_tables[] = "account";
	$_tables[] = "sucursal";
	$_tables[] = "empresa";
	$_tables[] = "ciudad";
	$_tables[] = "calculo_distancia_ciudades";
	$_tables[] = "region";



	//Nombres de Tablas
	$_table["camion"]["name"] = "camion";
	$_table["chofer"]["name"] = "chofer";
	$_table["generadorcarga"]["name"] = "generadorcarga";
	$_table["ofertacarga"]["name"] = "ofertacarga";
	$_table["carga"]["name"] = "carga";
	$_table["tipocamion"]["name"] = "tipocamion";
	$_table["transportista"]["name"] = "transportista";
	$_table["ofertatransportista"]["name"] = "ofertatransportista";
	$_table["match_ofertas"]["name"] = "match_ofertas";
	$_table["estado"]["name"] = "estado";

	$_table["account"]["name"] = "account";
	$_table["sucursal"]["name"] = "sucursal";
	$_table["empresa"]["name"] = "empresa";

	$_table["ciudad"]["name"] = "ciudad";
	$_table["ciudad1"]["name"] = "ciudad";
	$_table["ciudad2"]["name"] = "ciudad";
	$_table["distancia_ciudades"]["name"] = "calculo_distancia_ciudades";
	$_table["region"]["name"] = "region";
	$_table["region1"]["name"] = "region";
	$_table["region2"]["name"] = "region";

	//Alias de tablas para construccion de Query's

	$_table["camion"]["alias"] = "CA";
	$_table["chofer"]["alias"] = "CH";
	$_table["generadorcarga"]["alias"] = "GC";
	$_table["ofertacarga"]["alias"] = "OC";
	$_table["carga"]["alias"] = "CAR";
	$_table["tipocamion"]["alias"] = "TC";
	$_table["transportista"]["alias"] = "T";
	$_table["ofertatransportista"]["alias"] = "OT";
	$_table["match_ofertas"]["alias"] = "MO";
	$_table["estado"]["alias"] = "estado";

	$_table["account"]["alias"] = "ACC";
	$_table["sucursal"]["alias"] = "SU";
	$_table["empresa"]["alias"] = "EM";

	$_table["ciudad"]["alias"] = "CD";
	$_table["ciudad1"]["alias"] = "C1";
	$_table["distancia_ciudades"]["alias"] = "CDC";
	$_table["ciudad2"]["alias"] = "C2";
	$_table["region"]["alias"] = "RG";
	$_table["region1"]["alias"] = "R1";
	$_table["region2"]["alias"] = "R2";


	//status de oferta

	define("FINALIZADO_STAT", -2);
	define("ERROR_STAT", -1);
	define("INIT_STAT" , 0);
	define("REQUEST_STAT",  1);
	define("JOINED_STAT" , 2);

	//status de oferta

	define("ANULADO" , "Anulado, fuera de tiempo.");
	define("INICIADO" , "Iniciado.");
	define("PROCESANDO" , "En proceso.");
	define("FINALIZADO_EXITO" , "finalizado_exito.");
	define("FINALIZADO_RECHAZO" , "finalizado_rechazo.");
	define("HABILITADO" , "habilitado, fuera de tiempo.");
	define("DESHABILITADO" , "deshabilitado, fuera de tiempo.");

	//mensajes
	define("INFO_NO_DATA" , "Por el momento no hay informacion segun los filtros utilizados, Ingrese su camion disponible para que las empresas que buscan CAMIONES se pongan en contacto con usted");
	define("ERROR_VALIDACION","Complete todos los campos solicitados por favor");


	define ("_TABLES", json_encode($_tables));
	define ("_TABLE", json_encode($_table));
