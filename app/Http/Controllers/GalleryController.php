<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function New()
    {
        return view('admin.gallery.new');
    }

    public function Submit(Request $request)
    {
        $timestamp = $request['timestamp'];
        $input=$request->all();
        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){
                $name = $file->getClientOriginalName();
                $file->move("storage/uploads/gallery/$timestamp",$name);
                $images[] = "$timestamp/$name";
            }
        }

        $gallery = new Gallery();
        $gallery->title = $request['title'];
        $gallery->timestamp = $request['timestamp'];
        $gallery->content = implode("|",$images);
        $gallery->save();

        return redirect(route('Gallery > Edit', $gallery->id));

    }

    public function Manage()
    {
        $galleries = Gallery::orderBy('id', 'desc')->paginate(30);
        return view('admin.gallery.manage', compact(['galleries']));
    }

    public function Edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact(['gallery']));
    }

    public function Update(Request $request, $id)
    {
        //
    }

    public function Delete($id)
    {
        //
    }
}
