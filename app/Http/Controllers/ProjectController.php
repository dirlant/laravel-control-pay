<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
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
        $query =  Project::where('client_id', $id)
                         ->where('enable', 1)
                         ->get();

  			if(!$query || count($query) <= 0){
  				return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
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
  		public function store(Request $req)
  		{
        if (!$req){
          return response()->json(['data' => false, 'msg' => 'no params =/'], 500);
        }

        $query  = Project::create($req->all());

        return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;
  		}


  		/**
  		 * Display the specified resource.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
  		public function show($id_customer, $id_project )
  		{
        $query =  Project::where('id', $id_project)
                         ->where('client_id', $id_customer)
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
  		public function update(Request $req, $id_customer, $id_project)
  		{
        // obtiene el metodo de envio
        $method = $req->method();

        $query = Project::where('id',$id_project)
                        ->where('client_id', $id_customer);

        if(!$query || count($query) <= 0){
          return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
        }

        $query = Project::where('id',$id_project)
                        ->where('client_id', $id_customer)
                        ->update([
                          'name' => $req->get('name'),
                          'enable' => $req->get('enable')
                        ]);

        $query = Project::where('id',$id_project)
                        ->where('client_id', $id_customer)
                        ->get();

        return response()->json(['data' => $query, 'msg' => 'ok =)'], 200) ;

  		}


  		/**
  		 * Remove the specified resource from storage.
  		 *
  		 * @param  int  $id
  		 * @return Response
  		 */
      public function destroy($id_customer, $id_project)
   		{
         $query =  Project::where('client_id', $id_customer)
                          ->where('id',$id_project)
                          ->get();

         if(!$query || count($query) <= 0){
           return response()->json(['data' => false, 'msg' => 'no data =/'], 404);
         }

         $query =  Project::where('id',$id_project)
                          ->where('client_id', $id_customer)
                          ->update([
                            'enable' => 0
                          ]);

         return response()->json(['msg' => 'ok =)'], 200);
   		}
}
