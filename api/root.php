<?php

// Esta función escuchará en la ruta principal de la API, '/'
$app->get('/', function () use ($app) {

  // Creamos un objeto collection + json con cuatro enlaces a las cuatro categorías

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() ."://" . $req->getHost() .  $req->getRootUri() . $req->getResourceUri();

  // Creamos los datos que vamos a pasar a la vista
  $app->view()->setData(array(
	'url' => $absUrl
	));

  // Mostramos la vista utilizando la plantilla correspondiente de la carpeta templates
  $app->render('root_template.php'); 


});


?>