{ "collection" :
  {
      "title" : "Movie Database",
      "type" : "movie",
      "version" : "1.0",
      "href" : "{{ url }}",

      "links" : [
	  {"rel" : "profile" , "href" : "http://schema.org/Movie"},
	  {"rel" : "collection", "href" : "{{ url }}/../movies"},
	  {"rel" : "collection", "href" : "{{ url }}/../books"},
	  {"rel" : "collection", "href" : "{{ url }}/../musicalbums"},
	  {"rel" : "collection", "href" : "{{ url }}/../videogames"}
      ],
      
      "items" : [
	  {% for item in items %}
	  
	  {
              "href" : "{{ url }}/{{ item.id }}",
              "data" : [
		  {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre de la película"}
              ]
	  } {% if not loop.last %},{% endif %}
	  
	  {% endfor %}
	  
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




