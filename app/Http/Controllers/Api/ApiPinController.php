<?php

namespace App\Http\Controllers\Api;

use App\Models\Pin;
use App\Models\User;
use App\Models\Surat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiPinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function cekPin($id)
    {
        $pin_id = Pin::where('user_id', $id)->first();
        if (!$pin_id) {
            return response()->json([
                'status' => 'PIN Salah !!!'
            ], 401);
        } else {
            return response()->json([
                'status' => 'success'
            ], 200);
        }
    }

    public function proses(Request $request)
    {
        $id = $request->all();
        $pin_id = Pin::where('user_id', $id['user_id'])->first();
        if (!$pin_id || !Hash::check($id['pin'], $pin_id->pin)) {
            return response()->json([
                'status' => 'PIN Salah !!!'
            ], 401);
        } else {
            return response()->json([
                'status' => 'success'
            ], 200);
        }
    }

    public function prosesOut(Request $request)
    {
        $id = $request->all();
        $pin_id = Pin::where('user_id', $id['user_id'])->first();
        if (!$pin_id || !Hash::check($id['pin'], $pin_id->pin)) {
            return response()->json([
                'status' => $id
            ], 401);
        } else {
            $surat = Surat::where('id', $id['id'])->update([
            'to_id' => 0]);
            if ($surat) {
                return response()->json([
                    'status' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'gagal'
                ], 401);
            }
        }
    }
    
    public function prosesIn(Request $request)
    {
        $id = $request->all();
        $pin_id = Pin::where('user_id', $id['user_id'])->first();
        if (!$pin_id || !Hash::check($id['pin'], $pin_id->pin)) {
            return response()->json([
                'status' => 'PIN Salah !!!'
            ], 401);
        } else {
            $surat = Surat::where('id', $id['id'])->update([
            'user_id' => 0]);
            if ($surat) {
                return response()->json([
                    'status' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'gagal'
                ], 401);
            }
        }
    }

    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = User::where('id', $data['user_id'])->first();
        if (!Hash::check($data['password'], $user->password)) {
            return response()->json([
                'status'=>'Password Salah'
            ], 200);
        } else {
            $pin=Pin::create([
                'user_id' => $data['user_id'],
                'pin' => bcrypt($data['pin'])
            ]);
            return response()->json([
                'status'=>'PIN Berhasil Disimpan',
            ]);
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
        //
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
        $data = $request->all();
        $user = User::where('id', $data['user_id'])->first();
        if ($data['pin']!=$data['pin_confirmation']) {
            return response()->json([
                'status'=>'PIN Tidak Sama'
            ], 200);
        } elseif (!Hash::check($data['password'], $user->password)) {
            return response()->json([
                'status'=>'Password Salah'
            ], 200);
        } else {
            $pin_id = Pin::where('user_id', $data['user_id'])->first();
            if (!Hash::check($data['pin_old'], $pin_id->pin)) {
                return response()->json([
                    'status' => 'Pin Salah'
                ], 200);
            } else {
            $pin=Pin::where('user_id', $data['user_id'])->update([
                'pin' => bcrypt($data['pin'])
            ]);
            if ($pin) {
                return response()->json([
                    'status'=>'PIN Berhasil Diperbarui',
                ]);
            } else {
                return response()->json([
                    'status'=>'PIN Gagal Diperbarui',
                ]);
            }
            }
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
        //
    }
}
