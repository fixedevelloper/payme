<?php


namespace App\Http\Controllers\API;


use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SecurityController extends BaseController
{
    function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator, 'User login failed.');
        }
        $user=User::query()->firstWhere(['phone'=>$request->phone]);
        //availability check
        if (!isset($user)) {
            return $this->sendError("Phone not register", 'User login failed.');
        }
        if ($user->user_type != User::CUSTOMER_TYPE && $user->user_type != User::DRIVER_TYPE
        ) {
            return $this->sendError("User have not access on this resource", 'User login failed.');
        }
        //status active check
        if (isset($user->is_active) && !$user->is_active) {
            return $this->sendError("Not activate", 'User login failed.');
        }
        if (!Hash::check($request['password'], $user['password'])) {
            return $this->sendError("Not match password", 'User login failed.');
        }
        $user->update(['last_active_at' => now()]);
        $success['token'] = $user->createToken('ApiToken')->plainTextToken;
        $success['name'] = $user->first_name." ".$user->last_name;
        $success['country_id'] = $user->country_id;
        $success['phone'] = $user->phone;
        $success['photo']=$user->photo;
        $success['id'] = $user->id;
        $success['user_type'] = $user->user_type;
        return $this->sendResponse($success, 'User login successfully.');
    }
    function create(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => '',
            'photo' => '',
            'phone' => 'required|min:5|max:20|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->getMessages(), 403);
        }
        try {
            $driver = new User();
            $driver->first_name = $request->first_name;
            $driver->phone = $request->phone;
            $driver->last_name = $request->last_name;
            $driver->email = $request->email;
            $driver->currency_id = 37;
            if ($request->has('date_born')) {
                $driver->date_born = $request->date_born;
            }
            if ($request->has('password')) {
                $driver->password = bcrypt($request->get('password'));
            }
            $driver->user_type = User::CUSTOMER_TYPE;
            if ($request->has('photo')) {
                $driver->photo = Helper::base64Tofile("photo/", [
                    'image' => $request->photo,
                    'image_type' => $request->photo_type,
                ]);
            }
            if ($request->has('document_recto')) {
                $driver->document_recto = Helper::base64Tofile("docs/", [
                    'image' => $request->document_recto,
                    'image_type' => $request->document_recto_type,
                ]);
            }
            if ($request->has('document_verso')) {
                $driver->document_verso = Helper::base64Tofile("docs/", [
                    'image' => $request->document_verso,
                    'image_type' => $request->document_verso_type,
                ]);
            }
            if ($request->has('document_id')) {
                $driver->document_id = $request->document_id;
            }
            if ($request->has('document_type')) {
                $driver->document_type = $request->document_type;
            }

            $driver->save();
            $driver->update(['last_active_at' => now()]);
            $success['token'] = $driver->createToken('ApiToken')->plainTextToken;
            $success['name'] = $driver->first_name." ".$driver->last_name;
            $success['country_id'] = $driver->country_id;
            $success['phone'] = $driver->phone;
            $success['photo'] = $driver->photo;
            $success['id'] = $driver->id;
            $success['user_type'] = $driver->user_type;
            return $this->sendResponse($success, 'request successfully.');
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            return $this->sendError($exception->getMessage());
        }
    }
    function getAccount(Request $request,$id){
        $customer=User::query()->find($id);
        return $this->sendResponse([
            'first_name'=>$customer->first_name,
            'last_name'=>$customer->last_name,
            'phone'=>$customer->phone,
            'email'=>$customer->email,
            'date_born'=>$customer->date_born,
            'photo'=>$customer->photo,
            'facebook'=>$customer->facebook,
            'youtube'=>$customer->youtube,
            'balance'=>$customer->balance,
            'phone_verified'=>$customer->phone_verified,
            'email_verified'=>$customer->email_verified,
            'country_id'=>$customer->country_id,
            'postal_code'=>$customer->postal_code,
        ], 'request successfully.');
    }
}
