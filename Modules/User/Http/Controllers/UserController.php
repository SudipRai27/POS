<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use Modules\User\Entities\User;
use Auth;
use DB;
use File;
use Modules\User\Entities\UserRoles;
use Modules\User\Entities\Roles;
use Excel;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    protected function guard()
    {
        return auth()->guard('user');
    }

    public function getRegister()
    {   
        $roles = Roles::pluck('role_name', 'id');
        return view('user::register')->with('roles', $roles);
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required', 
            'address' => 'required', 
            'contact' => 'required', 
            'photo' => 'mimes:jpg,jpeg,png'
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->contact = $request->contact;
        $user->api_token = str_random(60);


        if($request->hasFile('photo')) 
        {
            $name = uniqid() . $request->photo->getClientOriginalName();
            $ext = $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path().'/images/user_photos',$name,$ext);
            $user->photo = $name;
        }

        $user->save();

        $user_roles = new UserRoles;
        $user_roles->user_id = $user->id;
        $user_roles->role_id = $request->role_id;
        $user_roles->save();

        Session::flash('success-msg', 'Created Successfully');
        return redirect()->back();

    }


    public function getListUser()
    {
        $user = DB::table('user_roles')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->join('users', 'users.id', '=', 'user_roles.user_id')
                    ->select('name', 'email', 'address', 'contact', 'role_name', 'photo', 'users.id')
                    ->paginate(6);
        return view('user::list')->with('user', $user);
    }

    public function getEditUser($id)
    {
        $user = User::findorFail($id);
        $roles = Roles::select('role_name', 'id')->get();
        $current_user_role_id = UserRoles::where('user_id', $user->id)->pluck('role_id')[0];
        return view('user::edit')->with('user', $user)
                                 ->with('roles', $roles)
                                 ->with('current_user_role_id', $current_user_role_id);
    }

    public function postEditUser(Request $request, $id)
    {           
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            
            'address' => 'required', 
            'contact' => 'required', 
            'photo' => 'mimes:jpg,jpeg,png'
        ]);

        $user = User::findorFail($id); 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->contact = $request->contact;

        if($request->hasFile('photo')) 
        {
            $image_path = public_path().'/images/user_photos/'.$user->photo;
            if(File::exists($image_path))
            {
                File::delete($image_path);
            }

            $name = uniqid() . $request->photo->getClientOriginalName();
            $ext = $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path().'/images/user_photos',$name,$ext);
            $user->photo = $name;
        }

        $user->save();

        $user_roles = UserRoles::where('user_id', $id)->first();

        $user_roles->role_id = $request->role_id;
        $user_roles->save();

        Session::flash('success-msg', 'User Updated Successfully'); 
        return redirect()->route('list-user');
    }

    public function getUserDelete($id)
    {
        $user_roles = UserRoles::where('user_id',$id)->delete();

        $user = User::findorFail($id); 
        $image_path = public_path().'/images/user_photos/'.$user->photo;
        if(File::exists($image_path))
        {
            File::delete($image_path);
        }
        $user->delete();

        Session::flash('success-msg', 'User Deleted Successfully'); 
        return redirect()->back();  
    }

    public function getUserLogin()
    {
        return view('user::login');
    }

    public function postUserLogin(Request $request)
    {
        $auth = auth()->guard('user')->attempt(['email' => $request->email, 'password' => $request->password]);

        if($auth) 
        {
            return redirect()->route('user-home')->with('success-msg', 'Successfully Logged in');
        }
        else 
        {
            Session::flash('error-msg','Incorrect Credentials');
            return redirect()->back();
        }

    }

    public function getViewProfile($id)
    {
        $user = DB::table('user_roles')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->join('users', 'users.id', '=', 'user_roles.user_id')
                    ->select('name', 'email', 'address', 'contact', 'role_name', 'photo', 'users.id', 'password', 'users.created_at')
                    ->where('users.id', $id)
                    ->first();

        return view('user::profile')->with('user', $user);
    }

    public function getUserHome()
    {
        return view('user::dashboard');
    }

    public function getLogout()
    {
        auth()->guard('user')->logout();
        return redirect()->route('user-login')->with('success-msg', 'Logged Out Successfully');
    }

    public function getUserExcel()
    {
        $user = DB::table('user_roles')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->join('users', 'users.id', '=', 'user_roles.user_id')
                    ->select('name', 'email', 'address', 'contact', 'role_name')
                    ->get();

        if(!$user)
        {
            Session::flash('error-msg', 'No Users Available');
            return redirect()->back();
        }

        Excel::create('User Details', function($excel) use ($user) {
            $excel->sheet('User sheet', function($sheet) use ($user)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('Name');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Email');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Address');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('contact');   });
                $sheet->cell('E1', function($cell) {$cell->setValue('User Role');   });
                
                if (!empty($user)) {
                    foreach ($user as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value->name); 
                        $sheet->cell('B'.$i, $value->email); 
                        $sheet->cell('C'.$i, $value->address); 
                        $sheet->cell('D'.$i, $value->contact); 
                        $sheet->cell('E'.$i, $value->role_name); 
                        
                    }
                }
            });
        })->download();
    }

    public function postChangePassword(Request $request)
    {   
        $input = request()->all();
        $user_password = User::where('id', $input['current_user_id'])->pluck('password')[0]; 
        if(Hash::check($input['current_password'], $user_password) )
        {
               $user = User::where('id', $input['current_user_id'])->first();
               $user->password = bcrypt($input['new_password']); 
               $user->save();
               Session::flash('success-msg', 'Password Successfully Updated'); 
               return redirect()->back();
        }
        else
        {
            Session::flash('error-msg', 'Your current password do not match');
            return redirect()->back();
        }
        

    }
}
