<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    use HasFactory;

    // Allow mass filling of the following properties.
    protected $fillable = [
        'content',
        'token',
        'scanCount',
        'fileId'
    ];

    /**
     * Get the file belonging to the QR-code.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file() {
        return $this->belongsTo(File::class, 'fileId');
    }
}
