<?php
namespace App\Services;

use App\Events\ContactRegistered;
use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactService
{
    public function __construct(protected ContactRepository $repository) {}

    public function listContactsWithPagination(int $amout) : LengthAwarePaginator {
        return $this->repository->basicPaginate($amout);
    }

    public function findById(int $id) {
        return $this->repository->findId($id);
    } 

    public function createContact(array $data) : Model {
        $contact = $this->repository->create($data);
        ContactRegistered::dispatch($contact);
        return $contact;
    }

    public function updateContact(array $data, int $id) : Model {
        return $this->repository->update($data, $id);
    }

    public function deleteContact(int $id) : int{
        return $this->repository->delete($id);
    }
}
