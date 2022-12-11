<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Station master';
        $route_list = Station::all();
        return view('Station.index',['title'=>$title,'data'=>$route_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add Station';
        $action = 'add';

        return view('station.add',['title'=>$title,'action'=>$action])->render();
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
                ]);
                if ($request->fails()) {
                    $error    = $validator->errors()->toArray();
                    $firstKey = array_key_first($error);
                    $err_data = $error[$firstKey];
    
                    return response()->json([
                        'status' => 'error', 'message' => $err_data[0],
                    ]);
                } else {
                    if($request->action == 'add'){
                    
                        $station = new Station;
                        $station->name = $request->name;
                        $station->created_at = Carbon::now();
    
                        if ($station->save()) {
                        return response()->json(array('status'=>'error','msg'=>'Station added successfully'));
                        } else {
                            return response()->json(array('status'=>'error','msg'=>'Station Not saved'));
                        }
                        
                    }
                    else if ($request->action == 'edit'){
    
                        $station = Station::find($request->station_id);
                        $station->name = $request->name;
                        $station->updated_at = Carbon::now();
    
                        if ($station->save()) {
                        return response()->json(array('status'=>'error','msg'=>'Station update successfully'));
                        } else {
                            return response()->json(array('status'=>'error','msg'=>'Station Not update'));
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
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function show(Station $station)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $station)
    {
        $title = 'Add Station';
        $action = 'add';
        $data = Station::find($station->id);
        return view('station.add',['data'=>$data,'title'=>$title,'action'=>$action])->render();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function destroy(Station $station)
    {
        try{
            if(Station::where('id', $station->id)->update('is_active',$station->is_active)){

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
}
