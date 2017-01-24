<?php

// Modelo de objetos que se corresponde con la tabla de MySQL
class Videogame extends \Illuminate\Database\Eloquent\Model
{
	public $timestamps = false;
}

// Añadir el resto del código aquí
$app->get('/videogames', function () use ($app)  {

  // Creamos un objeto collection + json con la lista de películas

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

  // Obtenemos la lista de películas de la base de datos y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $juegos = json_decode(\VideoGame::all());

   $app->view()->setData(array(
	'url' => $absUrl,	
	'items' => $juegos
	));

  // Mostramos la vista
  $app->render('videogamelist_template.php'); 
});


/*  Obtención de un videojuego en concreto  */
$app->get('/videogames/:name', function ($name) use ($app) {

  // Creamos un objeto collection + json con el videojuego pasada como parámetro

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

  // Obtenemos el videojuego de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $p = \VideoGame::find($name);  
  $juego = json_decode($p);

  $app->view()->setData(array(
	'url' => preg_replace('/'. preg_quote('/' . $name, '/') . '$/', '', $absUrl),
	'item' => $juego
	));

  // Mostramos la vista
  $app->render('videogame_template.php'); 


});

/*  Eliminacion de un videojuego en concreto  */
$app->delete('/videogames/:name', function ($name) use ($app) {
	
  // Obtenemos el videojuego de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $p = \VideoGame::find($name); 
  $p->delete();

});

/*Crea un nuevo videojuego con los datos recibidos*/
$app->post('/videogames', function () use ($app) {
  //Código para peticiones de POST (creación de items)
  $body = $app->request->getBody();
  $template = json_decode($body, true);
  $datos = $template['template']['data'];  

  $longitud = count($datos);
  for($i=0; $i<$longitud; $i++)
  {
    switch ($datos[$i]['name']){
	  case "name":
	    $name = $datos[$i]['value'];
		break;
	  case "description":
	    $desc = $datos[$i]['value'];
		break;
	  case "gamePlatform":
	    $plataf = $datos[$i]['value'];
		break;
	  case "applicationSubCategory":
	    $category = $datos[$i]['value'];
		break;
	  case "screenshot":
	    $screenshot = $datos[$i]['value'];
		break;
	  case "datePublished":
	    $date = $datos[$i]['value'];
		break;
	  case "embedUrl":
	    $embedUrl = $datos[$i]['value'];
		break;		
	}    
  }
  
  $videogame = new Videogame;
  $videogame->name = $name;
  $videogame->description = $desc;
  $videogame->gamePlatform = $plataf;
  $videogame->applicationSubCategory = $category;
  $videogame->screenshot =  $screenshot;
  $videogame->datePublished = $date;
  $videogame->embedUrl = $embedUrl;
  
  $videogame->save();
  // Mostramos la vista
  $app->render('videogame_template.php'); 
});


//Actualizar videojuego

$app->put('/videogames/:id', function ($id) use ($app) {

	// Creamos un objeto collection + json con el libro pasado como parámetro

	// Obtenemos el objeto request, que representa la petición HTTP
	$req = $app->request;

	// Obtenemos la ruta absoluta de este recurso
	$absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

	// Obtenemos el libro de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
	$nuevo_videogame = \VideoGame::find($id);	

	$body = $app->request->getBody();

	$template = json_decode($app->request->getBody(), true);

	$datos = $template['template']['data'];
  	foreach ($datos as $item)
  	{ 
		switch($item['name'])
		{
			case "name":
				$name = $item['value'];
				break;
			case "description":
				$description = $item['value'];
				break;
			case "gamePlatform":
				$gamePlatform = $item['value'];
				break;

			case "applicationSubCategory":
				$applicationSubCategory = $item['value'];
				break;

			case "screenshot":
				$screenshot = $item['value'];
				break;
				
			case "embedUrl":
				$embedUrl = $item['value'];
				break;
			case "datePublished":
				$datePublished = $item['value'];
				break;
		}
	}

	$nuevo_videogame['name'] = $name;
	$nuevo_videogame['description'] = $description;
	$nuevo_videogame['gamePlatform'] = $gamePlatform;
	$nuevo_videogame['applicationSubCategory'] = $applicationSubCategory;
	$nuevo_videogame['screenshot'] = $screenshot;
	$nuevo_videogame['embedUrl'] = $embedUrl;
	$nuevo_videogame['datePublished'] = $datePublished;
	$nuevo_videogame->save();

});


?>
