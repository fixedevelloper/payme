<?php


namespace App\Http\Controllers\Admin;


use App\Helpers\UploadableTrait;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CryptoMonaire;
use App\Models\PaymentOperator;
use App\Models\Trading;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    use UploadableTrait;
    public function dashboard(Request $request){
        return view("back.dashboard");
    }
    public function profil(Request $request){
        return view("admin.profile");
    }
    public function countries(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        $iso = $request->iso;
        if ($request->has('search')) {
            $countries = Country::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $countries = new Country();
        }
        $countries = $countries->orderBy('name')->paginate(20);

        return view('back.countries',[
            'items'=>$countries
        ]);
    }
    public function country_edit(Request $request,$id)
    {
        $country=Country::query()->find($id);
        if ($request->method()=="POST"){
            $country->name=$request->name;
            $country->phonecode=$request->phonecode;
            $country->iso=$request->iso;
            $country->status=$request->status;
            if ($request->hasFile('flag') && $request->file('flag') instanceof UploadedFile) {
                $image_from = $this->storeFile($request->file('flag'), 'flags');
                $country->flag = $image_from;
            }
            $country->save();
        }
        return view('back.country_edit',[
            'country'=>$country
        ]);
    }
    public function country_operator(Request $request,$id)
    {
        $country=Country::query()->find($id);

        if ($request->method()=="POST"){
            $operator=new PaymentOperator();
            $operator->country_id=$id;
            $operator->name=$request->name;
            $operator->code=$request->code;
            $operator->costs=$request->costs;
            $operator->status=$request->status;
            if ($request->hasFile('flag') && $request->file('flag') instanceof UploadedFile) {
                $image_from = $this->storeFile($request->file('flag'), 'flags');
                $operator->logo = $image_from;
            }
            $operator->save();
        }
        $operators=PaymentOperator::query()->where(['country_id'=>$id])->orderByDesc("id")->paginate(20);
        return view('back.country_operator',[
            'country'=>$country,
            'operators'=>$operators
        ]);
    }
    public function cryptos(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        $iso = $request->iso;
        if ($request->has('search')) {
            $cryptos = CryptoMonaire::query()->where('name', 'like', "%$search%")
                ->orWhere('symbol', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $cryptos = new CryptoMonaire();
        }
        $cryptos = $cryptos->orderByDesc('status')->paginate(20)->appends($query_param);

        return view('admin.cryptos',[
            'items'=>$cryptos
        ]);
    }
    public function taux_modal(Request $request)
    {   $crypto=CryptoMonaire::query()->find($request->id);
        if ($request->method() == "POST"){
            if ($crypto->status==false){
                toastr()->success("Crypto not activate", 'Error request', ["Failed loggedIn"]);
                return back();
            }
            $crypto->taux=$request->get('taux_buy');
            $crypto->taux_sell=$request->get('taux_sell');
            $crypto->save();
            toastr()->success("Wallet add successful", 'Successful request', ["Failed loggedIn"]);
            return redirect()->back();
        }

        return view('admin.modals.taux_echange', [
            'crypto'=>$crypto,
            'quantity'=>$request->quantity,
            'currency_sell'=>$request->currency_sell,
        ]);
    }
    public function activeOrDesactive($id,Request $request)
    {
        $crypto=CryptoMonaire::query()->find($id);
        if ($crypto->status){
            $crypto->status=false;
        }else{
            $crypto->status=true;
        }
        $crypto->save();
        return back();
    }
    }
