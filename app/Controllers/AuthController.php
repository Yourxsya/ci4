<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function _construct()
    {
        $this->model = new \App\Models\User();
    }
    public function registrasi()
    {
        return view('registrasi');
    }
    public function simpanRegistrasi()
    {
        //return redirect()->to(base_url('registrasi));
        //ambil data
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'konfirmasi_password' => $this->request->getPost('kofirm_pass'),
        ];
        //validasi

        $validation = \config\Services::validation();

        $validation->setRules([
            'nama' =>'required',
            'email' =>'required|valid_email|is_unique[users.email]',
            'password' =>'required|min_length[8]',
            'konfirmasi_password' =>'required|matches[password]'
        ]);

        //cek validasi

        if($validation->run($data)) {
            $this->model->save([
                'name' => $data['nama'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                'role' => 'siswa'
            ]);

            return redirect()->to(base_url('registrasi'))->with('sukses','registrasi berhasil !' );
        } else {
            $errorMessages = $validation->getErrors();
            print_r($errorMessages);
            return redirect()->to(base_url('registrasi'))->with('gagal', $errorMessages);
        }
        
    }
    public function login()
    {
        return view('login');
    }
}
