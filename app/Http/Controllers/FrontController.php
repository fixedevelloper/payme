<?php


namespace App\Http\Controllers;


use App\Helpers\Helper;
use App\Models\Annonce;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{

    public function home()
    {

        return view('front.home', [


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
