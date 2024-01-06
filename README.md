# WooCommerce-select-options-to-add-to-card
"Add to cart" feature in loop for products with WooCommerce variations products

Usage

Download the add-to-cart.php file and change with wp-content/plugins/woocommerce/templates/loop/add-to-cart.php

    This code takes the default variation of the product with variation and shows this product as a simple product.
    
Note: you have to choose default variation

For change the text

open wp-content/plugins/woocommerce/includes/class-wc-product-variable.php file and find add_to_cart_text() function 

its look like 

	public function add_to_cart_text() {
 
		return apply_filters( 'woocommerce_product_add_to_cart_text', $this->is_purchasable() ? __( 'Select Options', 'woocommerce' ) : __( 'Read more', 'woocommerce' ), $this );
  
	}
 

 Now change 'Select Options' with 'Add to cart'

After the change it should look like this

	public function add_to_cart_text() {
 
		return apply_filters( 'woocommerce_product_add_to_cart_text', $this->is_purchasable() ? __( 'Add to cart', 'woocommerce' ) : __( 'Read more', 'woocommerce' ), $this );
  
	}
 
