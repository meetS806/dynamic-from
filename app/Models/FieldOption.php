<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldOption extends Model
{
    protected $fillable = [
        'form_field_id',
        'label',
        'value',
        'parent_option_id',
        'sort_order',
    ];

    public function field()
    {
        return $this->belongsTo(
            FormField::class,
            'form_field_id'
        );
    }

    public function parent()
    {
        return $this->belongsTo(
            FieldOption::class,
            'parent_option_id'
        );
    }

    public function children()
    {
        return $this->hasMany(
            FieldOption::class,
            'parent_option_id'
        );
    }
}