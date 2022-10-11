{{-- <div id="btn-paypal-checkout"></div>


<!-- start PayPal scripts -->
<!-- Load the required checkout.js script -->
<script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>

<!-- Load the required Braintree components. -->
<script src="https://js.braintreegateway.com/web/3.39.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.39.0/js/paypal-checkout.min.js"></script>

<script>
    window.addEventListener("load", function() {
        var cartItems = [{
            name: "Product 1",
            description: "Description of product 1",
            quantity: 1,
            price: 50,
            sku: "prod1",
            currency: "ILS"
        }, {
            name: "Product 2",
            description: "Description of product 2",
            quantity: 3,
            price: 20,
            sku: "prod2",
            currency: "ILS"
        }];

        var total = 0;
        for (var a = 0; a < cartItems.length; a++) {
            total += (cartItems[a].price * cartItems[a].quantity);
        }

        // Render the PayPal button
        paypal.Button.render({

            // Set your environment
            env: 'sandbox', // sandbox | production

            // Specify the style of the button
            style: {
                label: 'checkout',
                size: 'small', // small | medium | large | responsive
                shape: 'pill', // pill | rect
                color: 'black', // gold | blue | silver | black,
                layout: 'horizontal' // horizontal | vertical
            },

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create

            client: {
                sandbox: 'AQrUNiqeaUR5hFL1CRzuAwZQCPQ2KD35hVAM0s_jIhw6mgydgbxvPFVfd3GQ7r3Z-wEyX8FPN3bxJyxL',
                production: ''
            },

            funding: {
                allowed: [
                    paypal.FUNDING.CARD,
                    paypal.FUNDING.ELV
                ]
            },

            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [{
                            amount: {
                                total: total,
                                currency: 'ILS'
                            },
                            item_list: {
                                // custom cartItems array created specifically for PayPal
                                items: cartItems
                            }
                        }]
                    }
                });
            },

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    console.log('printSuccess', data)
                    // you can use all the values received from PayPal as you want
                    console.log({
                        "intent": data.intent,
                        "orderID": data.orderID,
                        "payerID": data.payerID,
                        "paymentID": data.paymentID,
                        "paymentToken": data.paymentToken
                    });
                    console.log('data', data);



                    // [call AJAX here]
                });
            },

            onCancel: function(data, actions) {
                console.log(data);
            }

        }, '#btn-paypal-checkout');
    });
</script> --}}
