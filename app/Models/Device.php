<?php
/**
 * Created by PhpStorm.
 * User: Dizy
 * Date: 2018/5/17
 * Time: 22:12
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id', 'tag', 'location_desc', 'location_id', 'used_count', 'created_at', 'updated_at', 'is_operating', 'left_segment_count'
    ];

    protected $hidden = [];

}