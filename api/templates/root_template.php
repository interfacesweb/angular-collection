{ "collection" :
  {
      "title" : "Multimedia Database",
      "type" : "index",
      "version" : "1.0",
      "href" : "{{ url }}",
      
      "links" : [
	  {"rel" : "collection", "href" : "{{ url }}movies"},
	  {"rel" : "collection", "href" : "{{ url }}books"},
	  {"rel" : "collection", "href" : "{{ url }}musicalbums"},
	  {"rel" : "collection", "href" : "{{ url }}videogames"}
      ]
  }
}	
