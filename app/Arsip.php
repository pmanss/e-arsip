<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arsip extends Model
{
    protected $fillable = [
        'no_dokumen','nama_arsip','perihal','nama_berkas','bulan','tahun',
    ];
    use SoftDeletes;
}
