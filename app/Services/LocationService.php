<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class LocationService
{

    public function getAll(array $search = [], int $size = 10): Collection
    {
        $query = Location::query()->orderBy('name');
        if (!empty($search['name'])) {
            // search can be optimized by sorting by the exact match and then similar matches
            $query = $query->where('name', 'like', "%{$search['name']}%")
                ->limit($size);
        }

        return $query->get();
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

    public function find(UuidInterface $uuid)
    {
        return Location::find($uuid);
    }
}
