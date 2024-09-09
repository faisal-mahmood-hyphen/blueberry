<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Companies\AddCompanyRequest;
use App\Http\Resources\ResourceUser;
use App\Mail\OtpEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function Laravel\Prompts\error;

class CompanyController extends Controller
{



    public function store(AddCompanyRequest $request)
    {
        $response['status'] = true;
        $response['message'] = "New Company created successfully!";
        $otp = random_int(1000, 9999);
        $existingUser = User::where('mobile_no', $request->input('country_code') . $request->input('mobile_no'))->first();

        if ($existingUser) {
            $message = "Mobile number is already registered.";
            return response()->json(['status' => false, 'message' => $message]);
        }
        $mobileNoWithCountryCode = $request->input('country_code') . $request->input('mobile_no');

        $request->merge([
            'otp' => $otp,
            'is_company_account' => 1,
            'requested_status' => "Pending",
            'company_role' => "Owner",
            'mobile_no' => $mobileNoWithCountryCode,
            'country_code' => null,
            'role_id' => 6,
        ]);

        $data = $request->all();
        unset($data['logo'], $data['country_code']);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = 'company_logo_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/companies/logos', $imageName);
            $data['logo'] = $imageName;
        }

        $user = User::create($data);
        //Mail::to($user->email)->send(new OtpEmail($user));
         sendSms($mobileNoWithCountryCode,"Your verification code is ".$otp);
        return response($response);
    }



    public function verifyEmail(Request $request)
    {
        if($request->email){
            $user =  User::where('email', $request->email)->first();
            if(!$user){
                $message =  "Your email is not correct! Please enter the correct email";
                return $message;
            }else{
                $otp = intval($request->otp);
                if($request->otp && $user->otp === $otp ){
                    $user->email_verified_at = now();
                    $user->save();
                    $message =  "Your email is verified!";
                    return $message;
                }else{
                    $message =  "Please enter valid otp";
                    return $message;
                }
            }
        }
        $message =  "Please enter email";
        return $message;
    }

    public function verifyPhone(Request $request)
    {
        if($request->phone){
            $user =  User::where('mobile_no', $request->phone)->first();
            if(!$user){
                $message =  "Your Phone Number is not correct! Please enter the correct Phone Number in this format +92030012345678";
                return $message;
            }else{
                $otp = intval($request->otp);
                if($request->otp && $user->otp === $otp ){
                    $user->phone_verified_at = now();
                    $user->save();
                    $message =  "Your Phone Number is verified!";
                    return $message;
                }else{
                    $message =  "Please Enter Valid OTP";
                    return $message;
                }
            }
        }
        $message =  "Please Enter Phone Number";
        return $message;
    }
}
