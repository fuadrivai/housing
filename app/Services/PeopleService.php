<?php

namespace App\Services;

interface peopleService
{
    public function get();
    public function getPersonNomember($yearId,$houseId);
    public function show($id);
    public function post($data);
    public function put($data);
    public function delete($id);
}
