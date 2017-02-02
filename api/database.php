<?php

// Información de la base de datos
// Ponemos variables de entorno de OpenShift por si estamos desplegando allí. Basado en https://developers.openshift.com/en/php-framework-symfony.html#_database
// En caso contrario se cargarán los valores por defecto de una instalación local de XAMPP
// (usuario: 'root' ; password: '' )
// con base de datos llamada 'biblioteca'

// Comprobamos si estamos en OpenShift buscando una variable de entorno definida sólo allí
$os = getenv('DB_HOST');
$settings = array(
    'driver' => 'mysql',
    'host' => $os ? getenv('DB_HOST') : 'localhost',
    'port' => $os ? getenv('DB_PORT') : 3306,
    'database' => $os ? getenv('DB_DATABASE') : 'biblioteca',
    'username' => $os ? getenv('DB_USERNAME') : 'root',
    'password' => $os ? getenv('DB_PASSWORD') : '',
    'charset'   => 'utf8',
    'collation' => 'utf8_spanish_ci',
    'prefix' => ''
);

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection($settings);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

?>
