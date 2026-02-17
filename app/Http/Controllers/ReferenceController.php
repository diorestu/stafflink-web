<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;

class ReferenceController extends Controller
{
    public function show(string $token)
    {
        $application = JobApplication::query()
            ->where('reference_token', $token)
            ->firstOrFail();

        return view('reference-show', compact('application'));
    }
}
