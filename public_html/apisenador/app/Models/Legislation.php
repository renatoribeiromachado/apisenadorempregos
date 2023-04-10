<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legislation extends Model
{
    protected $table = "api_legislations_senador";
    protected $fillable = ['title', 'link','url'];


    public function getResults($data, $total)
    {
        if (!isset($data['filter']) && !isset($data['title']))
            return $this->paginate($total);

        return $this->where(function ($query) use ($data) {
                    if (isset($data['filter'])) {
                        $filter = $data['filter'];
                        $query->where('title', $filter);
                    }

                    if (isset($data['title']))
                        $query->where('title', $data['title']);
                   
                })//->toSql();dd($results);
                ->paginate($total);
    }

}
