<?php


namespace App\Http\Controllers\API;


use App\Models\Banner;
use App\Models\Country;
use App\Models\PaymentOperator;
use App\Services\FlutterwareService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaticController extends BaseController
{

    protected  $flutterWaveService ;

    /**
     * TransactionController constructor.
     * @param $flutterWaveService
     */
    public function __construct(FlutterwareService $flutterWaveService)
    {
        $this->flutterWaveService = $flutterWaveService;
    }
    function countries(Request $request)
    {
        $lists=Country::query()->where(['status'=>1])->get();
        $data=[];
        foreach ($lists as $list){
            $data[]=[
                "id"=>$list->id,
                "name"=>$list->name,
                "iso"=>$list->iso,
                "iso3"=>$list->iso3,
                "numcode"=>$list->numcode,
                "phonecode"=>$list->phonecode,
                "flag"=>$list->flag,
                "currency_name"=>is_null($list->currency)?"":$list->currency->name,
                "currency_symbol"=>is_null($list->currency)?"":$list->currency->symbol,
                "exchange"=>is_null($list->currency)?"":$list->currency->exchange,
            ];
        }
        return $this->sendResponse($data,'Request successfull');
    }
    function banners(Request $request)
    {
        $lists=Banner::query()->where(['active'=>1])->get();
        $data=[];
        foreach ($lists as $list){
            $data[]=[
                "id"=>$list->id,
                "name"=>$list->titre,
                "description"=>$list->description,
                "image"=>$list->image,
            ];
        }
        return $this->sendResponse($data,'Request successfull');
    }
    function getOnecountries(Request $request,$id)
    {
        $list=Country::query()->find($id);

            $data=[
                "id"=>$list->id,
                "name"=>$list->name,
                "iso"=>$list->iso,
                "iso3"=>$list->iso3,
                "numcode"=>$list->numcode,
                "phonecode"=>$list->phonecode,
                "flag"=>$list->flag,
                "currency_name"=>is_null($list->currency)?"":$list->currency->name,
                "currency_symbol"=>is_null($list->currency)?"":$list->currency->symbol,
                "exchange"=>is_null($list->currency)?"":$list->currency->exchange,
            ];
        return $this->sendResponse($data,'Request successfull');
    }
    function countriesby_id(Request $request,$id)
    {
        $lists=PaymentOperator::query()->where(['country_id'=>$id])->orderByDesc('id')->get();
        $data=[
            "operators"=>$lists
        ];
        return $this->sendResponse($data,'Request successfull');
    }
    function getBankCountry(Request $request,$id)
    {
        $lists=$this->flutterWaveService->getBankCountry($id);
       // foreach ($lists['data'] as $item){}
        return $this->sendResponse($lists->data,'Request successfull');
    }
}
