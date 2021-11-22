<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QRCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return QRCode::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $QRCode = QRCode::create($request->all());

        return response()->json($QRCode, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param QRCode $QRCode
     * @return Response
     */
    public function show(QRCode $QRCode)
    {
        return $QRCode;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param QRCode $qRCode
     * @return Response
     */
    public function update(Request $request, QRCode $QRCode)
    {
        $QRCode->update($request->all());

        return response()->json($QRCode, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param QRCode $qRCode
     * @return Response
     */
    public function destroy(QRCode $QRCode)
    {
        $QRCode->delete();

        return response()->json(null, 204);
    }
}
