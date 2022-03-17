<?php

namespace App\Http\Controllers\Api;

use App\Models\Surat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;

class SuratController extends Controller
{
    public function outbox($id)
    {
        $surat = Surat::where('user_id', $id)->get();
        if ($surat->isEmpty()) {
            $response = [
                'message' => 'Maaf data tidak ada',
            ];    
        } else {
            $response = [
                'data' => $surat
            ];
        }
        return response()->json($response, Response::HTTP_OK);
    }

    public function inbox($id)
    {
        $surat = Surat::where('to_id', $id)->get();
        if ($surat->isEmpty()) {
            $response = [
                'message' => 'Maaf data tidak ada',
            ];    
        } else {
            $response = [
                'data' => $surat
            ];
        }
        return response()->json($response, Response::HTTP_OK);
    }
}
