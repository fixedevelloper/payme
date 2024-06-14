<?php


namespace App\Http\Controllers\API;


use App\Helpers\Helper;
use App\Models\Beneficiary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeneficiaryController extends BaseController
{
    function createBeneficiary(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'account_number' => 'required',
            'country_id' => 'required',
            'customer_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->getMessages(), 403);
        }
        try {
            $driver = new Beneficiary();
            $driver->name = $request->name;
            $driver->account_number = $request->account_number;
            $driver->phone = $request->phone;
            $driver->city = $request->city;
            $driver->address=$request->address;
            $driver->customer_id = $request->customer_id;
            $driver->country_id = $request->country_id;
            if ($request->has('routing_number')) {
                $driver->routing_number = $request->routing_number;
            }
            if ($request->has('swift_code')) {
                $driver->swift_code = $request->get('swift_code');
            }

            if ($request->has('bank_name')) {
                $driver->bank_name = $request->bank_name;
            }
            if ($request->has('postal_code')) {
                $driver->postal_code = $request->postal_code;
            }
            if ($request->has('street_number')) {
                $driver->street_number = $request->street_number;
            }
            if ($request->has('street_name')) {
                $driver->street_name = $request->street_name;
            }
            if ($request->has('branch_code')) {
                $driver->branch_code = $request->branch_code;
            }

            $driver->save();
            return $this->sendResponse($driver, 'request successfully.');
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            return $this->sendError($exception->getMessage());
        }
    }
    function getAllBeneficiaries(Request $request,$id)
    {
        $lists = Beneficiary::query()->where(['customer_id' => $id])->paginate(10);
        $data = [];
        foreach ($lists as $list) {
            $data[] = [
                "id" => $list->id,
                "name" => $list->name,
                "phone" => $list->phone,
                "account_number" => $list->account_number,
                "routing_number" => $list->routing_number,
                "swift_code" => $list->swift_code,
                "bank_name" => $list->bank_name,
                "postal_code" => $list->postal_code,
                "street_number" => $list->street_number,
                "country_id" => is_null($list->country) ? null : $list->country->id,
                "country_name" => is_null($list->country) ? null : $list->country->name,
                "country_flag" => is_null($list->country) ? null : $list->country->flag,
                "currency_code" => is_null($list->country->currency) ? null : $list->country->currency->code,
                "street_name" =>  $list->street_name,
                "city" => $list->city,
                "address" => $list->address,
                "branch_code" => $list->branch_code,

            ];
        }
        return $this->sendResponse($data, 'Request successfull');
    }

}
