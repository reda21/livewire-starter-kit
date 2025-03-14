<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ... (autres méthodes)

    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRoles()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }
}