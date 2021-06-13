<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://www.paypal.com/sdk/js?client-id=AWuzPiMfxR5g38hH9Q9rlsl187i_TgUQFFRvX6IcgvStirM65J398FdE5PiQorClWEnPVVDy7SEfii3d&currency=EUR" data-sdk-integration-source="button-factory"></script>
        <title>PayPal example</title>
        <style>
            .container {
                text-align: center;
                display: block;
            }
        </style>
    </head>

    <body>
        <main role="main" class="container">
            <div class="container">
                <img src="hellofren.jpg" alt="Hello Fren Dogo picture">
            </div>

            <h1 class="text-center">Buy Dogo meme for €10</h1>
            
            <div id="smart-button-container">
            <div style="text-align: center;">
            <div id="paypal-button-container"></div>
            </div>
            </div>
            
            <div class="container">
                <?php echo "<p>" . "Hello World!" . "</p>";?>
            </div>

            <script>
                function initPayPalButton() {
                    paypal.Buttons({
                    style: {
                    shape: 'rect',
                    color: 'blue',
                    layout: 'vertical',
                    label: 'paypal',

                    },

                    createOrder: function(data, actions) {
                    return actions.order.create({
                    purchase_units: [{"description":"Dogo memes","amount":{"currency_code":"EUR","value":10}}]
                    });
                    },

                    onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                    });
                    },

                    onError: function(err) {
                    console.log(err);
                    }
                    }).render('#paypal-button-container');
                    }
                    initPayPalButton();
            </script>
        </main>
    </body>

</html>