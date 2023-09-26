<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('pages.admin.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'string', 'unique:users'],
            'phone' => ['required'],
            'password' => ['required', 'min:8'],
        ],
        [
          '*.required' => '::attribute Wajib Diisi',
          'min' => 'Karakter kurang dari :min',
          'max' => 'Karakter lebih dari :max',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['password']= Hash::make($request->password);
        $user = User::create($data);
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'phone' => $request->phone,
        //     'role' => $request->role,
        // ]);
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->phone = $request->phone;
        // $user->role = $request->role;
        // $user->save();
        if ($user) {
            return redirect('Admin/users')->with('success', __("alert.yourAddUserIsSuccessfully"));
        } else {
            return redirect('Admin/users')->with('error', __("alert.yourAddUserIsFailed"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('email', $id)->first();
        return view('pages.admin.users.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'string'],
            'phone' => ['required'],
        ],
        [
          '*.required' => '::attribute Wajib Diisi',
          'min' => 'Karakter kurang dari :min',
          'max' => 'Karakter lebih dari :max',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::find($id);
        if ($request->password) {
            # code...
            $data['password']= Hash::make($request->password);
        }
        else {
            $data['password']= $user->password;
        }
        $user->update($data);
        if ($user) {
            return redirect('Admin/users')->with('success', __("alert.yourUpdateUserIsSuccessfully"));
        } else {
            return redirect('Admin/users')->with('error', __("alert.yourUpdateUserIsFailed"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        if ($user) {
            return redirect('Admin/users')->with('success', __("alert.yourDeleteUserIsSuccessfully"));
        } else {
            return redirect('Admin/users')->with('error', __("alert.yourDeleteUserIsFailed"));
        }
    }
}
