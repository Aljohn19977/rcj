<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paypalpayment;
use Gloudemans\Shoppingcart\Facades\Cart;
use Redirect;
use App\ShipSocial;

class PaypalPaymentController extends Controller
{
        /*
    * Process payment with express checkout
    */
    public function paywithPaypal()
    {

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $ship_cost = ShipSocial::where('item','=','ship_cost')->value('value');
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");


        $itemArray = array();

        $cartItem = Cart::content();
        foreach($cartItem as $cart){ 
        $q1 = Paypalpayment::item();
        $q1->setName($cart->name)
                ->setCurrency('PHP')
                ->setQuantity($cart->qty)
                ->setPrice($cart->price);

                
            array_push($itemArray,$q1);
        }
            $itemList = Paypalpayment::itemList();
            $itemList->setItems($itemArray);
        $shipping = 150;
        $details = Paypalpayment::details();
        $details->setShipping($ship_cost)
                //total of items prices
                ->setSubtotal(Cart::subtotal());

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("PHP")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal(Cart::subtotal()+$ship_cost)
                ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl(url("/checkout/paypal/done"))
            ->setCancelUrl(url("/checkout/orders/payment"));

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create(Paypalpayment::apiContext());
        } catch (\PPConnectionException $ex) {
            return response()->json(["error" => $ex->getMessage()], 400);
        }

        $q = $payment->getApprovalLink();
        return redirect::to($q);

        return response()->json([$payment->toArray(), 'approval_url' => $payment->getApprovalLink()], 200);
    }
}
