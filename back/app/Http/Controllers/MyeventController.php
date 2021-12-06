<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Myevent;
use App\Http\Resources\MyeventResource;

class MyeventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return MyeventResource::collection(Myevent::orderBy('id','desc')->get());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'description'=>'required|min:50',
           
        ]);

        $myevent = new Myevent();
        $myevent->title = $request->title;
        $myevent->start_date = $request->start_date;
        $myevent->end_date = $request->end_date;
        $myevent->description = $request->description;
        $myevent->save();
        return response()->json(["message"=>"My event Created!","My event"=>$myevent],200);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Myevent::findOrFail($id);
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
        //
        $request->validate([
            'title'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'description'=>'required|min:50',
        ]);
        $myevent = Myevent::findOrFail($id);
        $myevent->title = $request->title;
        $myevent->start_date = $request->start_date;
        $myevent->end_date = $request->end_date;
        $myevent->description = $request->description;
        $myevent->save();
        return response()->json(['message'=>"My event Updated!", 'My event'=>$myevent],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDeleted = Myevent::destroy($id);
        if($isDeleted === 1){
            return response()->json(["message"=>'My event deleted!'],201);
        }
        return response()->json(['message'=>"Failed to delete"],404);
    }
    public function search($title) 
    {
        //
        return Myevent::where("title", "like", "%".$title."%")->get();
    }
}
