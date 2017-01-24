<?php

// Modelo de objetos que se corresponde con la tabla de MySQL
class Musicalbum extends \Illuminate\Database\Eloquent\Model
{
	public $timestamps = false;
}

// Añadir el resto del código aquí
$app->get('/musicalbums', function () use ($app)  {

  // Creamos un objeto collection + json con la lista de películas

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

  // Obtenemos la lista de películas de la base de datos y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $pelis = json_decode(\MusicAlbum::all());

   $app->view()->setData(array(
	'url' => $absUrl,	
	'items' => $pelis
	));

  // Mostramos la vista
  $app->render('musicalbumlist_template.php'); 
});


/*  Obtención de un album en concreto  */
$app->get('/musicalbums/:name', function ($name) use ($app) {

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

  // Obtenemos la película de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $p = \MusicAlbum::find($name);  
  $peli = json_decode($p);

  $app->view()->setData(array(
	'url' => preg_replace('/'. preg_quote('/' . $name, '/') . '$/', '', $absUrl),
	'item' => $peli
	));

  // Mostramos la vista
  $app->render('musicalbum_template.php'); 


});


/*  Eliminar un album en concreto  */
$app->delete('/musicalbums/:name', function ($name) use ($app) {

  $p = \MusicAlbum::find($name);  
  $p->delete();
});


// Añadir album
$app->post("/musicalbums", function () use ($app) {

    $template = json_decode($app->request->getBody(), true);

    $datos=$template['template']['data'];

    foreach ($datos as $value) {
      
      switch($value['name']){
        case "name":
          $name=$value['value'];
        break;
        case "description":
          $description=$value['value'];
        break;
        case "datePublished":
          $datePublished=$value['value'];
        break;
        case "image":
          $image=$value['value'];
        break;
        case "embedUrl":
          $embedUrl=$value['value'];
        break;
      }
    }
    $album=new Musicalbum;

    $album->name=$name;
    $album->description=$description;
    $album->datePublished=$datePublished;
    $album->image=$image;
    $album->embedUrl=$embedUrl;
    $album->save();
});

//Actualizar
$app->put('/musicalbums/:name', function ($name) use ($app) {

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

  // Obtenemos la película de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $p = \MusicAlbum::find($name);

    $template = json_decode($app->request->getBody(), true);

    $datos=$template['template']['data'];

    foreach ($datos as $value) {
      
      switch($value['name']){
        case "name":
          $name=$value['value'];
        break;
        case "description":
          $description=$value['value'];
        break;
        case "datePublished":
          $datePublished=$value['value'];
        break;
        case "image":
          $image=$value['value'];
        break;
        case "embedUrl":
          $embedUrl=$value['value'];
        break;
      }
    }

    $p->name=$name;
    $p->description=$description;
    $p->datePublished=$datePublished;
    $p->image=$image;
    $p->embedUrl=$embedUrl;
    $p->save();
});
?>
