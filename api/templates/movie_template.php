{ "collection" :
  {
      "title" : "Movie Database",
      "type" : "movie",
      "version" : "1.0",
      "href" : "{{ url }}",
      
      "links" : [
	  {"rel" : "profile" , "href" : "http://schema.org/Movie","prompt":"Perfil"},
	  {"rel" : "collection", "href" : "{{ url }}/../movies","prompt":"Movies"},
	  {"rel" : "collection", "href" : "{{ url }}/../books","prompt":"Books"},
	  {"rel" : "collection", "href" : "{{ url }}/../musicalbums","prompt":"Music Albums"},
	  {"rel" : "collection", "href" : "{{ url }}/../videogames","prompt":"Videogames"}
      ],
      
      "items" : [
	  {
              "href" : "{{ url }}/{{ item.id }}",
              "data" : [
		  {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre de la película"},
		  {"name" : "description", "value" : "{{ item.description }}", "prompt" : "Descripción de la película"},
		  {"name" : "director", "value" : "{{ item.director }}", "prompt" : "Director de la película"},
		  {"name" : "datePublished", "value" : "{{ item.datePublished }}", "prompt" : "Fecha de lanzamiento"},
		  {"name" : "embedUrl", "value" : "{{ item.embedUrl }}", "prompt" : "Trailer en Youtube"}
              ]
	  } 
	  
      ],
      
      "template" : {
	  "data" : [
          {"name" : "name", "value" : "", "prompt" : "Nombre de la película"},
	      {"name" : "description", "value" : "", "prompt" : "Descripción de la película"},
	      {"name" : "director", "value" : "", "prompt" : "Director de la película"},
	      {"name" : "datePublished", "value" : "", "prompt" : "Fecha de lanzamiento"},
	      {"name" : "embedUrl", "value" : "", "prompt" : "Trailer en Youtube"}        
	  ]
      }
  } 
}




