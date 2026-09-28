<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::latest()->get();

        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('admin.forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $form = Form::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'published',
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.forms.edit', $form)
            ->with('success', 'Form created successfully.');
    }

    public function edit(Form $form)
    {
        $form->load('fields.allOptions');

        return view('admin.forms.edit', compact('form'));
    }
}