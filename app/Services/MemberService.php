<?php

namespace App\Services;

interface MemberService
{
    public function get();
    public function show($id);
    public function post($data);
    public function put($data);
    public function delete($id);
    public function getHouseByActiveAcademicYear();
    public function getMembersByHouseAndYear($houseId, $yearId);
}
