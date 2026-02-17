<?php

namespace App\Http\Controllers;

use App\Mail\JobApplicationSubmitted;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class JobApplicationController extends Controller
{
    public function create(Request $request)
    {
        $selectedJob = null;
        $jobId = (int) $request->query('job_id', 0);

        if ($jobId > 0) {
            $selectedJob = Job::query()->find($jobId);
        }

        return view('application', compact('selectedJob'));
    }

    public function store(Request $request)
    {
        $jobId = (int) $request->input('career_job_id', 0);
        $linkedJob = $jobId > 0 ? Job::query()->find($jobId) : null;

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:40'],
            'age' => ['required', 'integer', 'min:16', 'max:75'],
            'religion' => ['required', 'in:Islam,Christan,Catholic,Catolichs,Buddha,Hindu,Konghucu'],
            'address' => ['required', 'string', 'max:255'],
            'speaks_english' => ['required', 'in:yes,no'],
            'english_level' => ['nullable', 'in:basic,intermediate,advanced,fluent'],
            'willing_to_travel' => ['required', 'in:yes,no'],
            'has_motorbike' => ['required', 'in:yes,no'],
            'has_passport' => ['required', 'in:yes,no'],
            'can_drive_car' => ['required', 'in:yes,no'],
            'career_job_id' => ['nullable', 'integer', 'exists:career_jobs,id'],
            'position_title' => ['nullable', 'string', 'max:120', 'required_without:career_job_id'],
            'attachment_link' => ['nullable', 'url', 'max:255'],
            'reference_name' => ['required', 'string', 'max:120'],
            'reference_company' => ['required', 'string', 'max:150'],
            'reference_phone' => ['required', 'string', 'max:40'],
            'reference_email' => ['required', 'email', 'max:190'],
            'custom_questions' => ['nullable', 'array'],
            'custom_questions.*' => ['nullable', 'string', 'max:255'],
            'custom_answers' => ['nullable', 'array'],
            'custom_answers.*' => ['nullable', 'string', 'max:2000'],
            'resume' => ['required', 'file', 'mimes:pdf', 'max:4096'],
            'id_ktp' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
            'skck' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
            'cover_letter_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:4096'],
            'portfolio_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,zip,rar,doc,docx,ppt,pptx', 'max:8192'],
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
        $idKtpPath = $request->file('id_ktp')->store('applications/id-ktp', 'public');
        $skckPath = $request->file('skck')->store('applications/skck', 'public');
        $coverLetterFilePath = $request->hasFile('cover_letter_file')
            ? $request->file('cover_letter_file')->store('applications/cover-letters', 'public')
            : null;
        $portfolioFilePath = $request->hasFile('portfolio_file')
            ? $request->file('portfolio_file')->store('applications/portfolio', 'public')
            : null;

        $expectedQuestions = collect($linkedJob?->custom_questions ?? [])
            ->map(fn ($q) => trim((string) $q))
            ->filter(fn ($q) => $q !== '')
            ->values();

        $submittedQuestions = collect($validated['custom_questions'] ?? [])
            ->map(fn ($q) => trim((string) $q))
            ->values();
        $submittedAnswers = collect($validated['custom_answers'] ?? [])->values();

        $customAnswers = [];
        if ($expectedQuestions->isNotEmpty()) {
            foreach ($expectedQuestions as $idx => $question) {
                $questionFromForm = (string) $submittedQuestions->get($idx, '');
                $answer = trim((string) $submittedAnswers->get($idx, ''));

                if ($questionFromForm !== $question || $answer === '') {
                    return back()
                        ->withInput()
                        ->withErrors(['custom_answers' => 'Please answer all custom questions for this position.']);
                }
                $customAnswers[$question] = $answer;
            }
        }

        $positionTitle = $linkedJob?->title ?? (string) ($validated['position_title'] ?? '');

        if ($positionTitle === '') {
            return back()
                ->withInput()
                ->withErrors(['position_title' => 'Position title is required.']);
        }

        $application = JobApplication::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'age' => (int) $validated['age'],
            'religion' => $validated['religion'],
            'address' => $validated['address'],
            // Backward compatibility for existing non-null columns/reporting.
            'province' => $validated['address'],
            'city' => $validated['address'],
            'speaks_english' => $validated['speaks_english'] === 'yes',
            'english_level' => $validated['english_level'] ?? null,
            'willing_to_travel' => $validated['willing_to_travel'] === 'yes',
            'has_motorbike' => $validated['has_motorbike'] === 'yes',
            'has_passport' => $validated['has_passport'] === 'yes',
            'can_drive_car' => $validated['can_drive_car'] === 'yes',
            'position_title' => $positionTitle,
            'attachment_link' => $validated['attachment_link'] ?? null,
            'cover_letter' => null,
            'portfolio_url' => null,
            'custom_answers' => $customAnswers ?: null,
            'career_job_id' => $linkedJob?->id,
            'resume_path' => $resumePath,
            'id_ktp_path' => $idKtpPath,
            'skck_path' => $skckPath,
            'cover_letter_file_path' => $coverLetterFilePath,
            'portfolio_file_path' => $portfolioFilePath,
            'reference_name' => $validated['reference_name'],
            'reference_company' => $validated['reference_company'],
            'reference_phone' => $validated['reference_phone'],
            'reference_email' => $validated['reference_email'],
            'reference_token' => (string) Str::uuid(),
            'status' => 'new',
        ]);

        try {
            Mail::to('careers@stafflink.pro')->send(new JobApplicationSubmitted($application));
        } catch (Throwable $e) {
            report($e);

            return redirect()
                ->route('applications.create')
                ->with('warning', 'Application saved, but email delivery failed. Please check mail configuration.');
        }

        return redirect()
            ->route('applications.create')
            ->with('success', 'Application submitted successfully. We will contact you soon.');
    }
}
