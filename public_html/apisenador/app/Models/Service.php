<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "api_services_senador";
    protected $fillable = ['title','url', 'description', 'image'];


    public function getResults($data, $total)
    {
        if (!isset($data['filter']) && !isset($data['title']) && !isset($data['description']))
            return $this->paginate($total);

        return $this->where(function ($query) use ($data) {
            if (isset($data['filter'])) {
                $filter = $data['filter'];
                $query->where('title', $filter);
                $query->orWhere('description', 'LIKE', "%{$filter}%");
            }

            if (isset($data['title']))
                $query->where('title', $data['title']);

            if (isset($data['description'])) {
                $description = $data['description'];
                $query->where('description', 'LIKE', "%{$description}%");
            }
        })//->toSql();dd($results);
        ->paginate($total);
    }
    
    /**
     * Serach
     * @param type $filter
     * @return type**
     */

    public function search($filter = null)
    {
        $results = $this->where('title', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }

}
