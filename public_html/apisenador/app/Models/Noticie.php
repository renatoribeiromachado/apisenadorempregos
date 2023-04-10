<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticie extends Model
{
    protected $table = "api_noticies_senador";
    protected $fillable = ['title', 'description', 'url', 'image'];


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


//    public function category()
//    {
//        return $this->belongsTo(Category::class);
//    }
}
