<?php

namespace App\Support\Http\Controllers;

class BaseIndexController extends BaseController
{
    /**
     * List items.
     *
     * @param mixed $serviceRepository
     *
     * @return void
     */
    public function _index(array $params, $serviceRepository, string $resource)
    {
        $take = data_get($params, 'take', 20);
        $paginate = $paginate = data_get($params, 'paginate', true);
        $paginate = filter_var($paginate, FILTER_VALIDATE_BOOLEAN);

        if (!$paginate && !$take) {
            $take = false;
        }

        $items = $serviceRepository
            ->getAllByParams($params, $take, $paginate);

        return $resource::collection($items);
    }
}
