<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrenzProducts extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function creatUp(Array $data):bool
    {
        #the values to insert or update
        $arg1 = $data;
        #lists the column(s) that uniquely identify records
        $arg2 = ['productId'];
        # the columns that should be updated if a matching record already exists in the database
        $arg3 = ['price','stock','name','description'];

       // $result = $this->create($data);
        $result =  TrenzProducts::upsert($arg1,$arg2,$arg3);

        return $result;
    }
}
