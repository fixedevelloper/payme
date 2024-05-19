<?php


namespace App\Http\Controllers\API;


use App\Models\Country;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends BaseController
{

    function cashOut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'name' => 'required|string',
            'amount' => 'required|string',
            'sender_id' => 'required|int',
            'country_id' => 'required|int',
            'payment_operator_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->getException(), 'User login failed.');
        }
        $transaction = new Transaction();
        $transaction->sender_id = $request->sender_id;
        $transaction->country_id = $request->country_id;
        $transaction->payment_operator_id = $request->payment_operator_id;
        $transaction->amount = $request->amount;
        $transaction->total = $request->total;
        $transaction->name_withdraw = $request->name;
        $transaction->phone_withdraw = $request->phone;
        $transaction->transaction_type = "withdraw";
        $transaction->mode = "mobile";
        $transaction->save();
        return $this->sendResponse($transaction, 'Request successfull');
    }
    function cashIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'amount' => 'required|string',
            'sender_id' => 'required|int',
            'payment_operator_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->getException(), 'User login failed.');
        }
        $user=User::query()->find($request->sender_id);
        $transaction = new Transaction();
        $transaction->sender_id = $request->sender_id;
        $transaction->country_id = $request->country_id;
        $transaction->payment_operator_id = $request->payment_operator_id;
        $transaction->amount = $request->amount;
        $transaction->total = $request->total;
        $transaction->phone_withdraw = $request->phone;
        $transaction->transaction_type = "deposit";
        $transaction->mode = "mobile";
        $transaction->save();
        $user->balance+=$request->total;
        $user->save();
        return $this->sendResponse($transaction, 'Request successfull');
    }
    function transactions(Request $request, $id)
    {

        $offset = $request->get("offset");
        if (!isset($offset)) {
            $offset = 0;
        }
        $limit = $request->get('limit');
        if (!isset($limit)) {
            $limit = 20;
        }

        try {
            $lists = Transaction::query()->where(['sender_id' => $id])->paginate($limit);
            $data = [];
            foreach ($lists as $list) {
                $data[] = [
                    "id" => $list->id,
                    "amount" => $list->amount,
                    "costs" => $list->costs,
                    "total" => $list->total,
                    "mode" => $list->mode,
                    "status" => $list->status,
                    "phone_withdraw" => $list->phone_withdraw,
                    "name_withdraw" => $list->name_withdraw,
                    "email_withdraw" => $list->email_withdraw,
                    "country_name" => is_null($list->country) ? "" : $list->country->name,
                    "operator_name" => is_null($list->operator) ? "" : $list->operator->name,
                    "receiver_name" => is_null($list->receiver) ? "" : $list->receiver->first_name . ' ' . $list->receiver->last_name,
                    "transaction_type" => $list->transaction_type,
                    "transaction_date" => date_format($list->created_at, "Y-m-d"),

                ];
            }
            return $this->sendResponse($data, 'Request successfull');
        } catch (\Exception $exception) {
            logger($exception);
            return $this->sendError($exception->getMessage());
        }

    }

    function last_transactions(Request $request, $id)
    {
        try {
            $lists = Transaction::query()->where(['sender_id' => $id])->paginate(10);
            $data = [];
            foreach ($lists as $list) {
                $data[] = [
                    "id" => $list->id,
                    "amount" => $list->amount,
                    "costs" => $list->costs,
                    "total" => $list->total,
                    "mode" => $list->mode,
                    "status" => $list->status,
                    "phone_withdraw" => $list->phone_withdraw,
                    "name_withdraw" => $list->name_withdraw,
                    "email_withdraw" => $list->email_withdraw,
                    "country_name" => is_null($list->country) ? null : $list->country->name,
                    "operator_name" => is_null($list->operator) ? null : $list->operator->name,
                    "receiver_name" => is_null($list->receiver) ? null : $list->receiver->first_name . ' ' . $list->receiver->last_name,
                    "transaction_type" => $list->transaction_type,
                    "transaction_date" => date_format($list->created_at, "Y-m-d"),

                ];
            }
            return $this->sendResponse($data, 'Request successfull');
        } catch (\Exception $exception) {
            logger($exception);
            return $this->sendError($exception->getMessage());
        }

    }
}
