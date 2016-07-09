[![Join the chat at https://gitter.im/flaviocopes/grav-plugin-shoppingcart](https://badges.gitter.im/flaviocopes/grav-plugin-shoppingcart.svg)](https://gitter.im/flaviocopes/grav-plugin-shoppingcart?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

For more info about the Shopping Cart plugin refer to the documentation on the [Shopping Cart Plugin site](https://gravshoppingcart.com/docs)

# Pay What You Want add-on for the Grav Shopping Cart

This plugin adds Pay What You Want functionality to products in your Shopping Cart.

# Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `shoppingcart-pay-what-you-want`.

You should now have all the plugin files under

    /your/site/grav/user/plugins/shoppingcart-pay-what-you-want

# Usage

In the Admin, go to Plugins and configure the plugin with the required information, then enable it.

In each product page you can activate "pay what you want", and add ","-separated pricing suggestions (e.g. 5, 10, 20, 100).

Add this to the product template file

    {% include 'partials/shoppingcart-pay-what-you-want.html.twig' %}

This will display a dropdown with your pricing suggestions.