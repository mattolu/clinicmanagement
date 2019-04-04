<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Response;
use Validator;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Report;
use App\Models\Vitals;

class UserController extends Controller
{
      /**
    * The request instance.
    *
    * @var \Illuminate\Http\Request
    */
    private $request;
    /**
    * Create a new controller instance.
    *
    * @param \Illuminate\Http\Request $request
    * @return void
    */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
    * Create a new token.
    *
    * @param \App\User $user
    * @return string
    */
    //Genetating token for the login and registration if required...
    protected function jwt(Member $member){
        $payload = [
                    'iss' => 'lumen-jwt', // Issuer of the token
                    'sub' => $member->id, // Subject of the token
                    'iat' => time(), // Time when JWT was issued.
                    'exp' => time() + 1 * 24 * 60 * 60 //3600*3600 // Expiration time of 1 day
                ];
        return JWT::encode($payload, env('JWT_SECRET'), 'HS512');
    }
    /**
    * Authenticate a user and return the token if the provided credentials are correct.
    *
    * @param \App\User $user
    * @return mixed
    */

    /**
    * Registration method
    *
    * @param Request $request registration request
    *
    * @return array
    * @throws \Illuminate\Validation\ValidationException
    */


    
    public function authenticate(User $user)
    {
        $validator = Validator::make($this->request->all(), 
        [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'result'=>[
                    'success' => false,
                    'status' =>400,
                    'message' => $validator->errors()->all()
                        ]]);
        }
            $user = Users::where('email', $this->request->input('email'))->first();
            if (!$user) {
                return response()->json([
                    'result' =>[
                        'message' => 'Email does not exist. Kindly see Admin now',
                        'status' => 400
                        ]]);
            }
            if (Hash::check($this->request->input('password'), $user->password)) {
                return response()->json([
                    'result'=> [
                        'success'=> true,
                        'message'=>'Successfully logged in',
                         'token' => $this->jwt($user),
                         'status' => 200
                 ]]);
                }
                return response()->json([
                'result'=>[
                    'message' => 'Oops, you just typed a wrong password',
                    'status' => 400
            ]]);
    }
    
    public function vitalInfomation(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'blood_pressure' => 'required',
        'temperature' => 'required',

        
    ]);
        if ($validator->fails()) {
            return response()->json([
                'result'=>[
                    'success' => false,
                    'status' =>400,
                    'message' => $validator->errors()->all()
                        ]]);
            }
            try{

                $hasher = app()->make('hash');

                $vital = new Vitals();
                $vital->diseases = $request->diseases;
                $vital->symptoms = $request->symptoms;
                $vital->specialization = $request->specialization;
              
            
              
                $report->save();
                return json_encode([
                            'result'=> [
                                    'success'=> true,
                                    'status'=>200,
                                    'message'=> 'Registration successful',
                                    'member_data'=>$report
                                ]]);    
        
                
                }catch(\Illuminate\Database\QueryException $ex){
                return json_encode([
                    'result'=>[
                        'status'=>500,
                        'registered'=>false,
                        'message'=>$ex->getMessage()
                        ]]);  
            }
        }

       
}