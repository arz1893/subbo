paypal.Button.render({

    // Set your environment

    env: 'sandbox', // sandbox | production

    // Specify the style of the button

    style: {
        label: 'checkout',
        size:  'small',    // small | medium | large | responsive
        shape: 'rect',     // pill | rect
        color: 'blue'      // gold | blue | silver | black
    },

    // PayPal Client IDs - replace with your own
    // Create a PayPal app: https://developer.paypal.com/developer/applications/create

    client: {
        sandbox:    'AdL4stVjRPdbHHBGMDNGV9khGuwN5JJHFBvdDAZ6_I764zBUAXIFJmAvNmQ-Cho4-H1qM4zJi5A2Pn91',
        production: 'AZzQQTfYDC8VrMsCQnOjRL_DOd40rfJG8DeshdoD_dbJScdirlbfk3Ap1gu7VxOvUR1KrKsNift1rw7U'
    },

    payment: function(data, actions) {

        var productTitle = $('#product_title').data('value');
        var price = $('#product_price').data('value');
        var currency = $('#product_price').data('currency');
        var productDetail = $('#product_detail').text();

        return actions.payment.create({
            payment: {
                transactions: [
                    {
                        amount: {
                            total: ''+ price + '',
                            currency: 'USD'
                        },
                        item_list: {
                            items: [
                                {
                                    name: ''+ productTitle +'',
                                    description: productDetail,
                                    quantity: '1',
                                    price: ''+ price +'',
                                    currency: 'USD'
                                }
                            ]
                        }
                        // amount: {
                        //     total: $('#product_price').data('value'),
                        //     currency: $('#product_price').data('currency')
                        // },
                        // item_list: {
                        //     items: [
                        //         {
                        //             name: $('#product_title').data('value'),
                        //             description: $('#product_detail').text(),
                        //             quantity: '1',
                        //             price: $('#product_price').data('value'),
                        //             currency: $('#product_price').data('currency')
                        //         }
                        //     ]
                        // }
                    }
                ],
                note_to_payer: "The album price converted into USD, please contact us for any further information"
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            console.log(data);
            $('<input>').attr({
                type: 'hidden',
                id: 'payer_id',
                name: 'payer_id',
                value: data.payerID
            }).appendTo('#form_paypal_invoice');
            $('<input>').attr({
                type: 'hidden',
                id: 'payment_id',
                name: 'payment_id',
                value: data.paymentID
            }).appendTo('#form_paypal_invoice');
            $('<input>').attr({
                type: 'hidden',
                id: 'payment_token',
                name: 'payment_token',
                value: data.paymentToken
            }).appendTo('#form_paypal_invoice');

            $('#form_paypal_invoice').submit();
        });
    }

}, '#paypal-button-container');
