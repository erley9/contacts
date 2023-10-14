<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactCollection;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    public function __construct(protected ContactService $service)
    {
    }

    public function index()
    {
        $pagination = $this->service->listContactsWithPagination(10);

        return new ContactCollection($pagination);
    }

    public function store(StoreContactRequest $request): JsonResponse
    {

        $contact = $this->service->createContact($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Contact created Successfully',
            'data' => new ContactResource($contact)
        ], 200);
    }

    public function show(int $id): JsonResponse
    {
        $contact = $this->service->findById($id);

        return response()->json([
            'status' => true,
            'message' => 'Successfully',
            'data' => new ContactResource($contact)
        ], 200);
    }


    public function update(UpdateContactRequest $request, int $id): JsonResponse
    {
        $contact = $this->service->updateContact($request->all(), $id);

        return response()->json([
            'status' => true,
            'message' => "Contact updated Successfully",
            'data' => new ContactResource($contact)
        ], 200);
    }


    public function destroy(int $id): JsonResponse
    {
        $this->service->deleteContact($id);

        return response()->json([
            'status' => true,
            'message' => "Contact deleted Successfully",
        ], 200);
    }
}
