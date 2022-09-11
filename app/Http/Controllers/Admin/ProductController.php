<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Admin\ProductRepositoryInterface;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    public function __construct(ProductRepositoryInterface $pro)
    {
        $this->product = $pro;
    }
    public function index()
    {
        return $this->product->index();
    }


    public function store(ProductRequest $request)
    {
        return  $this->product->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return  $this->product->show();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return  $this->product->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request)
    {
        return  $this->product->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return  $this->product->destroy($request);
    }
}
