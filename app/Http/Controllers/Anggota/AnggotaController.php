<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;

class AnggotaController extends Controller
{
    public function index(){
        return view('page.anggota.anggota.index');
    }
}
