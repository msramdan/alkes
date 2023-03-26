<?php

namespace App\Http\Controllers\frontend;

use App\Models\AuthWeb;
use App\Http\Controllers\Controller;
use App\Models\PelaksanaTeknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AuthWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.login');
    }

    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => "required|email",
                'password' => 'required|string',
            ],
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        $email = $request->email;
        $password = $request->password;
        $data = PelaksanaTeknisi::where('email', $email)->first();
        if ($data) {
            if (Hash::check($password, $data->password)) {
                Session::put('id-teknisi', $data->id);
                return redirect()->route('home');
            } else {
                toast('Email atau Password salah !', 'error');
                return redirect()->back()->withInput($request->all())->withErrors($validator);
            }
        } else {
            toast('Email atau Password salah !', 'error');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('id-teknisi');
        return redirect()->route('auth-web');
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'password_lama' =>
                [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, get_data_teknisi()->password)) {
                            $fail('Old Password didn\'t match');
                        }
                    },
                ],
                'password' => 'required|min:6|required_with:konfirmasi_password|same:konfirmasi_password',
                'konfirmasi_password' => 'min:6'
            ],
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $update = DB::table('pelaksana_teknisis')
            ->where('id', get_data_teknisi()->id)
            ->update(['password' => bcrypt($request->password)]);

        if ($update) {
            toast('Update password berhasil !', 'success');
            $request->session()->forget('id-teknisi');
            return redirect()->route('auth-web');
        } else {
            toast('Update password gagal !', 'error');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuthWeb  $authWeb
     * @return \Illuminate\Http\Response
     */
    public function show(AuthWeb $authWeb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuthWeb  $authWeb
     * @return \Illuminate\Http\Response
     */
    public function edit(AuthWeb $authWeb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuthWeb  $authWeb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuthWeb $authWeb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuthWeb  $authWeb
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuthWeb $authWeb)
    {
        //
    }
}
