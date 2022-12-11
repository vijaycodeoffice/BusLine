<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Bus master';
        $bus_list = Bus::all();
        return view('bus.index',['title'=>$title,'data'=>$bus_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add bus';
        $action = 'add';

        return view('bus.add',['title'=>$title,'action'=>$action])->render();
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
                'route_id' => 'required',
                'type' => 'required',
                'category' => 'required',
                'capacity' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
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
                
                    $bus = new Bus;
                    $bus->route_id = $request->route_id;
                    $bus->type = $request->type;
                    $bus->category = $request->category;
                    $bus->capacity = $request->capacity;
                    $bus->start_time = $request->start_time;
                    $bus->end_time = $request->end_time;
                    $bus->created_at = Carbon::now();

                    if ($bus->save()) {
                    return response()->json(array('status'=>'error','msg'=>'Bus added successfully'));
                    } else {
                        return response()->json(array('status'=>'error','msg'=>'Bus Not saved'));
                    }
                    
                }
                else if ($request->action == 'edit'){

                    $bus = Bus::find($request->bus_id);
                    $bus->route_id = $request->route_id;
                    $bus->type = $request->type;
                    $bus->category = $request->category;
                    $bus->capacity = $request->capacity;
                    $bus->start_time = $request->start_time;
                    $bus->end_time = $request->end_time;
                    $bus->updated_at = Carbon::now();

                    if ($bus->save()) {
                    return response()->json(array('status'=>'error','msg'=>'BUS update successfully'));
                    } else {
                        return response()->json(array('status'=>'error','msg'=>'BUS Not updated'));
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
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        $title = 'Add Route';
        $action = 'add';
        $data = Bus::find($route->id);
        return view('bus.add',['data'=>$data,'title'=>$title,'action'=>$action])->render();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
       //
       try{
        if(Bus::where('id', $bus->id)->update('is_active',$bus->is_active)){

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
