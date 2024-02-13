<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use Illuminate\Http\Request;

class DriveController extends Controller
{
   
    public function index()
    {
        $drives = Drive::all();
        return view('drives.index')->with('drives', $drives);
    }

    
    public function create()
    {
        return view('drives.create');
    }

    
    public function store(Request $request)
    {
        $drive = new Drive();
        $drive->title = $request->title;
        $drive->description = $request->description;

        //upload file name , location
        $drive_Data = $request->file('inputFile');
        $drive_name = time() . $drive_Data->getClientOriginalName();
        $location = public_path('./drives/');
        $drive_Data->move($location,$drive_name);
        $drive->file = $drive_name;
        $drive->save();
        return redirect()->back()->with('done','Uploaded File Done');
    }

    
    public function show($id)
    {
        $drive = Drive::find($id);
        return view('drives.show')->with('drive', $drive);
    }

    
    public function edit($id)
    {
        $drive = Drive::find($id);
        return view('drives.edit')->with('drive', $drive);
    }

    public function update(Request $request, $id)
    {
        $drive = Drive::find($id);
        $drive->title = $request->title;
        $drive->description = $request->description;

        //upload file name , location
        $drive_Data = $request->file('inputFile');
        if($drive_Data != null)
        {
            $drive_name = time() . $drive_Data->getClientOriginalName();
            $location = public_path('./drives/');
            $drive_Data->move($location,$drive_name);
            $path = public_path() . "/drives/" . $drive->file;
            unlink($path);
            
        }else{
            $drive_name = $drive->file;
        }
      
        $drive->file = $drive_name;
        $drive->save();
        return redirect()->route('drive.index')->with('done','Updated File Done');
    }

    public function destroy($id)
    {
        $drive = Drive::find($id);
        $path = public_path() . "/drives/" . $drive->file;
        unlink($path);
        $drive->delete();
        return redirect()->route('drive.index')->with('done','Deleted File Done');

    }
    public function download($id){
         $drive = Drive::find($id);
         $driveName = $drive->file;

         $path = public_path() . "/drives/" . $driveName;

         return response()->download($path);
    }
}
