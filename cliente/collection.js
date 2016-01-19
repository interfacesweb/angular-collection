(function(){
    var app = angular.module('collectionDirectives', []);

    // Module to store the directives to display the different collection objects: links, items, template and editTemplate
    // You should add more directives to display other objects, such as:
    // - book objects
    // - movie objects
    // - music objects
    // - videogame objects
    // - other elements such as modals, tabs,... or any UI component you need

    app.directive("collectionLinks", function() {
	return {
	    restrict: 'E',
	    templateUrl: "collection-links.html"
	}

    });

    app.directive("collectionItems", function() {
	return {
	    restrict: 'E',
	    templateUrl: "collection-items.html"
	}

    });

    app.directive("collectionTemplate", function() {
	return {
	    restrict: 'E',
	    templateUrl: "collection-template.html"
	}

    });

    app.directive("collectionEdit", function() {
	return {
	    restrict: 'E',
	    templateUrl: "collection-edit.html"
	}

    });

    // TODO
    // Other directives
    // e.g. books directive

    app.directive("itemsBooks", function() {
	return {
	    restrict: 'E',
	    templateUrl: "items-books.html"
	}

    });

})();
