<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LocationService $service)
    {
        $data = $service->getAll();
        return \response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, LocationService $service)
    {
        $data = $request->validate([
            'file' => 'required'
        ]);

        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $data['file'];

        $locationData = \json_decode($file->getContent(), true);
        $service->add($locationData);

        return response(1, Response::HTTP_CREATED);
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
