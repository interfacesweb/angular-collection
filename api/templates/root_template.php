{ "collection" :
  {
      "title" : "Multimedia Database",
      "type" : "index",
      "version" : "1.0",
      "href" : "{{ url }}",
      
      "links" : [
	  {"rel" : "collection", "href" : "{{ url }}movies","prompt":"Movies"},
	  {"rel" : "collection", "href" : "{{ url }}books","prompt":"Books"},
	  {"rel" : "collection", "href" : "{{ url }}musicalbums","prompt":"Music Albums"},
	  {"rel" : "collection", "href" : "{{ url }}videogames","prompt":"Videogames"}
      ]
  }
}	
