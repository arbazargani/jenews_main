<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function Manage() {
        $settings = Setting::all();
        return view('admin.setting.edit', compact('settings'));
    }

    /**
     * because mysql rows start from 1, so if option exists, row id will returns and if not, false will return.
     *
     * @param $name
     * @return bool
     */
    public function optionExist($name) {
        $option = Setting::Where('name', $name)->get();
        return count($option) == 1 ? $option[0]->id : false;
    }

    public function Update(Request $request) {
        $request->validate([
            'website_name' => 'required|min:1',
            'meta_title' => 'min:1',
            'meta_description' => 'min:1',
            'admin_email' => 'required|min:8',
            'title_delimiter' => 'required|min:1|max:1'
        ]);
        foreach ($request->all() as $name => $value) {
            if ($name != '_token') {
                // means the option exist & should update
                if ($this->optionExist($name) !== false) {
                    $option = Setting::find($this->optionExist($name));
                    $option->value = $value;
                    $option->save();
                }
            }
        }
        return redirect(route('Setting'));
    }

    public function Add() {
        //
    }

    public function Delete() {
        //
    }
}
