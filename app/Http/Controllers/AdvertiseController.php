<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertise;

class AdvertiseController extends Controller
{
    protected $sockets = [
        'sidebar-001',
        'sidebar-002',
        'sidebar-003',
        'sidebar-004',
        'sidebar-right-001',
        'sidebar-right-002',
        'article-001',
        'article-002',
        'article-003',
        'home-001',
        'home-002',
        'home-003',
        'home-004',
        'home-005',
        'home-006',
        'sticky-all',
        'position_fixed_mobile',
        'sticky-bar',
        'modal-all',
        'modal-mobile',
    ];
    protected $types = [
        'banner',
        'native',
        'link',
        'pre-roll',
        'push-notif',
        'opt-in'
    ];

    public function New()
    {
        $advertises = Advertise::all();
        $sockets = $this->sockets;
        $types = $this->types;
        $used_sockets = [];

        foreach ($advertises as $advertise) {
            $used_sockets[] = $advertise->socket;
        }

        return view('admin.advertise.new', compact(['sockets', 'used_sockets', 'types']));
    }

    public function Submit(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'author' => 'required|min:3',
            'socket' => 'required',
            'type' => 'required',
            'state' => 'required',
            'just_admin' => 'required',
            'expires_at' => 'required',
        ]);
        $advertise = new Advertise();
        $advertise->title = $request['title'];
        $advertise->content = $request['content'];
        $advertise->author = $request['author'];
        $advertise->socket = $request['socket'];
        $advertise->link = ($request->has('link')) ? $request['link'] : '';
        $advertise->type = $request['type'];
        $advertise->slug = substr(hash('sha256', 'abcdefghijklmnop1234567890' . strtoupper('abcdefghijklmnop1234567890')), 0, 4);
        $advertise->state = $request['state'];
        $advertise->mobile_only = ($request->has('mobile_only')) ? $request['mobile_only'] : 0;
        $advertise->just_admin = $request['just_admin'];
        $advertise->expires_at = $request['expires_at'];
        $advertise->save();

        return redirect(route('Advertise > Edit', $advertise->id));

    }

    public function Manage()
    {
        $advertises = Advertise::all();
        $sockets = $this->sockets;
        $types = $this->types;
        return view('admin.advertise.manage', compact(['advertises', 'sockets', 'types']));
    }

    public function Edit($id)
    {
        $advertises = Advertise::all();
        $sockets = $this->sockets;
        $types = $this->types;
        $used_sockets = [];

        foreach ($advertises as $advertise) {
            $used_sockets[] = $advertise->socket;
        }

        $advertise = Advertise::find($id);

        return view('admin.advertise.edit', compact(['advertise', 'sockets', 'used_sockets', 'types']));
    }

    public function Update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:5',
            'author' => 'required|min:3',
            'socket' => 'required',
            'type' => 'required',
            'state' => 'required',
            'expires_at' => 'required',
        ]);
        $advertise = Advertise::find($id);
        $advertise->title = $request['title'];
        $advertise->content = $request['content'];
        $advertise->author = $request['author'];
        $advertise->socket = $request['socket'];
        $advertise->link = ($request->has('link')) ? $request['link'] : '';
        $advertise->type = $request['type'];
        $advertise->slug = substr(hash('sha256', 'abcdefghijklmnop1234567890' . strtoupper('abcdefghijklmnop1234567890')), 0, 4);
        $advertise->state = $request['state'];
        $advertise->mobile_only = ($request->has('mobile_only')) ? $request['mobile_only'] : 0;
        $advertise->just_admin = $request['just_admin'];
        $advertise->expires_at = $request['expires_at'];
        $advertise->save();

        return back();
    }

    public function Delete($id)
    {
        //
    }

}
