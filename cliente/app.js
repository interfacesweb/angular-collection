(function() {

    var app = angular.module('colApp', ['collectionDirectives']);

    // Controller to work with the Collection object
    app.controller('CollectionController', ['$http','$location', function($http, $location){
	var c = this;
	c.collection = {};

	// Initialization
	// When the app ploads, it connects to the entry point of the API, "/api", to get a collection object
	// The collection object is stored in "c.collection"
	$http.get('/api').success(function(data){
	    // Store the collection data
            c.collection = data.collection;
	    // Create an empty edit template for editing items
	    c.collection.editTemplate = {};
	    // Create a history point for navigation purposes
	    // http://html5demos.com/history
	    $location.path('./collection-example.json');
	    // Replace current location (only on initialization)
	    $location.replace();
	});

	
	// Method to do a GET request to a URL
	// It must be called when the user clicks on a LINK
	// href: URL of the selected link (the "href" property of the link)
	// http://amundsen.com/media-types/collection/format/#general
	this.readCollection = function(href) {
	    $http.get(href).success(function(data){
		// Store the collection 
        	c.collection = data.collection;
		// Create an empty edit template for editing items
		c.collection.editTemplate = {};
		$location.path(href);
    	    });
	};

	
	// Method to do a POST request to create an item in a collection
	// The POST request must be sent to the "href" property of the collection object
	// It must be called when the user clicks on the CREATE ITEM button
	// It must send the TEMPLATE object of the collection with the data filled by the user
	// http://amundsen.com/media-types/collection/examples/#ex-write
	this.createItem = function() {

	    // TODO
	    
	};

	// Method to create a template object to edit the item
	// It must create a new TEMPLATE object (copying the one stored in c.collection.template) and fill in the item data
	// The edit template object must be stored in c.collection.editTemplate
	this.buildEditForm = function() {
	    
	    // TODO
	    
	}

	// Method to do a PUT request to edit an item
	// href: URL of the selected item (the "href" property of the item)
	// It must be called when the user clicks on the EDIT ITEM button for a given item
	// It must send c.collection.editTemplate
	// http://amundsen.com/media-types/collection/format/#general
	// http://amundsen.com/media-types/collection/examples/#ex-write
	this.editItem = function(href) {
	    
	    // TODO
	    
	};


	// Method to do a DELETE request to delete an item
	// href: URL of the selected item (the "href" property of the item)
	// It must be called when the user clicks on the DELETE ITEM button for a given item
	// It must create a new TEMPLATE object (copying the one stored in c.collection.template) and fill in the item data
	// http://amundsen.com/media-types/collection/format/#general
	this.deleteItem = function(href) {

	    // TODO
	    
	};


	

	

    }]);

})();







