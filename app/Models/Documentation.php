<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable = ['report_id', 'description', 'file_path'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
