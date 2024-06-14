<?php


namespace App\Http\Controllers;


use App\Helpers\Helper;
use App\Models\Annonce;

use App\Models\Country;
use App\Models\Currency;
use App\Models\PaymentLink;
use App\Models\PaymentOperator;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{

    public function home()
    {
        $countries=Country::all();
        $currencies=Currency::all();
        $current_country=Country::query()->firstWhere(['iso3'=>"CMR"]);
        return view('front.home', [
            'countries'=>$countries,
            'currencies'=>$currencies,
            'current_country'=>$current_country
        ]);
    }
    public function home_change_ajax(Request $request)
    {
        $country_sender=Country::query()->find($request->sender_id);
        $country_receiver=Country::query()->find($request->receiver_id);
        $data=[
            "currency_sender"=>$country_sender->currency->code,
            "currency_receiver"=>$country_receiver->currency->code,
        ];
        return Response()->json($data);
    }
    public function waiting()
    {

        return view('front.waiting', [

        ]);
    }
    public function success()
    {

        return view('front.success', [

        ]);
    }
    public function echec()
    {

        return view('front.echec', [

        ]);
    }

    public function payment_link(Request $request,$code)
    {
        $payment=PaymentLink::query()->firstWhere(['code'=>$code,]);
        $operators=PaymentOperator::query()->where(['country_id'=>$payment->country_id])->orderByDesc('id')->get();
        if ($request->method()=="POST"){
            $user=User::query()->find($payment->account_id);
            $transaction = new Transaction();
            $transaction->sender_id = $payment->account_id;
            $transaction->country_id = $payment->country_id;
            $transaction->payment_operator_id = $request->operator;
            $transaction->amount = $payment->amount;
            $transaction->total = $payment->amount;
            $transaction->phone_withdraw = $request->phone;
            $transaction->transaction_type = "deposit";
            $transaction->mode = "mobile";
            $transaction->save();
            $user->balance+=$transaction->total;
            $user->save();
        }
        return view('front.payment_link', [
            'payment'=>$payment,
            'operators'=>$operators
        ]);
    }
    public function join_us($id)
    {
        $parent=User::query()->firstWhere(['unique_number'=>$id]);
       return redirect()->back();
    }
    public function dashboard(Request $request)
    {

        return view('back.dashboard', [
            //'transactions'=>$transactions,
            //'wallets'=>$all_wallaets
        ]);
    }
}
