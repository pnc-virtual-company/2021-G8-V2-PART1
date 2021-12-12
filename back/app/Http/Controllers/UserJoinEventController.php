<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserJoinEvent;
use Illuminate\Support\Facades\DB;

class UserJoinEventController extends Controller
{
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
        $userJoinEvent->myevents_id = $request->myevent_id;

        $userJoinEvent->save();

        return response()->json(['message' => 'User joined event',  'userJoinEvent' => UserJoinEvent::with(['user', 'myevent'])->latest()->first()], 201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $joinedIdToDelete = UserJoinEvent::select('id')->where('user_id', '=', $request->user_id)->where('myevents_id', '=', $request->myevent_id)->get();
        return UserJoinEvent::destroy($joinedIdToDelete[0]->id);
    }
}

