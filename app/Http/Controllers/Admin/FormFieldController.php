<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FieldOption;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormFieldController extends Controller
{
    public function store(Request $request, Form $form)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|in:text,number,textarea,radio,checkbox,select',
            'options' => 'nullable|array',
            'options.*' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $form, $validated) {

            $field = $form->fields()->create([
                'label' => $validated['label'],
                'type' => $validated['type'],
                'is_required' => $request->boolean('is_required'),
                'sort_order' => $form->fields()->count() + 1,
            ]);

            if (in_array($validated['type'], [
                'radio',
                'checkbox',
                'select'
            ])) {

                foreach ($request->input('options', []) as $option) {

                    if (blank($option)) {
                        continue;
                    }

                    FieldOption::create([
                        'form_field_id' => $field->id,
                        'label' => $option,
                        'value' => strtolower(
                            str_replace(' ', '_', $option)
                        ),
                    ]);
                }
            }
        });

        return back()->with(
            'success',
            'Field added successfully.'
        );
    }
}