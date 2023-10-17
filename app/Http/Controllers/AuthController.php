<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //direct login page
    public function loginPage()
    {
        return view('login');
    }

    //direct register function
    public function registerPage()
    {
        return view('register');
    }

    //direct dashboard
    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');
    }

    //change password page
    public function changePasswordPage(Request $request)
    {
        // dd($request->all());
        return view('admin.password.change');
    }

    //change password
    public function changePassword(Request $request)
    {
        // $this->passwordValidationCheck($request);
        // dd("change password");
        // $currentUserId = Auth::user()->id;
        // $user = User::where('id', $currentUserId)->first();
        // $user = User::where('id', Auth::user()->id)->first(); //short pone san yayy lyk dr apaw ka lo ll yayy loh ya dL
        // dd($user->toArray());
        // $dbPassword = $user->password;
        // dd($dbPassword);
        // dd(Hash::make('sithu')); //hash
        // $hashValue = Hash::make('sithu');
        // if(Hash::check('plain_text',$hashValue)){
        //     dd("password same");
        // } else {
        //     dd("incorret");
        // }
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password; //hash value

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);

            // Auth::logout();
            return redirect()->route('admin#changePasswordPage')->with(['changeSuccess' => 'Password Change Successfully...']);
        }
        return back()->with(['notMatch' => 'The Old Password not Match.Try Again!']);
    }

    //password validation check
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }
}
