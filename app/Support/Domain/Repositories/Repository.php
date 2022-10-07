<?php

namespace App\Support\Domain\Repositories;

use App\Support\QueryBuilder\QueryBuilder;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Repository
{
    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass;

    /**
     * @var string user id
     */
    protected $userId;

    /**
     * @var bool
     */
    protected $userOnly = false;

    /**
     * @var mixed
     */
    protected $trashed = false;

    /**
     * @var int
     */
    protected $maxLimit = 100;

    /**
     * @var array
     */
    protected $allowedIncludes;

    /**
     * @see https://docs.spatie.be/laravel-query-builder/v2/features/filtering/
     *
     * @var array
     */
    protected $allowedFilters = [];

    /**
     * @var array
     */
    protected $allowedFiltersStart = [];

    /**
     * @var array
     */
    protected $allowedFiltersEnd = [];

    /**
     * @var array
     */
    protected $allowedSorts;

    /**
     * @var string
     */
    protected $defaultSort = '-created_at';

    /**
     * @var array
     */
    protected $columns = [];

    /**
     * @var array
     */
    protected $mergeParams = [];

    protected $with = [];

    /**
     * set columns.
     */
    public function setColumns(array $columns = [])
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * set User id.
     */
    public function setUserId(?string $id = null)
    {
        $this->userId = $id;

        return $this;
    }

    /**
     * Switch between user only and global scopes.
     *
     * @return $this
     */
    public function userOnly(bool $userOnly = true)
    {
        $this->userOnly = $userOnly;

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function newQuery()
    {
        $query = app()->make($this->modelClass)->newQuery();

        if (!empty($this->columns)) {
            $query->select($this->columns);
        }

        $this->setQueryFilterUser($query);
        $this->getWith($query);

        return $query;
    }

    public function setQueryFilterUser($query, $user = null)
    {
        if (!$this->userOnly || (!$user && !$this->userId)) {
            return $this;
        }

        $userId = $user->id ?? $this->userId;

        $query->where('user_id', $userId);

        return $this;
    }

    public function setQueryFilterTrash($query)
    {
        if ('only' === $this->trashed) {
            $query->onlyTrashed();
        }

        if ('with' === $this->trashed) {
            $query->withTrashed();
        }
    }

    /**
     * Query against deleted records only.
     *
     * @return $this
     */
    public function onlyTrashed()
    {
        $this->trashed = 'only';

        return $this;
    }

    /**
     * Query against all records, including deleted.
     *
     * @return $this
     */
    public function withTrashed()
    {
        $this->trashed = 'with';

        return $this;
    }

    /**
     * Reset trashed state so results will only include non-deleted records;.
     *
     * @return $this
     */
    public function withoutTrashed()
    {
        $this->trashed = false;

        return $this;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     * @param int                                                                      $take
     * @param bool                                                                     $paginate
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\AbstractPaginator
     */
    public function doQuery($query = null, $take = 20, $paginate = true)
    {
        if (null === $query) {
            $query = $this->newQuery();
        }

        if (true === $paginate) {
            return $query
                ->paginate((int) $take, ['*'], 'page');
        }

        if ($take > 0 || false !== $take) {
            $newTake = $take > $this->maxLimit ? $this->maxLimit : $take;
            $query->take((int) $newTake);
        }

        return $query->get();
    }

    /**
     * Creates a Model object with the $data information.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function factory(array $data = [])
    {
        $model = $this->newQuery()->getModel()->newInstance();

        $this->setModelData($model, $data, true);

        return $model;
    }

    /**
     * Performs the save method of the model
     * The goal is to enable the implementation of your business logic before the command.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    public function save($model)
    {
        return $model->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data = [])
    {
        $model = $this->factory($data);

        $this->save($model);

        return $model;
    }

    /**
     * Returns all records.
     * If $take is false then brings all records
     * If $paginate is true returns Paginator instance.
     *
     * @param bool|int $take
     * @param bool     $paginate
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Pagination\AbstractPaginator
     */
    public function getAll($take = 20, $paginate = true)
    {
        return $this->doQuery(null, $take, $paginate);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     * @param array|Request                                                            $request
     */
    public function queryBuilder($query = null, $request = null)
    {
        if (!$query) {
            $query = $this->newQuery();
        }

        $newRequest = \is_array($request)
            ? new Request($request)
            : $request;

        $this->queryBuilderFiltersStartEnd($query, $newRequest);

        $queryBuilder = QueryBuilder::for($query, $newRequest);

        if (!empty($this->allowedIncludes)) {
            $queryBuilder->allowedIncludes($this->allowedIncludes);
        }

        $filters = $this->getAllowedFilters();

        if (!empty($filters)) {
            $queryBuilder->allowedFilters($filters);
        }

        if (!empty($this->allowedFilters)) {
            $queryBuilder->allowedFilters($this->allowedFilters);
        }
        if ($this->allowedSorts) {
            $queryBuilder->allowedSorts($this->allowedSorts);
        }
        if ($this->defaultSort) {
            $queryBuilder->defaultSort($this->defaultSort);
        }

        return $queryBuilder;
    }

    public function queryBuilderFiltersStartEnd($query, $request = null)
    {
        if (!$request || (empty($this->allowedFiltersStart) && empty($this->allowedFiltersEnd))) {
            return;
        }

        foreach ($this->allowedFiltersStart as $key => $value) {
            $field = "filter.${key}";
            if ($request->has($field) && null !== $request->input($field)) {
                $query->where($value, '>=', $request->input($field));
            }
        }
        foreach ($this->allowedFiltersEnd as $key => $value) {
            $field = "filter.${key}";
            if ($request->has($field) && null !== $request->input($field)) {
                $query->where($value, '<=', $request->input($field));
            }
        }
    }

    /**
     * Returns all records with filter by params.
     * If $take is false then brings all records
     * If $paginate is true returns Paginator instance.
     *
     * @param Request  $request
     * @param bool|int $take
     * @param bool     $paginate
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Pagination\AbstractPaginator
     */
    public function getAllByRequest(?Request $request = null, $take = 15, $paginate = true)
    {
        $queryBuilder = $this->queryBuilder(null, $request);

        return $this->doQuery($queryBuilder, $take, $paginate);
    }

    /**
     * Returns all records with filter by params.
     * If $take is false then brings all records
     * If $paginate is true returns Paginator instance.
     *
     * @param bool|int $take
     * @param bool     $paginate
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Pagination\AbstractPaginator
     */
    public function getAllByParams(array $params = [], $take = 20, $paginate = true)
    {
        $newParams = array_merge($this->mergeParams, $params);

        $query = $this->queryBuilder(null, $newParams);

        return $this->doQuery($query, $take, $paginate);
    }

    public function getWith($query)
    {
        $query->with($this->with);
    }

    /**
     * Retrieves a record by his id
     * If fail is true $ fires ModelNotFoundException.
     *
     * @param bool $fail
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByID(string $id, $fail = false)
    {
        if ($fail) {
            return $this->newQuery()->findOrFail($id);
        }

        return $this->newQuery()->find($id);
    }

    /**
     * Retrieves a record by his id
     * If fail is true $ fires ModelNotFoundException.
     *
     * @param bool $fail
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getByID(string $id, $fail = false)
    {
        return $this->findById($id, $fail);
    }

    /**
     * Updated model data, using $data
     * The sequence performs the Model update.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    public function update($model, array $data = [])
    {
        $this->setModelData($model, $data, false);

        return $this->save($model);
    }

    /**
     * Run the delete command model.
     * The goal is to enable the implementation of your business logic before the command.
     *
     * @param bool $model
     */
    public function delete(Model $model, bool $force = false): bool
    {
        if ($force) {
            return $model->forceDelete();
        }

        return $model->delete();
    }

    /**
     * Run the delete command model.
     *
     * @param \Illuminate\Database\Eloquent\Collection $collection
     *
     * @return bool
     */
    public function deleteAll($collection)
    {
        return $collection->each(function ($item) {
            return $item->delete();
        });
    }

    /**
     * Run the restore command model.
     * The goal is to enable the implementation of your business logic before the command.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    public function restore($model)
    {
        return $model->restore();
    }

    public function getAllowedFilters()
    {
        return $this->allowedFilters;
    }

    public function count()
    {
        return $this->newQuery()
            ->count();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function setModelData($model, array $data, bool $creating = false)
    {
        $this->setModelDataUserId($model);

        return $model->fill($data);
    }

    protected function setModelDataUserId($model)
    {
        if (!$this->userOnly || $model->user_id) {
            return $this;
        }

        if ($this->userId) {
            $model->user_id = $this->userId;

            return $this;
        }

        if (Auth::check()) {
            $model->user_id = Auth::id();
        }

        return $this;
    }
}
