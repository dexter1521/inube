<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function loginView()
    {
        return view('view_login');
    }
}
