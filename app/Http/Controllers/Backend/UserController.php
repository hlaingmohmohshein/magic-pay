<?php

namespace App\Http\Controllers\Backend;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Wallet;
use Carbon\Carbon;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\UUIDGenerate;
use Jenssegers\Agent\Agent;

$agent = new Agent();
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users=User::all();
        // return view('backend.user.index',compact('users'));
        return view('backend.user.index');
    }
    public function ssd(){
        // return "Hello";
        $data=User::query();
        return DataTables::of($data)
        ->editColumn('created_at',function($each){
            return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
        })
        ->editColumn('login_at',function($each){
            return Carbon::parse($each->login_at)->format('Y-m-d H:i:s');
        })
        ->editColumn('updated_at',function($each){
            return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
        })
        ->editColumn('user_agent', function($each) {
            if($each->user_agent){
                $agent = new Agent();
                $agent -> setUserAgent($each->user_agent);
                $device = $agent->device();
                $platform = $agent->platform();
                $browser = $agent->browser();
                
                return '<table class="table table-bordered">
                <tr><td>Devices</td><td>'.$device.'</td></tr>
                <tr><td>Platform</td><td>'.$platform.'</td></tr>
                <tr><td>Browser</td><td>'.$browser.'</td></tr>
                </table>';
            }
            return '-';
            
        })
        ->addColumn('action',function($each){
            $edit_column = '<a href="'.route('admin.user.edit',$each->id).' " class="text-warning"><i class="fas fa-edit"></i></a>';
            $delete_column = '<a href="#" class="text-danger delete " data-id="'. $each->id .'"><i class="fas fa-trash-alt"></i></a>';
            // return '<div class="action-icon">'. . $delete_column.'</div>';
            return '<div class="action-icon">'.$edit_column .$delete_column .'</div>';
        })
        ->rawColumns(['user_agent','action'])
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
      return  view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        DB::beginTransaction();

        try{
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->password=Hash::make($request->password);
            $user->save();
            Wallet::firstOrCreate(
                [
                    'user_id' =>  $user->id,
                ],
                [
                    'account_number' => UUIDGenerate::accountNumber(),
                    'amount' => 0,
                ]
            );
            DB::commit();
            return redirect()->route('admin.user.index')->with('create','Successfully Created.')->withInput();
            
        }catch(\Exception $e){
            DB::rollBack();

            return back()->withErrors(['Fail'=>'Sonething Wrong'.$e->getMessage()]);
        }

        
        // This is not check when the user is duplicate one or account;
        // $wallet=new Wallet();
        // $wallet->user_id=$user->id;
        // $wallet->account_number='1234123412341234';
        // $wallet->ammount=0;
        // $wallet->save();
        

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
        $user=User::FindOrFail($id);
        return view('backend.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateUser $request,$id)

    {
       $user=User::FindOrFail($id);
       $user->name=$request->name;
       $user->email=$request->email;
       $user->phone=$request->phone;
       $user->password=$request->password ? Hash::make($request->password) : $user->password;
       $user->update();
       return redirect()->route('admin.user.index')->with('update','Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::FindOrFail($id)->delete();
        return "success";
    }
}
