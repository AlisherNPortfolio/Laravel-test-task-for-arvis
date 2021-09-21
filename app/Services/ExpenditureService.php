<?php

namespace App\Services;

use App\Classes\ErrorMessages;
use App\Repositories\ExpenditureRepository;
use Exception;

class ExpenditureService extends BaseService
{
    protected $repository;

    public function __construct(ExpenditureRepository $repository)
    {
        $this->repository = $repository;
    }

    public function pagination()
    {
        return $this->repository->paginate();
    }

    public function create(array $attributes)
    {
        try {
            $created = $this->repository->create($attributes);

            return $this->successResponse($created);
        } catch (Exception $e) {
            return $this->errorResponse(
                ErrorMessages::CAN_NOT_CREATE_MSG,
                ErrorMessages::CAN_NOT_CREATE,
                $e->getMessage()
            );
        }
    }

    public function update(array $attributes, $id)
    {
        $expenditure = $this->getExpenditure($id);

        try {
            $data = collect($attributes);

            $expenditure->fill(
                $data->except('id', 'created_at')
                    ->toArray()
            );

            $updated = $expenditure->save();

            return $this->successResponse($updated);
        } catch (Exception $e) {

            return $this->errorResponse(
                ErrorMessages::CAN_NOT_CREATE_MSG,
                ErrorMessages::CAN_NOT_CREATE,
                $e->getMessage()
            );
        }
    }

    public function view($id)
    {
        return $this->getExpenditure($id);
    }

    public function delete($id)
    {
        try {

            $removingItem = $this->getExpenditure($id);

            $removingItem = $removingItem->delete();

            return $this->successResponse($removingItem);
        } catch (Exception $e) {
            return $this->errorResponse(
                ErrorMessages::CAN_NOT_DELETE_MSG,
                ErrorMessages::CAN_NOT_DELETE,
                $e->getMessage()
            );
        }
    }

    private function getExpenditure($id)
    {
        $expenditure = $this->repository->find($id);

        if (!$expenditure) {
            abort(ErrorMessages::NOT_FOUND, ErrorMessages::NOT_FOUND_MSG);
        }

        return $expenditure;
    }
}
