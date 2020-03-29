<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Customer;
use DB;
class CustomerController extends Controller
{
    //
    public function login(Request $request){
        return view('pages.login_customer');
    }
    public function redirectToProvider(){
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request){
        $user = Socialite::driver('google')->user();
        if(count(Customer::where('customer_email','=',$user->email)->get())>0){
            $customer = Customer::where('customer_name','=',$user->name)->select('customer_address','customer_numberphone')->get();
            $request->session()->put('customer_email',$user->email);
            $request->session()->put('customer_name',$user->name);
            return redirect()->route('homepage');
        }else{
            $name = $user->name;
            $email = $user->email;
            return redirect()->route('confirm-profile')->with([
                'name'=>$name,
                'email'=>$email
            ]);
        }
    }
    public function confirmProfile(){
        return view('pages.confirm-profile');
    }
    public function saveProfileCustomer(Request $request){
        $this->validate($request,[
            'customer_password'=>'required',
            're_customer_password'=>'required|same:customer_password',
            'customer_numberphone'=>'required',
            'customer_address'=>'required',
        ]);
        try{
            $user = new Customer([
                'customer_name'=>$request->customer_name,
                'customer_email'=>$request->customer_email,
                'customer_password'=>md5($request->customer_password),
                'customer_numberphone'=>$request->customer_numberphone,
                'customer_address'=>$request->customer_address,
            ]);
            if($user->save()){
                $request->session()->put('customer_email',$request->customer_email);
                $request->session()->put('customer_name',$request->customer_name);
                return redirect()->route('homepage');
            }
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            echo $exception->getMessage();
        }

    }
    public function logoutCustomer(Request $request){
        $request->session()->forget('customer_email');
        $request->session()->forget('customer_name');
        return redirect()->route('homepage');
    }

}
