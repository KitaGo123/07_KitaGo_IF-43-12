<?php

namespace App\Repositories;

use App\Interfaces\CRUDInterface;
use App\Models\Paket;

class PaketRepository implements CRUDInterface 
{
    public function all() 
    {
        return Paket::all();
    }

    public function get($id) 
    {
        return Paket::findOrFail($id);
    }

    public function delete($id) 
    {
        Paket::destroy($id);
    }

    public function store(array $data) 
    {
        return Paket::create($data);
    }

    public function update($id, array $data) 
    {
        return Paket::whereId($id)->update($data);
    }
}
?>