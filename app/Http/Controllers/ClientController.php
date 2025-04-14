<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // return all clients in the database
        return ApiResponse::success(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        // validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'required'
        ]);

        // store client
        $client = Client::create($request->all());

        // return response
        return ApiResponse::success($client);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // find client
        $client = Client::find($id);

        if ($client) {
            return ApiResponse::success($client);
        } else {
            return ApiResponse::error('Client not found');
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'required'
        ]);
        
        // find client
        $client = Client::find($id);
        if ($client) {
            // update client
            $client->update($request->all());
            // return response
            return ApiResponse::success($client);
        } else {
            return ApiResponse::error('Client not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // find client
        $client = Client::find($id);

        if ($client) {
            // delete client
            $client->delete();
            // return response
            return ApiResponse::success('Client deleted successfully');
        } else {
            return ApiResponse::error('Client not found');
        }
    }
}
