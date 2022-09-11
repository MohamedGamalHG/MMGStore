<?php


namespace App\Http\Repository\Admin;


interface SubFilterRepositoryInterface
{
    public function index();
    public function store($request);
    public function update($request);
    public function destroy($request);
}
