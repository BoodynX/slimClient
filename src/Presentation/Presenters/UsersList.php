<?php

namespace App\Presentation\Presenters;

class UsersList
{
    public function show(array $list): array
    {
        return [
            'users' => $list['data'],
            'metadata' => array_filter(
                $list,
                function ($key) {
                    return $key !== 'data';
                },
                ARRAY_FILTER_USE_KEY
            )
        ];
    }
}