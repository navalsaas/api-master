<?php

namespace App\Support\Http\Controllers;

class UserIndexController extends BaseController
{
    /**
     * List items.
     *
     * @param [Service/Repository] $serviceRepository
     *
     * @return void
     */
    public function _index(array $params, $serviceRepository, string $resource, array $additional = [])
    {
        $take = data_get($params, 'take', 20);
        $paginate = $paginate = data_get($params, 'paginate', true);
        $paginate = filter_var($paginate, FILTER_VALIDATE_BOOLEAN);

        if (!$paginate && !$take) {
            $take = false;
        }

        $items = $serviceRepository
            ->setUserId(auth()->id())
            ->getAllByParams($params, $take, $paginate);

        return $resource::collection($items)
            ->additional($additional);
    }
}
