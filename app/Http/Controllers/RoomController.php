<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\DataTables\RoomDatatable;
use App\Models\Reservation;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoomDatatable $room)
    {
        return $room->render('rooms.index');
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
            'number'        => 'required|min:4|unique:rooms',
            'capacity'      => 'required',
            'price'         => 'required',
            'floor_id'      => 'required',
        ]);
        $data['price']     = $data['price'] * 100;
        Room::create($data);
        return response()->json(['success' => trans('admin.record_added')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('rooms.ajax_show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('rooms.ajax_edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'number'        => 'required|min:4|unique:rooms,number,' . $room->id,
            'capacity'      => 'required',
            'price'         => 'required',
            'floor_id'      => 'required',
        ]);
        $data['price']     = $data['price'] * 100;
        $room->update($data);
        return response()->json(['success' => trans('admin.updated_record')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $is_reserved = Reservation::where('room_id', $room->id)->first();

        if($is_reserved){

            return response()->json(['error' => trans('admin.can_not_delete_this_room')]);
        
        }else{

            $room->delete();
            return response()->json(['success' => trans('admin.deleted_record')]);
        
        }
        
    }

    public function destroyAll()
    {
        Room::destroy(request('item'));
		return response()->json(['success' => trans('admin.deleted_record')]);
    }
}
