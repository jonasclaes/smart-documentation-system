<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\QRCode
 *
 * @property-read File $file
 * @method static Builder|QRCode newModelQuery()
 * @method static Builder|QRCode newQuery()
 * @method static Builder|QRCode query()
 * @mixin Eloquent
 */
class QRCode extends Model
{
    use HasFactory;

    protected $table = 'qrcodes';

    // Allow mass filling of the following properties.
    protected $fillable = [
        'content',
        'scanCount',
        'fileId'
    ];

    /**
     * Get the file belonging to the QR-code.
     * @return BelongsTo
     */
    public function file() {
        return $this->belongsTo(File::class, 'fileId');
    }
}
