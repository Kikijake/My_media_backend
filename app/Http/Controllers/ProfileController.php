<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // DIRECT ADMIN HOME PAGE
    public function index(){
        $id = Auth::user()->id;
        $userInfo = User::where('id',$id)->first();

        return view('admin.profile.index',compact('userInfo'));
    }

    // UPDATE ADMIN ACCOUNT
    public function updateAdminAccount(Request $request){
        $this->userValidationCheck($request);
        $updateData = $this->getUserInfo($request);
        User::where('id',Auth::user()->id)->update($updateData);
        return back()->with(['updateSuccess'=>'Admin Account Updated!']);
    }

    // GET USER INFO
    private function getUserInfo($request){
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender
        ];
    }

    // ADMIN VALIDATAION CHECK
    Private function userValidationCheck($request){
        Validator::make($request->all(),[
            'adminName' => 'required',
            'adminEmail' => 'required'
        ])->validate();
    }

    // CHANGE PASSWORD PAGE
    public function changePasswordPg(){
        return view('admin.profile.changePassword');
    }

    // CHANGE PASSWORD
    public function changePassword(Request $request){
        if(Hash::check($request->oldPassword, Auth::user()->password)){
            $this->pwValidation($request);
            $updateData = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($updateData);
            return redirect()->route('dashboard');
        }else{
            return back()->with(['fail'=>'Password Does Not Match']);
        }
    }

    // PASSWORD VALIDATION
    public function pwValidation($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword'
        ])->validate();
    }


}
