<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class KelolaAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('level', 'ADMIN')->where('name', 'like', '%' . request('cari') . '%')->paginate(15);;
        return view('admin.data_admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "no_hp" => $request->no_hp,
            "level" => "ADMIN",
            "alamat" => "Banda Aceh",
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('data-admin.index')->with('success', 'Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $data_admin)
    {
        return view('admin.data_admin.edit', compact('data_admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $data_admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $data_admin->id,
            'password' => 'nullable|min:8',
        ]);

        $data_admin->name = $request->name;
        $data_admin->email = $request->email;
        $data_admin->no_hp = $request->no_hp;

        if (!empty($request->password)) {
            $data_admin->password = bcrypt($request->password);
        }

        $data_admin->save();
        return redirect()->route('data-admin.index')->with('success', 'Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $data_admin)
    {
        $data_admin->delete();
        return redirect()->route('data-admin.index')->with('success', 'Data Berhasil di Hapus');
    }
}
