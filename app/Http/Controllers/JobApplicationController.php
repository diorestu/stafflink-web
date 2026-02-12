<?php

namespace App\Http\Controllers;

use App\Mail\JobApplicationSubmitted;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class JobApplicationController extends Controller
{
    public function create()
    {
        return view('application');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:40'],
            'age' => ['required', 'integer', 'min:16', 'max:75'],
            'religion' => ['required', 'in:Islam,Christan,Catolichs,Buddha,Hindu,Konghucu'],
            'province' => ['required', 'string', 'max:120'],
            'city' => ['required', 'string', 'max:120'],
            'speaks_english' => ['required', 'in:yes,no'],
            'english_level' => ['nullable', 'in:basic,intermediate,advanced,fluent'],
            'willing_to_travel' => ['required', 'in:yes,no'],
            'has_motorbike' => ['required', 'in:yes,no'],
            'has_passport' => ['required', 'in:yes,no'],
            'can_drive_car' => ['required', 'in:yes,no'],
            'position_title' => ['required', 'string', 'max:120'],
            'resume' => ['required', 'file', 'mimes:pdf', 'max:4096'],
        ]);

        if ($validated['speaks_english'] === 'yes' && empty($validated['english_level'])) {
            return back()
                ->withInput()
                ->withErrors(['english_level' => 'Please select English level.']);
        }

        if ($validated['speaks_english'] === 'no') {
            $validated['english_level'] = null;
        }

        $resumePath = $request->file('resume')->store('applications/resumes', 'public');

        $application = JobApplication::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'age' => (int) $validated['age'],
            'religion' => $validated['religion'],
            'province' => $validated['province'],
            'city' => $validated['city'],
            'speaks_english' => $validated['speaks_english'] === 'yes',
            'english_level' => $validated['english_level'] ?? null,
            'willing_to_travel' => $validated['willing_to_travel'] === 'yes',
            'has_motorbike' => $validated['has_motorbike'] === 'yes',
            'has_passport' => $validated['has_passport'] === 'yes',
            'can_drive_car' => $validated['can_drive_car'] === 'yes',
            'position_title' => $validated['position_title'],
            'resume_path' => $resumePath,
            'status' => 'new',
        ]);

        try {
            Mail::to('careers@stafflink.pro')->send(new JobApplicationSubmitted($application));
        } catch (Throwable) {
            return redirect()
                ->route('applications.create')
                ->with('warning', 'Application saved, but email delivery failed. Please check mail configuration.');
        }

        return redirect()
            ->route('applications.create')
            ->with('success', 'Application submitted successfully. We will contact you soon.');
    }
}
