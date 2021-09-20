<?php

namespace App\Services;

use App\Classes\ErrorMessages;
use App\Repositories\MeasureRepository;
use PDOException;

class MeasureService extends BaseService
{
    protected $repository;

    public function __construct(MeasureRepository $repository)
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
            $measure = $this->repository->create($attributes);

            return $this->successResponse($measure, 201);
        } catch (PDOException $e) {
            return $this->errorResponse(
                ErrorMessages::CAN_NOT_CREATE,
                ErrorMessages::CAN_NOT_CREATE_MSG,
                $e->getMessage()
            );
        }
    }

    public function update(array $attributes, $id)
    {
        try {

            $measure = $this->getMeasure($id);

            $measure->name = $attributes['name'];

            $measure->save();

            return $this->successResponse($measure, 201);
        } catch (PDOException $e) {

            return $this->errorResponse(
                ErrorMessages::CAN_NOT_CREATE,
                ErrorMessages::CAN_NOT_CREATE_MSG,
                $e->getMessage()
            );
        }
    }

    public function view($id)
    {
        return $this->getMeasure($id);
    }

    public function delete($id)
    {
        $measure = $this->getMeasure($id);

        try {

            $measure->delete();
        } catch (PDOException $e) {

            return $this->errorResponse(
                ErrorMessages::CAN_NOT_DELETE_MSG,
                ErrorMessages::CAN_NOT_DELETE,
                $e->getMessage()
            );
        }
    }

    private function getMeasure($id)
    {
        $measure = $this->repository->find($id);

        if (!$measure) {
            abort(ErrorMessages::NOT_FOUND, ErrorMessages::NOT_FOUND_MSG);
        }

        return $measure;
    }
}
