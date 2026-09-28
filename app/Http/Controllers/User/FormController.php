<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::where('status', 'published')
            ->latest()
            ->get();

        return view('user.forms.index', compact('forms'));
    }

    public function show(Form $form)
    {
        abort_if($form->status !== 'published', 404);

        $form->load('fields.allOptions');

        return view('user.forms.show', compact('form'));
    }
}