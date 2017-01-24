<?php

// Modelo de objetos que se corresponde con la tabla de MySQL
class Book extends \Illuminate\Database\Eloquent\Model
{
	public $timestamps = false;
}

// Añadir el resto del código aquí
$app->get('/books', function () use ($app)  {

  // Creamos un objeto collection + json con la lista de películas

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

  // Obtenemos la lista de los libros de la base de datos y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $libros = json_decode(\Book::all());

   $app->view()->setData(array(
	'url' => $absUrl,	
	'items' => $libros
	));

  // Mostramos la vista
  $app->render('booklist_template.php'); 
});


/*  Obtención de un libro en concreto  */
$app->get('/books/:name', function ($name) use ($app) {

  // Creamos un objeto collection + json con el libro pasado como parámetro

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

  // Obtenemos el libro de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $p = \book::find($name);  
  $libro = json_decode($p);

  $app->view()->setData(array(
	'url' => preg_replace('/'. preg_quote('/' . $name, '/') . '$/', '', $absUrl),
	'item' => $libro
	));

  // Mostramos la vista
  $app->render('book_template.php'); 


});


/* Borrado de un libro en concreto */
$app->delete('/books/:name', function ($name) use ($app) {

  // Obtenemos el libro de la base de datos a partir de su id y lo borramos
  $p = \Book::find($name);  
  $p->delete();

});

/* Añadido de un libro */

$app->post('/books', function () use ($app) {
  $body = $app->request->getBody();

  $template = json_decode($app->request->getBody(), true);

  $datos = $template['template']['data'];

  foreach ($datos as $item) { 
    switch ($item['name']) {
      case 'name':
        $name = $item['value'];
        break;

        case 'description':
        $description = $item['value'];
        break;

         case 'isbn':
        $isbn = $item['value'];
        break;

         case 'datePublished':
         $datePublished = $item['value'];
        break;

         case 'image':
        $image = $item['value'];
        break;
    }
  }

  $book = new Book;

  $book->name = $name;
  $book->description = $description;
  $book->isbn = $isbn;
  $book->datePublished = $datePublished;
  $book->image = $image;
  $book->save();
});

/* Actualizacion de un libro en concreto */
/*  Obtención de un libro en concreto  */
$app->put('/books/:name', function ($name) use ($app) {

  // Creamos un objeto collection + json con el libro pasado como parámetro

  // Obtenemos el objeto request, que representa la petición HTTP
  $req = $app->request;

  // Obtenemos la ruta absoluta de este recurso
  $absUrl =  $req->getScheme() . "://" . $req->getHost() . $req->getRootUri() . $req->getResourceUri();

  // Obtenemos el libro de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
  $p = \book::find($name);

  $body = $app->request->getBody();

  $template = json_decode($app->request->getBody(), true);

  $datos = $template['template']['data'];

  foreach ($datos as $item) { 
    switch ($item['name']) {
      case 'name':
        $nombre= $item['value'];
        break;

        case 'description':
        $description = $item['value'];
        break;

         case 'isbn':
        $isbn = $item['value'];
        break;

         case 'datePublished':
         $datePublished = $item['value'];
        break;

         case 'image':
        $image = $item['value'];
        break;
    }
  }

  $p->name = $nombre;
  $p->description = $description;
  $p->isbn = $isbn;
  $p->datePublished = $datePublished;
  $p->image = $image;
  $p->save();


});

?>