<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/users', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.add_user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'email' => 'email|required|unique:users',
            'phone' => 'numeric|nullable',
            'role' => 'numeric|required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $data = [];
        $pass = $request->first_name . '@' . random_int(1000, 9999);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($pass);
        $user->phone = $request->phone;
        $user->role_id = $request->role;
        $data['first_name'] = $request->first_name;
        $data['middle_name'] = $request->middle_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['password'] = $pass;
        $data['link'] = url('/');
        $data['role'] = $user->role->name;
        Mail::to($user->email)->send(new \App\Mail\RegistrationMail($data));
        $user->save();
        return redirect()->back()->withSuccess('User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('dashboard.view_profile', [
            'user' => User::where('id', Auth::id())->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('dashboard.edit_user', [
            'user' => User::where('id', Auth::id())->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'image' => 'required|mimes:jpeg,jpg,png',
            'last_name' => 'required|string',
            'email' => 'email',
            'phone' => 'numeric|required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        if ($request->hasFile('image')) {
            $user_image = $request->image->getClientOriginalName();
            $filename = time() . '.' . $user_image;
            $request->image->move('assets/images/users/', $filename);
        }

        $defaultImageUrl = asset('assets/images/users/' . $filename);

        $updateUser = User::where('id', Auth::id())->first();
        $updateUser->first_name = $request->first_name;
        $updateUser->middle_name = $request->middle_name;
        $updateUser->last_name = $request->last_name;
        $updateUser->email = $request->email;
        $updateUser->image_url = $defaultImageUrl;
        $updateUser->phone = $request->phone;
        $updateUser->save();
        return redirect('dashboard/view_profile')->withSuccess('User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
