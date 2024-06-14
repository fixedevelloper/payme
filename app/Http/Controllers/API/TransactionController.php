<?php


namespace App\Http\Controllers\API;


use App\Helpers\Helper;
use App\Models\Country;
use App\Models\PaymentLink;
use App\Models\Transaction;
use App\Models\User;
use App\Services\FlutterwareService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends BaseController
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


    function cashOut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string',
            'sender_id' => 'required|int',
            'beneficiary_id' => 'required|int',
            'country_id' => 'required|int',
            'payment_operator_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->getMessageBag()->first(), 'Send money error');
        }

        $transaction = new Transaction();
        $transaction->sender_id = $request->sender_id;
        $transaction->country_id = 37;
        $transaction->payment_operator_id = $request->payment_operator_id;
        $transaction->amount = $request->amount;
        $transaction->total = $request->total;
        $transaction->beneficiary_id = $request->beneficiary_id;
        $transaction->transaction_type = "withdraw";
        $transaction->mode = "mobile";
        $transaction->save();
      /*  $this->flutterWaveService->createTransfert([
            "amount"=>$request->total,
            "beneficiary_name"=>$request->name,
            "account_number"=>$request->total,
            "routing_number"=>$request->total,
            "swift_code"=>$request->total,
            "bank_name"=>$request->total,
            "beneficiary_country"=>$transaction->country->iso,
            "postal_code"=>$request->total,
            "street_number"=>$request->total,
            "street_name"=>$request->total,
            "city"=>$request->total,
            "beneficiary_address"=>$request->total,
            "destination_branch_code"=>$request->total,

        ]);*/
        return $this->sendResponse($transaction, 'Request successfull');
    }
    function cashOutBank(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string',
            'sender_id' => 'required|int',
            'beneficiary_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->getMessageBag()->first(), 'Send money error');
        }

        $transaction = new Transaction();
        $transaction->sender_id = $request->sender_id;
        $transaction->country_id = 37;
        $transaction->amount = $request->amount;
        $transaction->total = $request->total;
        $transaction->beneficiary_id = $request->beneficiary_id;
        $transaction->transaction_type = "withdraw";
        $transaction->mode = "bank";
        $transaction->save();
        /*  $this->flutterWaveService->createTransfert([
              "amount"=>$request->total,
              "beneficiary_name"=>$request->name,
              "account_number"=>$request->total,
              "routing_number"=>$request->total,
              "swift_code"=>$request->total,
              "bank_name"=>$request->total,
              "beneficiary_country"=>$transaction->country->iso,
              "postal_code"=>$request->total,
              "street_number"=>$request->total,
              "street_name"=>$request->total,
              "city"=>$request->total,
              "beneficiary_address"=>$request->total,
              "destination_branch_code"=>$request->total,

          ]);*/
        return $this->sendResponse($transaction, 'Request successfull');
    }
    function cashOutWallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'name' => 'required|string',
            'amount' => 'required|string',
            'sender_id' => 'required|int',
            'country_id' => 'required|int',
            'receiver_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->getException(), 'User login failed.');
        }
        $sender=User::query()->find($request->sender_id);
        $receiver=User::query()->find($request->receiver_id);
        $transaction = new Transaction();
        $transaction->sender_id = $request->sender_id;
        $transaction->country_id = $request->country_id;
        $transaction->receiver_id = $request->receiver_id;
        $transaction->amount = $request->amount;
        $transaction->total = $request->total;
        $transaction->name_withdraw = $request->name;
        $transaction->phone_withdraw = $request->phone;
        $transaction->transaction_type = "withdraw";
        $transaction->mode = "wallet";
        $transaction->save();
        $sender->balance-=$request->total;

        $sender->save();
        $transaction2 = new Transaction();
        $transaction2->sender_id = $request->sender_id;
        $transaction2->country_id = $request->country_id;
        $transaction2->receiver_id = $request->receiver_id;
        $transaction2->amount = $request->amount;
        $transaction2->total = $request->total;
        $transaction2->name_withdraw = $request->name;
        $transaction2->phone_withdraw = $request->phone;
        $transaction2->transaction_type = "deposit";
        $transaction2->mode = "wallet";
        $transaction2->save();
        $receiver->save();
        $receiver->balance+=$request->total;
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
        $transaction->ower_phone = $request->phone;
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
                    "phone_withdraw" => is_null($list->beneficiary) ? "" :$list->beneficiary->phone,
                    "name_withdraw" => is_null($list->beneficiary) ? "" :$list->beneficiary->name,
                    "email_withdraw" => is_null($list->beneficiary) ? "" :$list->beneficiary->name,
                    "country_name" => is_null($list->beneficiary) ? "" : $list->beneficiary->country->name,
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
                    "phone_withdraw" => is_null($list->beneficiary) ? "" :$list->beneficiary->phone,
                    "name_withdraw" => is_null($list->beneficiary) ? "" :$list->beneficiary->name,
                    "email_withdraw" => is_null($list->beneficiary) ? "" :$list->beneficiary->name,
                    "country_name" => is_null($list->beneficiary) ? "" : $list->beneficiary->country->name,
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
    function payment_links(Request $request, $id)
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
            $lists = PaymentLink::query()->where(['account_id' => $id])->paginate($limit);
            $data = [];
            foreach ($lists as $list) {
                $data[] = [
                    "id" => $list->id,
                    "amount" => $list->amount,
                    "costs" => $list->costs,
                    "mode" => $list->mode,
                    "phone_sender" => $list->phone_withdraw,
                    "name_sender" => $list->name_withdraw,
                    "email_sender" => $list->email_withdraw,
                    "country_name" => is_null($list->country) ? "" : $list->country->name,
                    "created" => date_format($list->created_at, "Y-m-d"),
                    "link" => route("payment_link",['code'=>$list->code]),

                ];
            }
            return $this->sendResponse($data, 'Request successfull');
        } catch (\Exception $exception) {
            logger($exception);
            return $this->sendError($exception->getMessage());
        }

    }
    function create_paymentlink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string',
            'sender_id' => 'required|int',
            'country_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->getException(), 'User login failed.');
        }
        $user=User::query()->find($request->sender_id);
        $transaction = new PaymentLink();
        $transaction->account_id = $request->sender_id;
        $transaction->country_id = $request->country_id;
        $transaction->amount = $request->amount;
        $transaction->mode = 'mobile';
        $transaction->phone_sender = 'mobile';
        $transaction->name_sender = 'mobile';
        $transaction->email_sender = 'mobile';
        $transaction->code=Helper::generatenumber24();
        $transaction->save();
        return $this->sendResponse($transaction, 'Request successfull');
    }
}
