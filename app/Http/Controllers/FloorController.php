<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\DataTables\FloorDatatable;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FloorDatatable $floor)
    {
        return $floor->render('floors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|unique:floors'
        ]);

        $data['number']     = rand(1000, 9999);

        $data['manager_id'] = auth()->user()->id;
    
        Floor::create($data);
        return response()->json(['success' => trans('admin.record_added')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        return view('floors.ajax_show', compact('floor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Floor $floor)
    {
        return view('floors.ajax_edit', compact('floor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Floor $floor)
    {
        $data = $request->validate([
            'name'     => 'required|unique:floors,name,'. $floor->id,
        ]);

        $floor->update($data);
        return response()->json(['success' => trans('admin.updated_record')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floor $floor)
    {
        if(!empty($floor->rooms[0])){                   //floor has rooms

            return response()->json(['error' => trans('admin.can_not_delete_this_floor')]);
        
        }else{ 
                                                     //floor has no rooms
            $floor->delete();
            return response()->json(['success' => trans('admin.deleted_record')]);
       
        }
        
    }

    public function destroyAll()
    {
        Floor::destroy(request('item'));
        return response()->json(['success' => trans('admin.deleted_record')]);
    }
}
