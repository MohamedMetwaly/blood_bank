<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Client::paginate(20);
        return view('clients.index',compact('records'));
    }

    

    public function active($id) 
    {
        $record = Client::findOrFail($id);
        if($record->active == 1){
            $record->active = 0;
            $record->update(['active' => $record->active]);
        }
        else{
            $record->active = 1;
            $record->update(['active' => $record->active]);
        }
        return back();
    }

    public function search()
    {
        $records = Client::where(function($query){
            if(request()->has('search')){
                $query->where(function($q){
                    $q->where('name', 'like', '%' . request()->search . '%');
                    $q->orWhere('email', 'like', '%' . request()->search . '%');
                    $q->orWhere('phone', 'like', '%' . request()->search . '%');
                });
            }
        })->get();
        return view('clients.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        $record->delete();
        flash('تم الحذف')->success();
        return back();
    }
}
