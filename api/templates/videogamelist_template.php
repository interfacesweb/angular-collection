{ "collection" :
  {
      "title" : "VideoGame Database",
      "type" : "VideoGame",
      "version" : "1.0",
      "href" : "{{ url }}",

      "links" : [
	  {"rel" : "profile" , "href" : "http://schema.org/videogames","prompt":"Perfil"},
	  {"rel" : "collection", "href" : "{{ url }}/../movies","prompt":"Movies"},
	  {"rel" : "collection", "href" : "{{ url }}/../books","prompt":"Books"},
	  {"rel" : "collection", "href" : "{{ url }}/../musicalbums","prompt":"Music Albums"},
	  {"rel" : "collection", "href" : "{{ url }}/../videogames","prompt":"Videogames"}
      ],
      
      "items" : [
	  {% for item in items %}
	  
	  {
              "href" : "{{ url }}/{{ item.id }}",
              "data" : [
		  {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre del Juego"}
              ]
	  } {% if not loop.last %},{% endif %}
	  
	  {% endfor %}
	  
      ],
      
      "template" : {
	  "data" : [
		  {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre del Juego"},
		  {"name" : "description", "value" : "{{ item.description }}", "prompt" : "Descripción del Juego"},
		  {"name" : "gamePlatform", "value" : "{{ item.director }}", "prompt" : "Plataforma del Juego"},
		  {"name" : "applicationSubCategory", "value" : "{{ item.director }}", "prompt" : "Categoria del Juego"},
		  {"name" : "screenshot", "value" : "{{ item.screenshot }}", "prompt" : "URL of a captura del juego"},
		  {"name" : "datePublished", "value" : "{{ item.datePublished }}", "prompt" : "Fecha de lanzamiento"},
		  {"name" : "embedUrl", "value" : "{{ item.embedUrl }}", "prompt" : "Trailer en Youtube"}        
	  ]
      }
  } 
}




