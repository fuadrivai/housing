<?php

namespace App\Services;

interface HouseService
{
    public function get();
    public function show($id);
    public function post($data);
    public function put($data);
    public function delete($id);
}
