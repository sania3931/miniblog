<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $member = User::where('role', 'Member')->count();
        $admin = User::where('role', 'Admin')->count();
        $artikel = Artikel::count();
        $category = Category::count();

        return view('pages.admin.dashboard.index', compact('member','admin','artikel','category'));
    }
}
