<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\File;
use Ramsey\Uuid\Uuid;

class LocationDataController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Services\LocationService  $service
     * @param  \Illuminate\Http\Request       $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(
        LocationService $service,
        Request         $request
    ): JsonResponse {
        $search = $request->validate([
            'name' => 'string|min:2|max:255',
        ]);

        $data = $service->getAll($search);

        return \response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, LocationService $service)
    {
        $data = $request->validate([
            'file' => [
                'required',
                File::types(['json']),
                // would like to add an extra json content validation here,
                // don't have time :(
            ],
        ]);

        // also validate duplication and filter them out

        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $data['file'];

        $locationData = \json_decode($file->getContent(), true);
        $service->add($locationData);

        return response(null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  string                         $id
     * @param  \App\Services\LocationService  $service
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id, LocationService $service): JsonResponse
    {
        // can also validate ID here as UUID, or can also add validation to routing/MW
        return response()->json($service->find(Uuid::fromString($id)));
    }
}
