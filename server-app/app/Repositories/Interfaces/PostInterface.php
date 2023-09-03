<?php
namespace App\Repositories\Interfaces;
Interface PostInterface{
    public function find($id);
    public function all();
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function restore($id);
    public function forceDelete($id);
}
