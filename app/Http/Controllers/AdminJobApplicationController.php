<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminJobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $status = trim((string) $request->query('status', ''));

        $applications = JobApplication::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($sub) use ($search) {
                    $sub->where('full_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('position_title', 'like', "%{$search}%");
                });
            })
            ->when(in_array($status, ['new', 'reviewed', 'shortlisted', 'rejected', 'hired'], true), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.applicants.index', compact('applications', 'search', 'status'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,reviewed,shortlisted,rejected,hired'],
        ]);

        $application->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.applicants.index')
            ->with('success', 'Applicant status updated.');
    }

    public function resume(JobApplication $application)
    {
        if (!$application->resume_path || !Storage::disk('public')->exists($application->resume_path)) {
            return redirect()
                ->route('admin.applicants.index')
                ->with('error', 'Resume file not found.');
        }

        return Storage::disk('public')->download(
            $application->resume_path,
            'resume-' . $application->id . '.pdf'
        );
    }
}
