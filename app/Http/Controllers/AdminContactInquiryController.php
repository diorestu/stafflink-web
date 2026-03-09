<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminContactInquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $inquiries = ContactInquiry::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($sub) use ($search): void {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('company_name', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.contact-inquiries.index', [
            'inquiries' => $inquiries,
            'search' => $search,
        ]);
    }

    public function destroy(ContactInquiry $contactInquiry): RedirectResponse
    {
        $contactInquiry->delete();

        return redirect()
            ->route('admin.contact-inquiries.index')
            ->with('success', 'Contact inquiry deleted.');
    }
}
