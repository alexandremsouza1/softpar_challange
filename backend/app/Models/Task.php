<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'deadline',
        'is_completed',
        'is_urgent',
        'is_important',
    ];

    /**
     * Relacionamento com a model Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'deadline' => 'datetime',
        'is_completed' => 'boolean',
        'is_urgent' => 'boolean',
        'is_important' => 'boolean',
    ];

    public function assignees()
    {
        return $this->morphMany(TaskAssignee::class, 'assignee');
    }
}
