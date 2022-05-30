<?php

namespace App\Repositories;

use App\Interfaces\CRUDInterface;
use App\Models\Customer;

class CustomerRepository implements CRUDInterface 
{
    public function all() 
    {
        return Customer::all();
    }

    public function get($id) 
    {
        return Customer::findOrFail($id);
    }

    public function delete($id) 
    {
        Customer::destroy($id);
    }

    public function store(array $data) 
    {
        return Customer::create($data);
    }

    public function update($id, array $data) 
    {
        return Customer::whereId($id)->update($data);
    }
}
?>