<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{

    /* public function index(){
        return view('announcements.index');
    } */
     
    public function announce(){ 

        $announcements = Announcement::all();
        return view('admin.layout.auth.announcement', compact('announcements'));
    }

    // public function cust_announce(){

        // $announcements = Announcement::all();
        // return view('announcements.customer', compact('announcements'));
    // }

    public function create(){

        return view('announcements.create');
    }

    public function store(Request $request){
        
        $input = request()->except(['_token']);

        Announcement::create($input);
        return redirect('/announcement');
    }

    public function edit(Announcement $announcement){

        return view('announcements.edit', ['announcement'=>$announcement]);
    } 

    public function update(Request $request, Announcement $announcement){

        $formFields = $request->validate([
            'announcement_name' => 'required',
            'announcement_description' => 'required',
        ]);
        $announcement->update($formFields);

        return redirect('/announcement');
    }

    public function destroy($announcement){

        Announcement::where('announcement_id',$announcement)->delete();
        return redirect('/announcement')->with('message', 'Announcement delete successfully');
    }


    
}
