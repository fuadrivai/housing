<?php

namespace App\Services;

interface AcademicYearService
{
    public function get();
    public function show($id);
    public function post($data);
    public function put($data);
    public function toggleActive($data);
    public function delete($id);
}
