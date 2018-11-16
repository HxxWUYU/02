<?php 
require_once __DIR__ .'/../bootstrap/init.php';

$app_name = getenv('APP_NAME');
use Illuminate\Database\Capsule\Manager as Capsule;
//var_dump(in_array('mod_rewrite', apache_get_modules()));
//echo phpinfo();
//$categories = Capsule::table('categories')->where('id',1)->first();

$categories = Capsule::table('categories')->get();

var_dump($categories->toArray());

?>