<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'post_type_id',
        'name',
        'email',
        // 'phone_code',
        'phone_number',
        'address',
        'profile_picture',
        'status',
    ];

    public function postType()
    {
        return $this->belongsTo(PostType::class, 'post_type_id');
    }

    public function getStatusAttribute($value)
    {
        return $value == '1' ? 'Active' : 'deactive';
    }
}
