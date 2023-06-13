<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public $incrementing = false;
    protected $keyType = 'uuid';

    use HasFactory,  UuidTrait;


    protected $fillable =  ['name'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
