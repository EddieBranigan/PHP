<?php namespace Listener;

require('PaypalIPN.php');

use PaypalIPN;
$ipn = new PaypalIPN();
$ipn->useSandbox();
$verified = $ipn->verifyIPN();

if ($verified) {

    //take from advanced_example_usage
    $data_text = "";
        foreach ($_POST as $key => $value) {
    $data_text .= $key . " = " . $value . "\r\n";
}

    $to = "ed.mailme@protonmail.com";
    $subject = "Test IPN email";
    $headers = "From: edscode@edscode.xyz" . "\r\n";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $message = "
    <html>
        <head>
            <title>HTML email</title>
            <style>
            table {
                border: 1px solid black;
              }
            </style>
        </head>
        <body>
              
            <h2>Thank you for your purchase! Below is the details of your order</h2>
            <hr>  
            <h3>Your order details:</h3>

            <table>
                <tr>
                    <th>Order Type:</th>
                    <th><b>" . $_POST['txn_type'] . "</b></th>
                </tr>
                <tr>
                    <th>Invoice Number:</th>
                    <th>" . $_POST['txn_id'] . "</th>
                </tr>
                <tr>
                    <th>Item Purchased:</th>
                    <th>" . $_POST['item_name'] . "</th>
                </tr>
                    <tr>
                    <th>Amount:</th>
                    <th>" . $_POST['quantity'] . "</th>
                </tr>
                <tr>
                    <th>Cost:</th>
                    <th>" . $_POST['payment_gross'] . "</th>
                </tr>
                    <tr>
                    <th>Payment Status:</th>
                    <th>" . $_POST['payment_status'] . "</th>
                </tr>
            </table>
        </body>
    </html>";

    mail($to,$subject,$message,$headers);

    $myfile = fopen("ipn-log.txt", "w");
    fwrite($myfile, $data_text);
    fclose($myfile);
    header("HTTP/1.1 200 OK"); //respond with 200 header to paypal to show recieved.

} else { 

    $myfile = fopen("ipn-log.txt", "w");
    fwrite($myfile, "failed to verify IPN");
    fclose($myfile);
}

?> 
