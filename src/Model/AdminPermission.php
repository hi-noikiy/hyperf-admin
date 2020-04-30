<?php declare (strict_types=1);

namespace Oyhdd\Admin\Model;

/**
 * @property int $id 
 * @property string $name 
 * @property string $slug 
 * @property string $http_method 
 * @property string $http_path 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 */
class AdminPermission extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_permissions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime'];
}