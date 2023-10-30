<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends BaseRepository
{
    protected $model;

    /**
     * TaskRepository constructor
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function paginate(
        $items = null,
        $sortColumn = 'id',
        $sortOrder = 'asc',
        $filterField = 'name',
        $filter = null,
        $statusId = null,
        $projectId = null,
        $priorityId = null,
        $userId = null
    ) {
        $model = $this->model->orderBy($sortColumn, $sortOrder);

        if ($filter) {
            $model->where($filterField, 'like', '%' . $filter . '%');
        }

        if ($statusId) {
            $model->where('status_id', $statusId);
        }

        if ($projectId) {
            $model->where('project_id', $projectId);
        }

        if ($priorityId) {
            $model->where('priority_id', $priorityId);
        }

        if ($userId) {
            $model->where('user_id', $userId);
        }

        return $model->with('status:id,name')->with('priority:id,name')->with('user:id,name')->paginate($items);
    }

}
