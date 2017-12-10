<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  		public function __construct()
  		{
        $auth = Auth::user();
        if(!$auth)
          return response()->json(['data' => $auth], 401);
  		}
  		/**
  		 * Display a listing of the resource.
  		 *
  		 * @return Response
  		 */
  		public function index()
  		{      
        $query = User::all();
        if(!$query)
  				return response()->json(['data' => $query, 'codigo' => 'Error 404'], 404);

  			return response()->json([ 'msg' => 'ok', 'data' => $query], 200) ;
  		}
  		/**
  		 * Show the form for creating a new resource.
  		 *
  		 * @return Response
  		 */
  		public function create()
  		{
  		}
  		/**
  		 * Store a newly created resource in storage.
  		 *
  		 * @return Response
  		 */
  		public function store(Request $req)
  		{

  		}
  		/**
  		 * Display the specified resource.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function show($id)
  		{
        return "show user: $id";
  		}
  		/**
  		 * Show the form for editing the specified resource.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function edit($id)
  		{
        return "edit user: $id";
  		}
  		/**
  		 * Update the specified resource in storage.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function update($id)
  		{
  			return "update user: $id";
  		}
  		/**
  		 * Remove the specified resource from storage.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function destroy($id)
  		{
  			return "destroy user: $id";
  		}
}
