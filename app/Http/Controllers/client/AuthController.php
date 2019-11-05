<?php

namespace App\Http\Controllers\client;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\WebUserResetPassword;

class AuthController extends Controller
{
    public function GetRegister()
    {
        return view('front.signup');
    }

    public function PostRegister(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string',
            'email' => 'required|unique:clients',
            'd_o_b' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required|unique:clients|digits:11',
            'password' => 'required|min:8|confirmed',
            'blood_type_id' => 'required|exists:blood_types,id',
            'donation_last_date' => 'required|date'
        ]);
//        request()->merge(['password' => bcrypt(request()->password)]);
        $client = Client::create(request()->all());
        $client->api_token = str_random(60);
        $client->password = bcrypt(request()->password);
        $client->save();
        if (auth('client')->attempt($request->only('phone', 'password'))) {
            return redirect(route('homepage'));
        }else{
            flash()->error('حدث حطأ حاول مره اخرى');
            return redirect(url('user/signin'));
        }
    }

    public function GetLogin()
    {
        return view('front.login');
    }

    public function PostLogin(Request $request)
    {
        $this->validate($request, [
            'phone'    => 'required|numeric|digits:11',
            'password' => 'required',
        ]);

        if (auth('client')->attempt($request->only('phone', 'password'))) {
            return redirect(route('homepage'));
        }else{
            flash()->error('الهاتف او كلمه المرور عير صحيحة');
            return back();
        }
    }

    public function Logout()
    {
        auth('client')->logout();
        return redirect(route('homepage'));
    }

    public function GetEmail()
    {
        return view('front.email');
    }

    public function SendEmail()
    {
        $this->validate(request(),[
            'email' => 'required'
        ]);
        $user = Client::where('email',request()->email)->first();
        if($user)
        {
            Mail::to($user->email)
                ->send(new WebUserResetPassword);
            flash()->success('تم الارسال');
            return redirect(url('user/signin'));
        }

        flash()->success('حدث خطأ حاول مره اخرى');
        return redirect(url('user/signin'));

    }

    public function ResetPassword()
    {
        return view('front.reset');
    }

    public function NewPassword(Request $request)
    {
        $this->validate(request(),[
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
        $user = Client::where('email',request()->email)->first();
        if($user)
        {
            $user->password = bcrypt(request()->input('password'));
            $user->save();
            if (auth('client')->attempt($request->only('email', 'password'))) {
                return redirect(route('homepage'));
            }else{
                flash()->error('حدث حطأ حاول مره اخرى');
                return redirect(url('user/signin'));
            }
        }else{
            flash()->error('حدث خطأ حاول مره اخرى');
            return redirect(url('user/signin'));
        }
    }
}
