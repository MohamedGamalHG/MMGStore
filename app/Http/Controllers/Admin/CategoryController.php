<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Admin\CategoryRepositoryInterface;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(CategoryRepositoryInterface $cat)
    {
        $this->category = $cat;
    }
    public function index()
    {

        return $this->category->index();
    }


    public function store(CategoryRequest $request)
    {
        return $this->category->store($request);
    }


    public function update(CategoryRequest $request)
    {
        return $this->category->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->category->destroy($request);
    }
}
