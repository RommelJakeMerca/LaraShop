<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use DateInterval;
use PayPal\Api\PaymentExecution;
use Illuminate\Http\Request;
use App\Models\CartModel;
use App\Models\ClientOrderModel;
use App\Models\OrderModel;
use App\Models\RewardsModel;


class PayPalController extends Controller
{

    // index function
    public function index(Request $request){

        $request->validate([
            'paypalRadio' => 'required|in:paypal'
        ]);

        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');

        // dd($totalPrice);
     
        // After Step 1
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AUl6ySX1uzI_hrJRriWBtnRNgB0cvy6pf84RX2irm_k9nm7owuIhuuYklljN1M6DzidyVbS7q_gQw-1r',     // ClientID
                'EDoHi5vAn-wc4hcU-X2wUdm8HqMrgyRzv-jpuKYyJeyMUGoV4drAkgcRyQgwTdZflUCo64ggO0U1lTc1'      // ClientSecret
            )
        );
        // After Step 2
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal('2');
        // $amount->setTotal($totalPrice);
        $amount->setCurrency('PHP');

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal_return'))
            ->setCancelUrl(route('paypal_cancel'));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        // After Step 3
        try {
            $payment->create($apiContext);
            echo $payment;
            echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
            return redirect($payment->getApprovalLink());
        }
        catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
    }

    public function paypalReturn(){
        date_default_timezone_set('Asia/Manila');
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $outputRewardPoints = floor($totalPrice / 1000);
        // $updated_at = new Datetime();

       // After Step 1
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AUl6ySX1uzI_hrJRriWBtnRNgB0cvy6pf84RX2irm_k9nm7owuIhuuYklljN1M6DzidyVbS7q_gQw-1r',     // ClientID
                'EDoHi5vAn-wc4hcU-X2wUdm8HqMrgyRzv-jpuKYyJeyMUGoV4drAkgcRyQgwTdZflUCo64ggO0U1lTc1'      // ClientSecret
            )
        );
        //dd(\request()->all());
        // Get payment object by passing paymentId
        $paymentId = $_GET['paymentId'];
        $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];

        // Execute payment with payer ID
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            // Execute payment
            $result = $payment->execute($execution, $apiContext);
            $outputRewardPoints > 0 ? $this->insertRewards() : '';
            CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->update(['cart_status' => 'paid']);
            $this->insertOrders();

            return redirect('products/thankyou')->with('result', $result);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        }
    }

    public function insertRewards() {
        date_default_timezone_set('Asia/Manila');
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $outputRewardPoints = floor($totalPrice / 1000);

        $rewardInfos = new RewardsModel;
        $rewardInfos->user_id = $customerId;
        $rewardInfos->title = 'Products Purchased';
        $rewardInfos->reward_points = $outputRewardPoints. ' POINTS';
        $rewardInfos->expiration_points = $outputRewardPoints . ' POINTS';
        $rewardInfos->update_time = new DateTime();
        $rewardInfos->created_at = new DateTime();
        $rewardInfos->original_date = new DateTime();
        $rewardInfos->created_at = $rewardInfos->created_at->add(new DateInterval('P1D'));
        $rewardInfos->expiration_date = $rewardInfos->original_date->add(new DateInterval('P3M'));
        $rewardInfos->save();

        return $rewardInfos;
    }

    public function insertOrders() {
        date_default_timezone_set('Asia/Manila');
        $customerId = Auth::id();
        $paid = 'paid';
        $paypalPayment = 'Paypal';
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $paid])->sum('product_price');
        $productDates = CartModel::where(['user_id' => $customerId, 'cart_status' => $paid])->get()->last();
        $updated_at = $productDates->updated_at->sub(new DateInterval('PT10S'));
        $paidProductIds = CartModel::where(['user_id' => $customerId, 'cart_status' => $paid])
                                    ->where('updated_at', '>=', $updated_at)->pluck('product_id')->toArray();

        $clientOrders = new ClientOrderModel;
        $clientOrders->client_id = $customerId;
        $clientOrders->mode_of_payment = $paypalPayment;
        $clientOrders->total_payment = $totalPrice;
        $clientOrders->product_ids = $paidProductIds;
        $clientOrders->save();

        return $clientOrders;
    }


    public function paypalCancel(){
        // return "order canceled";
        return redirect('products/store');
    }
}
   