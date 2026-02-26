<?php

namespace App\Http\Controllers;

use App\Support\PageWording;
use Illuminate\Http\Request;

class AdminPageWordingController extends Controller
{
    public function edit()
    {
        $wordings = PageWording::all();

        return view('admin.page-wording.edit', [
            'wordings' => $wordings,
            'pageKeys' => PageWording::pageKeys(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'wordings' => ['required', 'array'],
            'wordings.*' => ['nullable', 'string'],
        ]);

        $payload = [];

        foreach (($validated['wordings'] ?? []) as $pageKey => $json) {
            $decoded = json_decode((string) $json, true);

            if (is_array($decoded)) {
                $payload[$pageKey] = $decoded;
            }
        }

        PageWording::update($payload);

        return redirect()
            ->route('admin.page-wording.edit')
            ->with('success', 'Page wording updated successfully.');
    }
}
