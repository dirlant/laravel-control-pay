<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller
{
  		public function __construct()
  		{
  		}


      /**
  		 * @return Response
  		 */
  		public function login()
  		{
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
          $user = Auth::user();
          $success['token'] = $user->createToken('MyPayment')->accessToken;
          return response()->json(['data' => $success], 200);
        }else{
          $user = Auth::user();
          return response()->json(['data' => $user], 401);
        }

  		}


      /**
  		 * @return Response
  		 */
      public function register(Request $req)
  		{

        $validator = Validator::make($req->all(), [
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required',
          'repassword' => 'required|same:password',
        ]);

        if($validator->fails()){
          return response()->json(['errors' => $validator->errors()], 401);
        }

        $input = $req->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $query['token'] = $user->createToken('MyApp')->accessToken;
        $query['name'] = $user->name;

        return response()->json(['success' => $query], 200);

  		}

      /**
  		 * @return Response
  		 */
      public function getDetails(Request $req)
  		{
        $query['user'] = Auth::user();
        return response()->json(['data' => $query], 200);
      }

}
