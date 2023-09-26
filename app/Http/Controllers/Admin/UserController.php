<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Profile;
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
    public function getDataUser()
    {
        // $artikel = Artikel::with('user')->get();
        // $total = Artikel::with('user')->get()->count();
        // $length = intval($_REQUEST['length']);
        $total                          = User::get()->count();

        $length                         = intval($_REQUEST['length']);
        $length                         = $length < 0 ? $total : $length;
        $start                          = intval($_REQUEST['start']);
        $draw                           = intval($_REQUEST['draw']);

        $search                         = $_REQUEST['search']['value'];

        $output                         = array();
        $output['data']                 = array();

        $end                            = $start + $length;
        $end                            = $end > $total ? $total : $end;


        if($search != ''){
                $query                         = User::where(function($filter) use ($search) {
                                                $filter->orWhere('name', 'like', '%' . $search . '%');
                                                })
                                                ->take($length)
                                                ->skip($start)
                                                ->get();
            $no = $start + 1;
            foreach ($query as $userss) {
                $name = $userss->name ;
                $email = $userss->email ;
                $phone = $userss->phone ;
                $role = $userss->role ;
                $actions = "
                            <div class='col-12 row center'>
                                <a href=".route('users.edit', $userss->email)." class='btn btn-success m-1 btn-sm'><i class='fas fa-edit m-1'></i>".__('button.edit')."</a>
                                <a href='javascript:destroyUser(`$userss->id`)' class='btn btn-danger btn-delete btn-sm m-1'><i class='fas fa-trash m-1'></i>".__('button.delete')."</a>
                            </div>
                ";

                $output['data'][] =
                    array(
                        $no,
                        $name,
                        $email,
                        $phone,
                        $role,
                        $actions,
                    );
                $no++;
            }

                $rows                         = User::
                                                where(function($filter) use ($search) {
                                                    $filter->orWhere('name', 'like', '%' . $search . '%');
                                                        })
                                                        ->get();
            $output['draw']                 = $draw;
            $output['recordsTotal']         = $output['recordsFiltered']      = $rows->count();
        }
        else{
                $query                         = User::
                                                    take($length)
                                                    ->skip($start)
                                                    ->get();

            $no = $start + 1;
            foreach ($query as $userss) {
                $name = $userss->name ;
                $email = $userss->email ;
                $phone = $userss->phone ;
                $role = $userss->role ;
                $actions = "
                            <div class='col-12 row center'>
                                <a href=".route('users.edit', $userss->email)." class='btn btn-success m-1 btn-sm'><i class='fas fa-edit m-1'></i>".__('button.edit')."</a>
                                <a href='javascript:destroyUser(`$userss->id`)' class='btn btn-danger btn-delete btn-sm m-1'><i class='fas fa-trash m-1'></i>".__('button.delete')."</a>
                            </div>
                ";

                $output['data'][] =
                    array(
                        $no,
                        $name,
                        $email,
                        $phone,
                        $role,
                        $actions,
                    );
                $no++;
            }
            $output['draw']             = $draw;
            $output['recordsTotal']     = $total;
            $output['recordsFiltered']  = $total;
        }

        return response()->json($output);
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
        $user = User::find($id);
        $post = Artikel::where('user_id', $id)->get()->count();
        if ($post>0) {
            return response()->json([
                'success'=> false,
                'data'=> $user,
            ]);
            $user->delete();
            return response()->json([
                'success'=> true,
                'data'=> $user,
            ]);
        // if ($post > 0) {
        //     return redirect()->back()->with('error',__("alert.yourDeleteUserIsSuccessfully"));
        // } else {
        //     $user->delete();
        //     return redirect()->back()->with('Succes', 'error', __("alert.yourDeleteUserIsFailed"));
        // }
        // // return response()->json($user);
        // if ($user) {
        //     return redirect('Admin/users')->with('success', __("alert.yourDeleteUserIsSuccessfully"));
        // } else {
        //     return redirect('Admin/users')->with('error', __("alert.yourDeleteUserIsFailed"));
        // } 
        }
    }
    public function profileUser()
    {
        $profile = Profile::with('user')->get();
        return view ('pages.admin.profile.index', compact('profile'));
    }
}
