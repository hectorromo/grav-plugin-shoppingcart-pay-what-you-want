(function(window) {
    
	$(document).on('onBeforeAddProductToCart', function(event) {		

		if (event.result === false) { // if an event handler already returned false, return false
			return false;
		}

		var product = event.product;

		product.pwyw = $('#pricing-suggestions-select option:selected').val();

		if ( parseInt(product.pwyw, 10) >= parseInt(product.price, 10 ) ) {
			product.price = product.pwyw;
		} else {
			console.log('PWYW - false');
			return false;
		}
	
	});

})(window);

