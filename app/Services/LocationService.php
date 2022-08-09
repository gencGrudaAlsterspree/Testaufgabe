<?php

namespace App\Services;

use App\Models\Location;
use Ramsey\Uuid\Uuid;

class LocationService
{

    public function getAll()
    {
        return Location::all();
    }

    public function add(array $data): array
    {
        $rows = array_map(function ($item) {
            return [
                'name'       => $item['name'],
                'state'      => $item['state'],
                'latitude'   => $item['coords']['lat'],
                'longitude'  => $item['coords']['lon'],
                'area'       => $item['area'] ?? null,
                'population' => $item['population'],
                'district'   => $item['district'] ?? null,
                'id'         => Uuid::uuid4(),
            ];
        }, $data);

        Location::insert($rows);

        return $rows;
    }
}
