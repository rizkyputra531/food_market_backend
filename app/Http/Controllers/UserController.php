<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Download excel file.
     *
     * @return Maatwebsite\Excel\Facades\Excel
     */

    public function excel(Request $request)
    {
        $roles = $request->post("roles1");
        if (!empty($roles)) {
            return Excel::download(new UsersExport($roles),strtolower($roles)."-".date("d-m-Y").".xlsx");
            // return (new UsersExport)->forRole($roles)->download(strtolower($roles)."-".date("d-m-Y").".xlsx");
        }
        return Excel::download((new UsersExport),"all-".date("d-m-Y").".xlsx");
        // return (new UsersExport)->download("all-".date("d-m-Y").".xlsx");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //untuk memunculkan listing atau data default

        $query = User::query();
        $query->when($request->get("roles",false), function ($q, $roles) { 
            return $q->where('roles', strtoupper($roles));
        });
        $query->when($request->get("name",false), function ($q, $name) { 
            return $q->where('name','like', "%{$name}%");
        });
        $user = $query->paginate(10);
        return view('users.index', compact("user"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {


        $data = $request->all();
        $data['profile_photo_path'] = $request->file('profile_photo_path')->store('assets/user', 'public');
        $data['password'] = Hash::make($request->password);
        $data['current_team_id'] = 1;

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User Berhasil Ditambahkan!!');

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
    public function edit(User $user)
    {
        //
        return view('users.edit',[
        'item' => $user
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        //
        $data = $request->all();

        if ($request->file('profile_photo_path')) {
        $data['profile_photo_path'] = $request->file('profile_photo_path')->store('assets/user', 'public');
        }
        $data['password'] = Hash::make($request->password);
        // dd($data);
        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
        //
    }
}
