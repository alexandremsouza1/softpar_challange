<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskAssignee extends Model
{
    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'assignee_type',
        'assignee_id',
        'is_completed',
        'completed_at',
    ];

    /**
     * Relacionamento com o usuário.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento polimórfico com o assignee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function assignee()
    {
        return $this->morphTo();
    }

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];
}
