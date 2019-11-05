<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\UserResetPassword;
use Auth;
use Hash;
use Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::paginate(20);
        return view('users.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'name'     => 'required',
            'email'    => 'required|unique:users|email',
            'password' => 'required|confirmed',
            'roles_list' => 'required'
        ]);
        request()->merge(['password' => bcrypt(request()->password)]);
        $user = User::create(request()->except('roles_list'));
        $user->roles()->attach(request()->input('roles_list'));
        flash('تم الإضافه')->success();
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::findOrFail($id);
        return view('users.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(),[
            'name'       => 'required',
            'email'      => 'required|unique:users,email,'.$id,
            'roles_list' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->roles()->sync(request()->input('roles_list'));        
        $user->update(request()->all());
        flash('تم التعديل')->success();
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::findOrFail($id);
        $record->delete();
        flash('تم الحذف')->success();
        return back();
    }

    public function changePassword()
    {
        return view('users.changePassword');
    }

    public function changePasswordSave()
    {
        $this->validate(request(),[
            'old-password' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = Auth::user();
        if(Hash::check(request()->input('old-password'),$user->password))
        {
            $user->password = bcrypt(request()->input('password'));
            $user->save();
            flash()->success('تم تغيير كلمه المرور');
            return back();
        }else{
            flash()->success('كلمه المرور غير صحيحه');
            return back();
        }

    }

    public function GetEmail()
    {
        return view('users.email');
    }

    public function SendEmail()
    {
        $this->validate(request(),[
            'email' => 'required'
        ]);
        $user = User::where('email',request()->email)->first();
        if($user)
        {
            Mail::to($user->email)
                ->send(new UserResetPassword);
            flash()->success('تم الارسال');
            return redirect(url('login'));
        }

        flash()->success('حدث خطأ حاول مره اخرى');
        return redirect(url('login'));

    }

    public function ResetPassword()
    {
        return view('users.reset');
    }

    public function NewPassword()
    {
        $this->validate(request(),[
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = User::where('email',request()->email)->first();
        if($user)
        {
            $user->password = bcrypt(request()->input('password'));
            $user->save();
            return redirect(url('/'));
        }else{
            flash()->success('حدث خطأ حاول مره اخرى');
            return redirect(url('/'));
        }
    }

}
