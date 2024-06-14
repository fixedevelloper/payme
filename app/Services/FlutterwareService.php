<?php


namespace App\Services;


use App\Helpers\Helper;
use Flutterwave\Controller\PaymentController;
use Flutterwave\Flutterwave;
use Flutterwave\Library\Modal;
use Flutterwave\EventHandlers\MomoEventHandler as PaymentHandler;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class FlutterwareService
{
    public function initialize($user_data)
    {
        Flutterwave::setUp([
            'public_key'=>env('FLUTTER_PUBLIC_KEY'),
            'secret_key'=>env('FLUTTER_SECRET_KEY'),
            'encryption_key'=>env('FLUTTER_ENCRYTION_KEY'),
            'environment'=>'staging'
        ]);
        //This generates a payment reference
        try {
            Flutterwave::bootstrap();
            $customHandler = new PaymentHandler();
            $client = new Flutterwave();
            $modalType = Modal::POPUP; // Modal::POPUP or Modal::STANDARD
            $controller = new PaymentController( $client, $customHandler, $modalType );
        } catch(\Exception $e ) {
            echo $e->getMessage();
        }
        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer,mobilemoneyfranco',
            'amount' => $user_data['amount'], //hard coded
            'email' => Auth::user()->email,
            'tx_ref' => Flutterwave::create(),
            'currency' => "xaf",
            'redirect_url' => $user_data['flutterwave_callback'],
            'customer' => [
                'email' => $user_data['email'],
                "phone_number" => $user_data['phone'],
                "name" => $user_data['name'],
            ],

            "customizations" => [
                "title" => "",
                "description" => null,
            ]
        ];

        return  $controller->process($data);

/*        if ($payment['status'] !== 'success') {
            //return to callback


            //payment-fail if no callback

            return \redirect()->route('payment-fail');
        }
        return redirect($payment['data']['link']);*/

    }
    public function make_payment($user_data)
    {
        logger(env("FLUTTER_SECRET_KEY"));
        $url="https://api.flutterwave.com/v3/payments";
        $txnid = Uuid::uuid4();
        $data = [
            'payment_options' => 'card,banktransfer,mobilemoneyfranco',
            'amount' => strval($user_data['amount']),
            'email' => Auth::user()->email,
            'tx_ref' => $txnid,
            'currency' => "usd",
            'redirect_url' => $user_data['flutterwave_callback'],
            'customer' => [
                'email' => $user_data['email'],
                "phone_number" => $user_data['phone'],
                "name" => $user_data['name'],
            ],

            "customizations" => [
                "title" => "",
                "description" => null,
            ]
        ];
        $response = $this->cURL($url, $data);
        logger(json_encode($response));
        return $response;
    }
    public function getBankCountry($iso){
        $url="https://api.flutterwave.com/v3/banks/".$iso;

        $response = $this->cURLGET($url);
       // logger(json_encode($response));
        return $response;
    }
    public function createTransfert($data){
        $url="https://api.flutterwave.com/v3/transfers";
        if ($data['iso']=="us"){
            $values= $this->initDataUSD($data);
        }elseif (in_array($data['iso'],Helper::country_zone_cfa)){
            $values=$this->initDataXAF($data);
        }elseif (in_array($data['iso'],Helper::country_zone_euro)){
            $values=$this->initDataEURO($data);
        }
        $response = $this->cURL($url, $values);
        //logger(json_encode($response));
    }
    private function initDataXAF($data){
        $values=[
          "amount"=>$data['amount'],
          "narration"=>"Single transfert",
            "account_bank"=>$data['account_bank'],
            "account_number"=>$data['account_number'],
            "beneficiary_name"=>$data['beneficiary_name'],
            "currency"=>"XAF",
            "debit_currency"=>"XAF",
            "destination_branch_code"=>$data['destination_branch_code'],
        ];
        return $values;
    }
    private function initDataEURO($data){
        $values=[
            "amount"=>$data['amount'],
            "narration"=>"Single transfert",
            "beneficiary_name"=>$data['beneficiary_name'],
            "currency"=>"XAF",
            "meta"=>[
                "account_number"=>$data['account_number'],
                "routing_number"=>$data['routing_number'],
                "swift_code"=>$data['swift_code'],
                "bank_name"=>$data['bank_name'],
                "beneficiary_name"=>$data['beneficiary_name'],
                "beneficiary_country"=>$data['beneficiary_country'],
                "postal_code"=>$data['postal_code'],
                "street_number"=>$data['street_number'],
                "street_name"=>$data['street_name'],
                "city"=>$data['city'],
            ]
        ];
        return $values;
    }
    private function initDataUSD($data){
        $values=[
            "amount"=>$data['amount'],
            "narration"=>"Single transfert",
            "beneficiary_name"=>$data['beneficiary_name'],
            "currency"=>"XAF",
            "meta"=>[
                "account_number"=>$data['account_number'],
                "routing_number"=>$data['routing_number'],
                "swift_code"=>$data['swift_code'],
                "bank_name"=>$data['bank_name'],
                "beneficiary_name"=>$data['beneficiary_name'],
                "beneficiary_address"=>$data['beneficiary_address'],
                "beneficiary_country"=>$data['beneficiary_country'],
            ]
        ];
        return $values;
    }
    protected function cURL($url, $json)
    {

        // Create curl resource
        $ch = curl_init($url);

        // Request headers
        $headers = array(
            'Content-Type:application/json',
            'Authorization: Bearer '.env("FLUTTER_SECRET_KEY"),
        );

        // Return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // $output contains the output string
        $output = curl_exec($ch);


        // Close curl resource to free up system resources
        curl_close($ch);
        return json_decode($output);
    }
    protected function cURLGET($url)
    {

        // Create curl resource
        $ch = curl_init($url);

        // Request headers
        $headers = array(
            'Content-Type:application/json',
            'Authorization: Bearer '.env("FLUTTER_SECRET_KEY"),
        );

        // Return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // $output contains the output string
        $output = curl_exec($ch);


        // Close curl resource to free up system resources
        curl_close($ch);
        return json_decode($output);
    }
}
