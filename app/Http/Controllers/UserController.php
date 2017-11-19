<?php

namespace App\Http\Controllers;

Use App\User;
use Illuminate\Http\Request;
use Hash;
use Hashids;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $result = $user->save();

        if ($result) {
            $request->session()->flash('alert-success', '<strong>Success!</strong> Office account has been created.');
        } else {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Something went wrong. Office account not created.');
        }

        return redirect()->route('offices.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $user = User::find($id);

        if ( !is_null($user) ) {
            return view('admin.users.show')->with('user', $user);
        } else {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Office not found.');
            return redirect()->route('offices.show');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $user = User::find($id);

        if ( !is_null($user) ) {
            return view('admin.users.edit')->with('user', $user);
        } else {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Office not found.');
            return redirect()->route('offices.index');
        }
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
        $id = Hashids::decode($id)[0];

        if (!is_null($request->password)) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|string|min:8|confirmed'
            ]);
        }

        $user = User::find($id);

        if ( !is_null($user) ) {

            $user->name = $request->name;
            $user->email = $request->email;

            if (!is_null($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $result = $user->save();

            if ($result) {
                $request->session()->flash('alert-success', '<strong>Success!</strong> Office account has been updated.');
            } else {
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Office account not updated.');
            }

            return redirect()->route('offices.index');

        } else {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Office not found.');
            return redirect()->route('offices.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $user = User::find($id);

        if ( !is_null($user) ) {

            $result = $user->delete();

            if ($result) {
                $request->session()->flash('alert-success', '<strong>Success!</strong> Office account has been deleted.');
            } else {
                $request->session()->flash('alert-info', '<strong>Oops!</strong> Something went wrong. Office account not deleted.');
            }

            return redirect()->route('offices.index');

        } else {
            $request->session()->flash('alert-danger', '<strong>Oops!</strong> Office not found.');
            return redirect()->route('offices.index');
        }
    }
}
