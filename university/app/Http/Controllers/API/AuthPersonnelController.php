<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Api;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use Validator;

class AuthPersonnelController extends Controller
{
    private $apiToken;
    public function __construct()
    {
      // Unique Token
      $this->apiToken = uniqid(base64_encode(Str::random(101)));
    }
    /**
     * Client Login
     */
    public function postLogin(Request $request)
    {
      // Validations
      $rules = [
        'matricule'=>'required',
        'password'=>'required'
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        // Validation failed
        return response()->json([
          'message' => $validator->messages(),
        ]);
      } else {
        // Fetch personnel
        $personnel = Personnel::where('matricule',$request->matricule)->first();
        if($personnel) {
          // Verify the password
          if( password_verify($request->password, $personnel->password) ) {
            // Update Token
            $expiresInSecond = Api::where('id', '=', 1)->value('expires_second');
            $expiresInHour = $expiresInSecond/3600;
            $dateToken = Carbon::now()->addHours($expiresInHour)->format('Y-m-d H:i:s');
            $postArray = ['api_token' => $this->apiToken, 'date_token' => $dateToken, 'expires_at' => $expiresInSecond];
            $login = Personnel::where('matricule',$request->matricule)->update($postArray);
            
            if($login) {
              return response()->json([
                'id_personnel'  => $personnel->id,
                'full_name'     => $personnel->full_name,
                'matricule'     => $personnel->matricule,
                'active'        => $personnel->active,
                'date_token'    => $dateToken,
                'expires_token' => $expiresInSecond,
                'access_token'  => $this->apiToken,
              ]);
            }
          } else {
            return response()->json([
              'message' => 'Invalid Password',
            ]);
          }
        } else {
          return response()->json([
            'message' => 'Personnel not found',
          ]);
        }
      }
    }
    /**
     * Register
     */
    public function postRegister(Request $request)
    {
      // Validations
      $rules = [
        'full_name' => 'required|min:3',
        'email'     => 'required|unique:users,email',
        'password'  => 'required'
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        // Validation failed
        return response()->json([
          'message' => $validator->messages(),
        ]);
      } else {
        $postArray = [
          'full_name' => $request->full_name,
          'email'     => $request->email,
          'password'  => bcrypt($request->password),
          'api_token' => $this->apiToken
        ];
        // $student = Student::GetInsertId($postArray);
        $student = Personnel::insert($postArray);
    
        if($student) {
          return response()->json([
            'full_name'    => $request->full_name,
            'email'        => $request->email,
            'access_token' => $this->apiToken,
          ]);
        } else {
          return response()->json([
            'message' => 'Registration failed, please try again.',
          ]);
        }
      }
    }
    /**
     * Logout
     */
    public function postLogout(Request $request)
    {
      $token = $request->header('Authorization');
      $personnel = Personnel::where('api_token',$token)->first();
      if($personnel) {
        $postArray = ['api_token' => null, 'date_token' => null, 'expires_at' => null];
        $logout = Personnel::where('id',$personnel->id)->update($postArray);
        if($logout) {
          return response()->json([
            'message' => 'Personnel Logged Out',
          ]);
        }
      } else {
        return response()->json([
          'message' => 'Token or Personnel not found',
        ]);
      }
    }
  }