<?php

namespace App\Services;

interface OrganizationService
{
    public function get();
    public function show($id);
    public function post($data);
    public function put($data);
    public function delete($id);
}
