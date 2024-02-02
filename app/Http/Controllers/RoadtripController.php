<?php

namespace App\Http\Controllers;
use App\Models\Roadtrip;

use Illuminate\Http\Request;

class RoadtripController extends Controller
{
    public function index(){
        $roadtrips = Roadtrip::all();
        return view("roadtrip.index", compact('roadtrips'));
    }
    

    public function create(){
        return view("roadtrip.create");
    }

    public function store(Request $request){
        $request->validate([
            "name"=> ["required", "string"],
            "date"=> ["required", "date"],
            "gps"=> ["required", "string"],
            "url"=> ["required","string"],
        ]);

        $roadtrip = Roadtrip::create([
            "name"=> $request->name,
            "date"=> $request->date,
            "gps"=> $request->gps,
            "url"=> $request->url,
        ]);

        return redirect()->route("roadtrip.index");
    }

    public function delete($id){
        $roadtrip = Roadtrip::find($id);
        $roadtrip->delete();

        return redirect()->route("roadtrip.index");
    }

    public function show(){
        $roadtrips = Roadtrip::all()->sortBy('date');
        return view("roadtrip.show", compact("roadtrips"));
    }
}
