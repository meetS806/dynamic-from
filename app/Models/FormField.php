<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = [
        'form_id',
        'label',
        'type',
        'is_required',
        'sort_order',
        'parent_field_id',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function options()
    {
        return $this->hasMany(FieldOption::class)
            ->whereNull('parent_option_id')
            ->orderBy('sort_order');
    }

    public function allOptions()
    {
        return $this->hasMany(FieldOption::class);
    }

    public function parentField()
    {
        return $this->belongsTo(
            FormField::class,
            'parent_field_id'
        );
    }
}