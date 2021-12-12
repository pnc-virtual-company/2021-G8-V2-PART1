<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Myevent;
use Illuminate\Support\Facades\DB;

class MyeventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = DB::table('myevents')
            ->join('categories', 'myevents.category_id', '=', 'categories.id')
            ->select('myevents.*', 'categories.name as categoryName')
            ->latest()
            ->get()
            ->toArray();
        foreach($events as $event) {
            $userIdList = DB::table('user_join_events')
            ->select('user_id')
            ->where('myevents_id', '=', $event->id)
            ->get()
            ->toArray();

            $cleanArrayUserIdList = [];
            foreach($userIdList as $userId) {
                array_push($cleanArrayUserIdList, $userId->user_id);
            }
            $event->joinUserIdList = $cleanArrayUserIdList;
        }
        return $events;
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
            'category_id'=>'required',
            'user_id'=>'required',
            'title'=>'required',
            'start_date'=>'required',
            'end_date'=>'required|after:start_date',
            'city'=>'required',
        ]);

        $myevent = new Myevent();
        $myevent->category_id = $request->category_id;
        $myevent->user_id = $request->user_id;
        $myevent->title = $request->title;
        $myevent->start_date = $request->start_date;
        $myevent->end_date = $request->end_date;
        $myevent->city = $request->city;
        $myevent->description = $request->description;
        if($request->photo == null) {
            $myevent->photo = 'empty.jpg';
        } else {
            $myevent->photo = $request->file('photo')->hashName();
            $request->file('photo')->store('public/photos');
        }

        $myevent->save();
        
        $myevent->joinUserIdList = [];
        return response()->json(["message"=>"My event Created!","myEvent"=> $myevent],201);
        
        
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
        $myevent = Myevent::findOrFail($id);
        $myevent->category_id = $request->category_id;
        $myevent->user_id = $request->user_id;
        $myevent->title = $request->title;
        $myevent->start_date = $request->start_date;
        $myevent->end_date = $request->end_date;
        $myevent->city = $request->city;
        $myevent->description = $request->description;
        if($request->hasfile('photo')){
            // $file = $request->file('image');
            $myevent->photo =$request->file('photo')->hashName();
            $request->file('photo')->store('public/photos');

        }else{
            $img = 'empty.jpg';
            $myevent->photo = $img;
        }
        $myevent->save();
        return response()->json(["message"=>"My event updated!","myEvent"=> Myevent::with(['category'])->latest()->first()],201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Myevent::destroy($id);
        if($isDeleted === 1){
            return response()->json(["message"=>'My event deleted!'],200);
        }
        return response()->json(['message'=>"Failed to delete"],404);  
    }
}
