<?php


namespace App\Http\Controllers\Admin;


use App\Helpers\UploadableTrait;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    use UploadableTrait;
    public function transactions(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $lists = Transaction::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $lists = new Transaction();
        }
        $lists = $lists->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('back.transactions',[
            'items'=>$lists
        ]);
    }
}
