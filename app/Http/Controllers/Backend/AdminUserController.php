<?php

namespace App\Http\Controllers\Backend;

use App\AdminUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminUser;
use App\Http\Requests\UpdateAdminUser;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users=AdminUser::all();
        // return view('backend.admin_user.index',compact('users'));
        return view('backend.admin_user.index');
    }
    public function ssd(){
        // return "Hello";
        $data=AdminUser::query();
        return DataTables::of($data)
        ->addColumn('action',function($each){
            $edit_column = '<a href="'.route('admin.admin-user.edit',$each->id).' " class="text-warning"><i class="fas fa-edit"></i></a>';
            $delete_column = '<a href="#" class="text-danger delete " data-id="'. $each->id .'"><i class="fas fa-trash-alt"></i></a>';
            // return '<div class="action-icon">'. . $delete_column.'</div>';
            return '<div class="action-icon">'.$edit_column .$delete_column .'</div>';
        })
        ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return "Admin user Create";
      return  view('backend.admin_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminUser $request)
    {

        $admin_user=new AdminUser();
        $admin_user->name=$request->name;
        $admin_user->email=$request->email;
        $admin_user->phone=$request->phone;
        $admin_user->password=Hash::make($request->password);
        $admin_user->save();
        return redirect()->route('admin.admin-user.index')->with('create','Successfully Created.');

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
        $admin_user=AdminUser::FindOrFail($id);
        return view('backend.admin_user.edit',compact('admin_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateAdminUser $request,$id)

    {
       $admin_user=AdminUser::FindOrFail($id);
       $admin_user->name=$request->name;
       $admin_user->email=$request->email;
       $admin_user->phone=$request->phone;
       $admin_user->password=$request->password ? Hash::make($request->password) : $admin_user->password;
       $admin_user->update();
       return redirect()->route('admin.admin-user.index')->with('update','Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AdminUser::FindOrFail($id)->delete();
        return "success";
    }
}
