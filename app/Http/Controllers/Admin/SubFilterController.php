<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Admin\SubFilterRepositoryInterface;
use App\Http\Requests\Admin\SubFilterRequest;
use Illuminate\Http\Request;

class SubFilterController extends Controller
{
   protected $subfilter;
   public function __construct(SubFilterRepositoryInterface $subfil)
   {
       $this->subfilter = $subfil;
   }

    public function index()
    {
        return $this->subfilter->index();
    }


    public function store(SubFilterRequest $request)
    {

        return $this->subfilter->store($request);
    }


    public function update(SubFilterRequest $request)
    {
        return $this->subfilter->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->subfilter->destroy($request);
    }
}
