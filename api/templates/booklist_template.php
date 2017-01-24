{ "collection" :
  {
      "title" : "Book Database",
      "type" : "book",
      "version" : "1.0",
      "href" : "{{ url }}",

      "links" : [
	  {"rel" : "profile" , "href" : "http://schema.org/Book","prompt":"Perfil"},
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
		  {"name" : "name", "value" : "{{ item.name }}", "prompt" : "Nombre del libro"}
              ]
	  } {% if not loop.last %},{% endif %}
	  
	  {% endfor %}
	  
      ],
      
      "template" : {
	  "data" : [
			{"name" : "name", "value" : "", "prompt" : "Nombre del libro"},
			{"name" : "description", "value" : "", "prompt" : "Descripción del libro"},
			{"name" : "isbn", "value" : "", "prompt" : "ISBN del libro"},
			{"name" : "datePublished", "value" : "", "prompt" : "Fecha de publicación"},
			{"name" : "image", "value" : "", "prompt" : "TImagen"}        
	  ]
      }
  } 
}




