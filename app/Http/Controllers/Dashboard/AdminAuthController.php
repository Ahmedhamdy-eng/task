<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Alert;
class AdminAuthController extends Controller
{   

   
   
    public function showLogin()
    {   
       
        return view('dashboard.auth.login');
    
    }//end funcion 

    public function setLoginData(Request $request)
    {

        $request->validate([
            'email' => 'email|required|',
            'password' => 'required|min:8',
        ]);

        $rememberme= $request->Rememberme == 1?true:false;

        if(Auth()->guard('admin')->attempt([
            'email'=>$request->email,
            'password'=>$request->password
          ],$rememberme

        )){
           
            return redirect()->route('dashboard.welcome');

        }else{
          
             Alert::error('Error',  'You Email Or password Not Correct');
            return redirect()->route('dashboard.show.login');
        }//end if

    }//end function

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('dashboard.show.login');

    } //end function 
}//end class
