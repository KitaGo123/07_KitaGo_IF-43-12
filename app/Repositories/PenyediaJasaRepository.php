<?php

namespace App\Repositories;

use App\Interfaces\CRUDInterface;
use App\Models\PenyediaJasa;

class PenyediaJasaRepository implements CRUDInterface 
{
    public function all() 
    {
        return PenyediaJasa::all();
    }

    public function get($id) 
    {
        return PenyediaJasa::findOrFail($id);
    }

    public function delete($id) 
    {
        PenyediaJasa::destroy($id);
    }

    public function store(array $data) 
    {
        return PenyediaJasa::create($data);
    }

    public function update($id, array $data) 
    {
        return PenyediaJasa::whereId($id)->update($data);
    }
}
?>