<?php

namespace App\Services\Implement;

use App\Models\House;
use App\Services\HouseService;
use Illuminate\Support\Facades\Storage;

class HouseImplement implements HouseService
{
    public function get()
    {
        return House::all();
    }
    public function show($id)
    {
        return House::findOrFail($id);
    }

    public function post($data)
    {
        $imagePath = null;

        if (isset($data['image']) && $data['image']->isValid()) {
            $imagePath = $data->file('image')->store('houses', 'public');
        }

        $house = House::create([
            'name' => $data['name'],
            'fullname' => $data['fullname'],
            'motto' => $data['motto'],
            'core' => $data['core'],
            'attribute' => $data['attribute'],
            'description' => $data['description'],
            'image' => $imagePath,
        ]);

        return $house;
    }

    public function put($data)
    {
        $house = House::findOrFail($data->id);
        if ($data->hasFile('image')) {
            if ($house->image && Storage::disk('public')->exists($house->image)) {
                Storage::disk('public')->delete($house->image);
            }
            $imagePath = $data->file('image')
                ->store('houses', 'public');
            $house->image = $imagePath;
        }
        $house->update([
            'name' => $data->name,
            'fullname' => $data->fullname,
            'motto' => $data->motto,
            'core' => $data->core,
            'attribute' => $data->attribute,
            'description' => $data->description,
            'image' => $house->image,
        ]);
        return $house->fresh();
    }

    public function delete($id)
    {
        $house = House::findOrFail($id);
        return $house->delete();
    }
}
