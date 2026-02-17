<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return $this->document($application, 'resume');
    }

    public function document(JobApplication $application, string $type)
    {
        $map = [
            'resume' => ['column' => 'resume_path', 'name' => 'resume'],
            'id_ktp' => ['column' => 'id_ktp_path', 'name' => 'id-ktp'],
            'skck' => ['column' => 'skck_path', 'name' => 'skck'],
            'cover_letter' => ['column' => 'cover_letter_file_path', 'name' => 'cover-letter'],
            'portfolio' => ['column' => 'portfolio_file_path', 'name' => 'portfolio'],
        ];

        if (!isset($map[$type])) {
            return redirect()
                ->route('admin.applicants.index')
                ->with('error', 'Document type is invalid.');
        }

        $column = $map[$type]['column'];
        $path = (string) ($application->{$column} ?? '');

        if ($path === '' || !Storage::disk('public')->exists($path)) {
            return redirect()
                ->route('admin.applicants.index')
                ->with('error', 'Document file not found.');
        }

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $filename = $map[$type]['name'] . '-' . $application->id;
        if ($extension !== '') {
            $filename .= '.' . Str::lower($extension);
        }

        return Storage::disk('public')->download($path, $filename);
    }
}
