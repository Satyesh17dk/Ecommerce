<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Authorisation extends BaseController
{
    public function login()
    {
        return view('admin/login');
    }

public function loginPost()
{
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $adminModel = new AdminModel();
    $admin = $adminModel->where('email', $email)->first();

    if (!$admin || !password_verify($password, $admin['password'])) {
        return redirect()->back()->with('error', 'Invalid login credentials');
    }

    session()->set([
        'admin_id' => $admin['id'],
        'admin_logged_in' => true
    ]);

    return redirect()->to(site_url('admin/dashboard'));
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('admin/login'));

    }
}
