<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QRCode;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QRCode::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $QRCode = QRCode::create($request->all());

        return response()->json($QRCode, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QRCode  $QRCode
     * @return \Illuminate\Http\Response
     */
    public function show(QRCode $QRCode)
    {
        return $QRCode;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QRCode  $qRCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QRCode $QRCode)
    {
        $QRCode->update($request->all());

        return response()->json($QRCode, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QRCode  $qRCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(QRCode $QRCode)
    {
        $QRCode->delete();

        return response()->json(null, 204);
    }
}
