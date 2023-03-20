<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\{StoreRoomRequest, UpdateRoomRequest};
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:room view')->only('index', 'show');
        $this->middleware('permission:room create')->only('create', 'store');
        $this->middleware('permission:room edit')->only('edit', 'update');
        $this->middleware('permission:room delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $rooms = Room::query();

            return DataTables::of($rooms)
                ->addColumn('action', 'rooms.include.action')
                ->toJson();
        }

        return view('rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        
        Room::create($request->validated());

        return redirect()
            ->route('rooms.index')
            ->with('success', __('The room was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        
        $room->update($request->validated());

        return redirect()
            ->route('rooms.index')
            ->with('success', __('The room was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        try {
            $room->delete();

            return redirect()
                ->route('rooms.index')
                ->with('success', __('The room was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('rooms.index')
                ->with('error', __("The room can't be deleted because it's related to another table."));
        }
    }
}
