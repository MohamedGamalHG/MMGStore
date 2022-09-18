<?php


namespace App\Http\Repository\Customer;


interface HomePageRepositoryInterface
{
    public function index();
//    public function store($request);
//    public function update($request);
//    public function delete($request);
    public function Login_Customer($request);
    public function Login_Customer_View();
    public function Register_Customer($request);
    public function Register_Customer_View();
    public function Logout($id);
    public  function Shop_list();
    public function Shop_Detail($id);
    public function Add_Cart($id);
    public function Item_Add($request);
    public function Item_Delete($request);
    public function Shop_Cart();
    public function Checkout();
}
