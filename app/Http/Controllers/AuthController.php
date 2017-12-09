<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
  		public function __construct()
  		{
  		}


      /**
  		 * @return Response
  		 */
  		public function signup(Request $req)
  		{

        $query = User::create([
                        'name' => $req->get('name'),
                        'email' => $req->get('email'),
                        'password' => bcrypt($req->get('password')),
                      ]);

  			if(!$query){
  				return response()->json(['data' => $query, 'msg' => 'no data =/'], 404);
  			}
  			return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;
  		}


      /**
  		 * @return Response
  		 */
      public function login(Request $req)
  		{

        $query = User::create([
                        'name' => $req->get('name'),
                        'email' => $req->get('email'),
                        'password' => bcrypt($req->get('password')),
                      ]);
                      
        if(Hash::check('plain-text-password',$cryptedpassword)) {
            // Right password
        } else {
            // Wrong one
        }

  			if(!$query){
  				return response()->json(['data' => $query, 'msg' => 'no data =/'], 404);
  			}
  			return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;
  		}

}
