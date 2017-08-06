<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index($type = 'season'){
        switch ($type){
            case 'season':
                $data = null;
                break;
            case 'other':
                $data = null;
                break;
        }
        return view('setting.index')
            ->with('type', $type)
            ->with('data', $data);
    }
}
