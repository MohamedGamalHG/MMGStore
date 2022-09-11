<?php

namespace App\Http\Repository\Admin;

interface ProductRepositoryInterface
{
    public function index();
    public function store($request);
    public function show();
    public function update($request);
    public function edit($id);
    public function destroy($request);
}
