<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Token;
//use Illuminate\Support\Facades\Mail;
use Validator;
use Hash;
Use Mail;
class AuthController extends Controller
{
    public function register(){
        $validator = Validator::make(request()->all(),[
            'name'               => 'required',
            'email'              => 'required|unique:clients',
            'd_o_b'              => 'required|date',
            'city_id'            => 'required|exists:cities,id',
            'phone'              => 'required|unique:clients|digits:11',
            'password'           => 'required|confirmed',
            'blood_type_id'      => 'required|exists:blood_types,id',
            'donation_last_date' => 'required|date'
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        else{
            request()->merge(['password' => bcrypt(request()->password)]);
            $client = Client::create(request()->all());
            $client->api_token = str_random(60);
            $client->save();
            return responseJson(1,'تم الاضافه بنجاح',['api_token' => $client->api_token, 'client' => $client]);
        }
    }



    public function login(){
        $validator = Validator::make(request()->all(),[
            'phone'              => 'required',
            'password'           => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        else{
            $client = Client::where('phone',request()->phone)->first();
            if ($client) {
                if (Hash::check(request()->password,$client->password)) {
                    return responseJson(1,'تم الدخول بنجاح',['api_token' => $client->api_token, 'client' => $client]);
                }
                else{
                    return responseJson(0,'بيانات التسجيل غير صحيحه');
                }
            }
            else{
                return responseJson(0,'بيانات التسجيل غير صحيحه');
            }
        }
    }



    public function resetPassword(){
        $validator = Validator::make(request()->all(),[
            'phone'              => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $user = Client::where('phone',request()->phone)->first();
        if ($user){
            $code = rand(1111,9999);
            $update = $user->update(['pin_code' => $code]);
            if ($update){
                Mail::to($user->email)
                    // ->bcc('metwallyamohamed@gmail.com')
                    ->send(new ResetPassword($code));
                return responseJson(1,'برجاء فحص هاتفك',['pin_code_for_reset' => $code]);
            }
            else{
                return responseJson(1,'حدث خطأ حاول مره احرى');
            }
        }
        else{
            return responseJson(1,'رقم الهاتف غير صحيح');
        }
    }



    public function newPassword(){
        $validator = Validator::make(request()->all(),[
            'pin_code'              => 'required',
            'password'              => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $user = Client::where('pin_code',request()->pin_code)->where('pin_code','!=',0)->first();
        if ($user){
            $user->password = bcrypt(request()->password);
            $user->pin_code = null;
            if($user->save()){
                return responseJson(1,'تم تغيير كلمه المرور');
            }
            else{
                return responseJson(1,'حدث خطأ حاول مره احرى');
            }
        }
        else{
            return responseJson(1,'هذا الكود غير صالح');
        }
    }



    public function registerToken(){
        $validator = Validator::make(request()->all(),[
            'token'    => 'required',
            'type' => 'required|in:android,ios',
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        Token::where('token',request()->token)->delete();
        request()->user()->tokens()->create(request()->all());
        return responseJson(1,'تم التسجيل بنجاح');
    }



    public function removeToken(){
        $validator = Validator::make(request()->all(),[
            'token'    => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        Token::where('token',request()->token)->delete();
        return responseJson(1,'تم الحذف بنجاح');
    }
}
