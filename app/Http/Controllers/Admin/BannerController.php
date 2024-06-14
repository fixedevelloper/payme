<?php


namespace App\Http\Controllers\Admin;


use App\Helpers\UploadableTrait;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redirect;

class BannerController extends Controller
{
    use UploadableTrait;
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $countries = Banner::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $countries = new Banner();
        }
        $countries = $countries->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('back.banners.index',[
            'items'=>$countries
        ]);
    }
    public function create(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->method()=="POST") {
           $banner=new Banner();
           $banner->titre=$request->titre;
            $banner->description=$request->description;
            if ($request->hasFile('image') && $request->file('image') instanceof UploadedFile) {
                $image_from = $this->storeFile($request->file('image'), 'banners');
                $banner->image = $image_from;
            }
            $banner->save();
            return Redirect::route("admin.bc_banners");
        }
        return view('back.banners.create',[
        ]);
    }
    public function trade_detail($id,Request $request)
    {
        $trade=Trading::query()->find($id);
        if ($request->has('status')){
            if ($trade->status==Trading::ACCEPTED || $trade->status==Trading::DENIED){
                return back();
            }
            if ($request->status==Trading::ACCEPTED){
                switch ($trade->type_trade){
                    case Trading::TRADE_BUY:
                        $this->processBuy($trade);
                        break;
                    case Trading::TRADE_SELL:
                        $this->processSell($trade);
                        break;
                    case Trading::TRADE_EXCHANGE:
                        $this->processExchange($trade);
                        break;
                }
            }
            $trade->status=$request->status;
            $trade->save();
        }
        return view('admin.trade.trade_detail',[
            'item'=>$trade
        ]);
    }

}
