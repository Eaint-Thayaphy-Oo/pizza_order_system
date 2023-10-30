<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home()
    {
        $pizza = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart'));
    }

    //change password page
    public function changePasswordPage()
    {
        return view('user.password.change');
    }

    //change password
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password; //hash value

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);

            // Auth::logout();
            return redirect()->route('user#changePasswordPage')->with(['changeSuccess' => 'Password Change Successfully...']);
        }
        return back()->with(['notMatch' => 'The Old Password not Match.Try Again!']);
    }

    //user account change page
    public function accountChangePage()
    {
        return view('user.profile.account');
    }

    //user account change
    public function accountChange($id, Request $request)
    {
        // dd($id, $request->all());
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            // dd($dbImage);

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return redirect()->route('user#accountChangePage')->with(['updateSuccess' => 'User Account Updated...']);
    }

    //filter pizza
    public function filter($categoryId)
    {
        // dd($categoryId);

        $pizza = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart'));
    }

    //direct pizza details
    public function pizzaDetails($pizzaId)
    {
        // dd($pizzaId);
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('pizza', 'pizzaList'));
    }

    //cart list
    public function cartList()
    {
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as pizza_image')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($cartList->toArray());

        $totalPrice = 0;

        foreach ($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }
        // dd($totalPrice);

        return view('user.main.cart', compact('cartList', 'totalPrice'));
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

    //account validation check
    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required'
        ])->validate();
    }

    //request user data
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'image' => $request->image,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }
}
