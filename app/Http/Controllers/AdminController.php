<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(Request $request)
    {
        // dd($request->all());
        return view('admin.account.changePassword');
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

    //direct admin details page
    public function details() {
        return view('admin.account.details');
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
