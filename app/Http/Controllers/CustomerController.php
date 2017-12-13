<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
  		public function __construct()
  		{
        $this->middleware('auth:api');
  		}


  		/**
  		 * Display a listing of the resource.
  		 *
  		 * @return Response
  		 */
  		public function index()
  		{
        $query =  Customer::where('enable', 1)
                          ->get();

        if(!$query || count($query) <= 0){
          return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
        }

  			return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;
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
        if (!$req){
    			return response()->json(['data' => $req, 'msg' => 'no params =/ '], 500);
    		}

    		$query  = Customer::create($req->all());

    		return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;
  		}


  		/**
  		 * Display the specified resource.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function show($id)
  		{
        $query =  Customer::find($id);

        if(!$query || count($query) <= 0){
          return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
        }

        return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;
  		}


  		/**
  		 * Show the form for editing the specified resource.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function edit($id)
  		{
        return "edit customer: $id";
  		}


  		/**
  		 * Update the specified resource in storage.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function update(Request $req, $id)
  		{
        // obtiene el metodo de envio
        $method = $req->method();

  			$query = Customer::find($id);

        if(!$query || count($query) <= 0){
          return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
        }
        $query = Customer::where('id',$id)
                         ->update([
                           'name' => $req->get('name'),
                           'email' => $req->get('email'),
                           'enable' => $req->get('enable')
                         ]);

        $query = Customer::find($id);

        return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;

  		}


  		/**
  		 * Remove the specified resource from storage.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function destroy($id)
  		{
        $query = Customer::find($id);

        if(!$query || count($query) <= 0){
          return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
        }

        $query = Customer::where('id', $id)
                         ->update([
                           'enable' => 0
                         ]);

        return response()->json(['msg' => 'ok =)'], 200) ;
  		}
}
