<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
  		public function __construct()
  		{
  		}


  		/**
  		 * Display a listing of the resource.
  		 *
  		 * @return Response
  		 */
  		public function index($id)
  		{
        $query = Payment::where('project_id', $id)
                        ->where('enable', 1)
                        ->get();

  			if(!$query || count($query) <= 0){
  				return response()->json(['data' => false, 'msg' => 'no data =/'],404);
  			}
  			return response()->json(['data' => $query, 'msg' => 'ok =)'], 200);
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
  		public function store(Request $req, $id_project)
  		{
        if (!$req){
          return response()->json(['data' => false, 'msg' => 'no params =/'], 500);
        }

        $query  = Payment::create($req->all());

        return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;
  		}


  		/**
  		 * Display the specified resource.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function show($id_project, $id_payment )
  		{
        $query =  Payment::where('id', $id_payment)
                         ->where('project_id', $id_project)
                         ->get();

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
        return "edit project: $id";
  		}


  		/**
  		 * Update the specified resource in storage.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function update(Request $req, $id_project, $id_payment)
  		{
        // obtiene el metodo de envio
        $method = $req->method();

        $query = Payment::where('id',$id_payment)
                        ->where('project_id', $id_project);

        if(!$query || count($query) <= 0){
          return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
        }

        $query = Payment::where('id',$id_payment)
                        ->where('project_id',$id_project)
                        ->update([
                          'description' => $req->get('description'),
                          'amount' => $req->get('amount'),
                          'enable' => $req->get('enable')
                        ]);

        return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;

  		}


  		/**
  		 * Remove the specified resource from storage.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
      public function destroy($id_project, $id_payment)
   		{
        $query = Payment::where('id',$id_payment)
                        ->where('project_id', $id_project);

        if(!$query || count($query) <= 0){
          return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
        }

        $query = Payment::where('id',$id_payment)
                        ->where('project_id',$id_project)
                        ->update([
                          'enable' => 0
                        ]);

        return response()->json(['msg' => 'ok =)'], 200);
   		}
}
