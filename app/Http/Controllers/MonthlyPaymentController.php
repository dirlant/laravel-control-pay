<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MonthlyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonthlyPaymentController extends Controller
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
  		public function index($id)
  		{
        $query = MonthlyPayment::where('project_id', $id)
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

        $query  = MonthlyPayment::create($req->all());

        return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;
  		}


  		/**
  		 * Display the specified resource.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function show($id_project, $id_monthly )
  		{
        $query =  MonthlyPayment::where('id', $id_monthly)
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
  		public function update(Request $req, $id_project, $id_monthly)
  		{
        // obtiene el metodo de envio
        $method = $req->method();

        $query = MonthlyPayment::where('id',$id_monthly)
                               ->where('project_id', $id_project);

        if(!$query || count($query) <= 0){
          return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
        }

        $query = MonthlyPayment::where('id',$id_monthly)
                               ->where('project_id',$id_project)
                               ->update([
                                 'name' => $req->get('name'),
                                 'amount' => $req->get('amount'),
                                 'date' => $req->get('date'),
                                 'status' => $req->get('status'),
                                 'enable' => $req->get('enable')
                               ]);

        $query = MonthlyPayment::where('id',$id_monthly)
                               ->where('project_id', $id_project)
                               ->get();

        return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;

  		}


  		/**
  		 * Remove the specified resource from storage.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
      public function destroy($id_project, $id_monthly)
   		{
         $query =  MonthlyPayment::where('id', $id_monthly)
                                 ->where('project_id', $id_project)
                                 ->get();

         if(!$query || count($query) <= 0){
           return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
         }

         $query =  MonthlyPayment::where('id',$id_monthly)
                                 ->where('project_id', $id_project)
                                 ->update([
                                   'enable' => 0
                                 ]);

         return response()->json(['msg' => 'ok =)'], 200);
   		}
}
