<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function store(Request $request, Form $form)
    {
        abort_if($form->status !== 'published', 404);

        $form->load('fields');

        $rules = [];

        foreach ($form->fields as $field) {

            $rules["fields.{$field->id}"] = [
                $field->is_required ? 'required' : 'nullable'
            ];

            if ($field->type === 'number') {
                $rules["fields.{$field->id}"][] = 'numeric';
            }

            if ($field->type === 'checkbox') {
                $rules["fields.{$field->id}"][] = 'array';
            }
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($form, $validated) {

            $submission = $form->submissions()->create([
                'user_id' => auth()->id(),
            ]);

            foreach ($form->fields as $field) {

                $value =
                    $validated['fields'][$field->id] ?? null;

                if (is_array($value)) {
                    $value = json_encode($value);
                }

                $submission->answers()->create([
                    'form_field_id' => $field->id,
                    'value' => $value,
                ]);
            }
        });

        return redirect()
            ->route('user.forms.index')
            ->with('success', 'Form submitted successfully.');
    }
}