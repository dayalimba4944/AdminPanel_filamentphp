<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_place',
        'title',
        'description',
        'media_types',
        'media',
        'status',
    ];

    public function getStatusAttribute($value)
    {
        return $value == '1' ? 'Active' : 'deactive';
    }
}
