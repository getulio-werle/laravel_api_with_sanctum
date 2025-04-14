<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
        return $this->sendResponse(true, 'success', Client::all(), 200);
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
        return $this->sendResponse(true, 'Client created successfully', $client, 200);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // find client
        $client = Client::find($id);

        if ($client) {
            return $this->sendResponse(true, 'success', $client, 200);
        } else {
            return $this->sendResponse(false, 'Client not found', null, 404);
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
        
        // update client
        $client = Client::find($id);
        $client->update($request->all());
        
        // return response
        return $this->sendResponse(true, 'Client updated successfully', $client, 200);
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

            return $this->sendResponse(true, 'Client deleted successfully', null, 200);
        } else {
            return $this->sendResponse(false, 'Client not found', null, 404);
        }
    }

    private function sendResponse(bool $success, string $message, object|null $data, int $status): JsonResponse
    {
        return response()->json(
            [
                'success' => $success,
                'message' => $message,
                'data' => $data
            ],
            $status
        );
    }
}
