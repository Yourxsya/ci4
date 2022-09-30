<?php

namespace App\Controllers;

class MenuController extends BaseController
{
    public function home()
    {
        return view('beranda');
    }
    public function infoKegiatan()
    {
        return view('info-kegiatan');
    }
    public function dataSiswa()
    {
        return view('siswa');
    }
}
