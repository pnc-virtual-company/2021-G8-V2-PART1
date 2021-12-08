<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserJoinEvent;
class UserJoinEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserJoinEvent::with(['user', 'myevent'])->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'myevent_id' => 'required',
        ]);

        $userJoinEvent = new UserJoinEvent();
        $userJoinEvent->user_id = $request->user_id;
        $userJoinEvent->myevent_id = $request->myevent_id;

        $userJoinEvent->save();

        return response()->json(['message' => 'User joined event',  'userJoinEvent' => UserJoinEvent::with(['user', 'myevent'])->latest()->first()], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return UserJoinEvent::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'myevent_id' => 'required',
        ]);

        $userJoinEvent = UserJoinEvent::findOrFail($id);
        $userJoinEvent->user_id = $request->user_id;
        $userJoinEvent->myevent_id = $request->myevent_id;

        $userJoinEvent->save();

        return response()->json(['message' => 'Updated User join event',  'userJoinEvent' => UserJoinEvent::with(['user', 'myevent'])->latest()->first()], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $isDeleted = UserJoinEvent::destroy($id);
      if($isDeleted) {
        response()->json(['message' => 'user join event deleted'], 200);

    } else {
        response()->json(['message' => 'fail to delete user join event'], 404);
      }
    }
}
