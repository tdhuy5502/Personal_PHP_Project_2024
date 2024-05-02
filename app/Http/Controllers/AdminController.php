<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //
    public function checkLogin()
    {
        $admin_id = Session::get('idAdmin');
        $admin_mail = Session::get('emailAdmin');
        if($admin_id && $admin_mail)
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->route('admin.login')->send();
        }
    }
    public function index()
    { 
        return view('admin_login');
    }
    public function dashboard()
    {
        $this->checkLogin();
        return view('admin.dashboard');
    }
    public function handleLogin(LoginPostRequest $request)
    {
        $this->checkLogin();
        $admin_email = $request->input('admin_email');
        $admin_password = $request->input('admin_password');
        
        $infoUser = Account::where([
            'admin_email' => $admin_email,
            'admin_password' => $admin_password
        ])->first();
        
        if(!empty($infoUser))
        {
            $request->session()->put('idAdmin',$infoUser->admin_id);
            $request->session()->put('emailAdmin',$infoUser->admin_email);
            $request->session()->put('passwordAdmin',$infoUser->admin_password);
            $request->session()->put('nameAdmin',$infoUser->admin_name);
            $request->session()->put('phoneAdmin',$infoUser->admin_phone);
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->back()->with('error_login','Sai ten dang nhap hoac tai khoan');
        }
    }
    public function logout(Request $request)
    {  
        $request->session()->forget('idAdmin');
        $request->session()->forget('emailAdmin');
        $request->session()->forget('passwordAdmin');
        $request->session()->forget('nameAdmin');
        $request->session()->forget('phoneAdmin');
        return redirect()->route('admin.login');
    }
}
