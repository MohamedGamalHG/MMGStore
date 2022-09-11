<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Admin\FilterRepositoryInterface;
use App\Http\Requests\Admin\FilterRequest;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    protected $filter;
    public function __construct(FilterRepositoryInterface $fil)
    {
        $this->filter = $fil;
    }

    public function index()
    {
        return $this->filter->index();
    }


    public function store(FilterRequest $request)
    {
        return $this->filter->store($request);
    }


    public function update(FilterRequest $request)
    {
        return $this->filter->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->filter->destroy($request);
    }
}
