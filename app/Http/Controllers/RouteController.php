<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Route master';
        $route_list = Route::all();
        $action1 = 'add';
        $action2 = 'edit';
        return view('admin.routes.index',['title'=>$title,'data'=>$route_list,'action1'=>$action1,'action2'=>$action2]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'source' => 'required',
                'destination' => 'required',
            ]);
            if ($validator->fails()) {
                $error    = $validator->errors()->toArray();
                $firstKey = array_key_first($error);
                $err_data = $error[$firstKey];

                return response()->json([
                    'status' => 'error', 'message' => $err_data[0],
                ]);
            } else {
                if($request->action1 == 'add'){
                
                    $route = new Route;
                    $route->name = $request->name;
                    $route->source = $request->source;
                    $route->destination = $request->destination;
                    $route->created_at = Carbon::now();

                    if ($route->save()) {
                        $notification = array(
                            'message' => 'Route Successfully Added',
                            'alert-type' => 'success'
                        );
                            return redirect()->back()->with($notification);
                    } else {
                        $notification = array(
                            'message' => 'Error',
                            'alert-type' => 'error'
                        );  
                            return redirect()->back()->with($notification);
                    }
                    
                }
                else if ($request->action2 == 'edit'){

                    $route = Route::find($request->route_id);
                    $route->name = $request->name;
                    $route->source = $request->source;
                    $route->destination = $request->destination;
                    $route->updated_at = Carbon::now();

                    if ($route->save()) {
                        $notification = array(
                            'message' => 'Route Successfully Updated',
                            'alert-type' => 'success'
                        );
                            return redirect()->back()->with($notification);
                    } else {
                        return response()->json(array('status'=>'error','msg'=>'Route Not update'));
                    }
                }
                else{
                    return response()->json(array('status'=>'error','msg'=>'Action Not Defined.'));
                }
            }
        }
        catch(\Exception $e){
            return response()->json(array('status'=>'error','msg'=>$e->getMessage()));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route , $id)
    {
        $route = Route::find($id);
        if($route){
        return response()->json([
            'route' => $route,
        ]);
    }
        else{
            return response()->json([
                'error' => 'brandid not found',
            ]); 
        
    }
    }

    public function destroy(Route $route)
    {
        //
        try{
            if(Route::where('id', $route->id)->update('is_active',$route->is_active)){

                return response()->json(array('status'=>'success','msg'=>'Data deleted Successfully.'));
            }
            else{
                return response()->json(array('status'=>'error','msg'=>'Data Not deleted.'));
            }
        }
        catch(\Exception $e){
            return response()->json(array('status'=>'error','msg'=>$e->getMessage()));
        }
    }

    public function route_active($id){

        Route::findOrFail($id)->update(['is_active' => 'In-Active']);
    
        $notification = array(
            'message' => 'Route Successfully Active',
            'alert-type' => 'success'
        );
    
    return redirect()->back()->with($notification);
    
        }

    
    public function route_inactive($id){

        Route::findOrFail($id)->update(['is_active' => 'Active']);

        $notification = array(
            'message' => 'Route Successfully Inactive',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);


        }
}
