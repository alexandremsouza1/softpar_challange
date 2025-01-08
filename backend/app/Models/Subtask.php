<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subtask extends Model
{
    use SoftDeletes;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'task_id',
        'title',
        'is_completed',
    ];

    /**
     * Relacionamento com a model Task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function assignees()
    {
        return $this->morphMany(TaskAssignee::class, 'assignee');
    }
}
