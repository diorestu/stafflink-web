<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if (filled($request->input('website'))) {
            return redirect()
                ->route('contact')
                ->with('success', 'Inquiry submitted successfully. Our team will contact you shortly.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:50'],
            'company_name' => ['required', 'string', 'max:190'],
            'company_size' => ['required', 'in:1-10 Employees,11-50 Employees,51-200 Employees,201-500 Employees,500+ Employees'],
            'preferred_call_time' => ['nullable', 'in:9:00 AM,10:00 AM,11:00 AM,1:00 PM,3:00 PM'],
            'preferred_call_date' => ['nullable', 'date'],
            'message' => ['nullable', 'string', 'max:4000'],
        ]);

        ContactInquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company_name' => $validated['company_name'],
            'company_size' => $validated['company_size'],
            'preferred_call_time' => $validated['preferred_call_time'] ?? null,
            'preferred_call_date' => $validated['preferred_call_date'] ?? null,
            'message' => $validated['message'] ?? null,
            'submitted_from_ip' => $request->ip(),
            'submitted_user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Inquiry submitted successfully. Our team will contact you shortly.');
    }
}
