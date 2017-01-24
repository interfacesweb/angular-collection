<?php

// Modelo de objetos que se corresponde con la tabla de MySQL
class Movie extends \Illuminate\Database\Eloquent\Model
{
  public $timestamps = false;
}

/* Obtención de la lista de películas */

$app->get('/movies', function () use ($app)  {

  // Creamos un objeto collection + json con la lista de películas

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

  // Obtenemos la lista de películas de la base de datos y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $pelis = json_decode(\Movie::all());

   $app->view()->setData(array(
	'url' => $absUrl,	
	'items' => $pelis
	));

  // Mostramos la vista
  $app->render('movielist_template.php'); 
});


/*  Obtención de una película en concreto  */
$app->get('/movies/:name', function ($name) use ($app) {

  // Creamos un objeto collection + json con la película pasada como parámetro

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

  // Obtenemos la película de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $p = \Movie::find($name);  
  $peli = json_decode($p);

  $app->view()->setData(array(
	'url' => preg_replace('/'. preg_quote('/' . $name, '/') . '$/', '', $absUrl),
	'item' => $peli
	));

  // Mostramos la vista
  $app->render('movie_template.php'); 


});

//Borrar pelicula
$app->delete('/movies/:name', function ($name) use ($app) {
  //Le pasamos la variable para que la encuentre
  $peli = Movie::find($name);
  //Borramos la pelicula encontrada
  $peli->delete();
});

//Guardar nueva pelicula
$app->post('/movies', function () use ($app)  {
  
  //$body = $app->request->getBody();
  $template = json_decode($app->request->getBody(), true);
  $datos = $template['template']['data'];
  //longitud del vector
  $longitud = count($datos);
  //bucle que recorre vector
  for ($i = 0; $i < $longitud; $i++)
  {
    switch($datos[$i]['name'])
    {
      case "name":
        $name = $datos[$i]['value'];
        break;
      case "description":
        $description = $datos[$i]['value'];
        break;
      case "director":
        $director = $datos[$i]['value'];
        break;
      case "embedUrl":
        $embedUrl = $datos[$i]['value'];
        break;
      case "datePublished":
        $datePublished = $datos[$i]['value'];
        break;
    }
  }
  $nueva_movie = new Movie;
  $nueva_movie['name'] = $name;
  $nueva_movie['description'] = $description;
  $nueva_movie['director'] = $director;
  $nueva_movie['datePublished'] = $datePublished;
  $nueva_movie['embedUrl'] = $embedUrl;

  $nueva_movie->save();
});
//Actualizar pelicula
$app->put('/movies/:id', function ($id) use ($app) {
  //$body = $app->request->getBody();
  $template = json_decode($app->request->getBody(), true);
  $datos = $template['template']['data'];
  //longitud del vector
  $longitud = count($datos);
  //bucle que recorre vector
  for ($i = 0; $i < $longitud; $i++)
  {
    switch($datos[$i]['name'])
    {
      case "name":
        $name = $datos[$i]['value'];
        break;
      case "description":
        $description = $datos[$i]['value'];
        break;
      case "director":
        $director = $datos[$i]['value'];
        break;
      case "embedUrl":
        $embedUrl = $datos[$i]['value'];
        break;
      case "datePublished":
        $datePublished = $datos[$i]['value'];
        break;
    }
  }
  
  $nueva_movie = Movie::find($id);
  $nueva_movie['name'] = $name;
  $nueva_movie['description'] = $description;
  $nueva_movie['director'] = $director;
  $nueva_movie['embedUrl'] = $embedUrl;
  $nueva_movie['datePublished'] = $datePublished;
  
  $nueva_movie->save();

});

?>
