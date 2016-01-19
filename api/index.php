<?php

// Manejador de errores.
// Para mostrar información en se archivo hay que ejecutar:
// $app->getLog()->info('MENSAJE DE TEXTO');

class GestorErrores {
  public function write($message) {
    // Los errores se muestran en el archivo 'errores.log' dentro de la carpeta 'api'
    file_put_contents('errores.log', $message . PHP_EOL, FILE_APPEND);
  }
}


// Cargar Slim Framework y Eloquent a través de Composer
require '../vendor/autoload.php';

// Conexión con la base de datos
require 'database.php';

// Crear la aplicación Slim que trabaje con el sistema de Views Twig
$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig(),
    'log.enabled' => true, // Habilitar errores
    'log.level' => \Slim\Log::DEBUG,
    'log.writer' => new GestorErrores()
));

// Establecer el tipo de datos devuelto por defecto como JSon
// Ponemos también la codificación de caracteres en utf-8 para los caracteres españoles
$app->response->headers->set('Content-Type', 'application/json;charset=utf-8');

// Script con la ruta de entrada a la API
require 'root.php';

// Script para tareas relacionadas con películas
require 'movies.php';

// Script para tareas relacionadas con libros
require 'books.php';

// Script para tareas relacionadas con discos
require 'musicalbums.php';

// Script para tareas relacionadas con videojuegos
require 'videogames.php';

// Inicio de la aplicación Slim 
$app->run();
?>