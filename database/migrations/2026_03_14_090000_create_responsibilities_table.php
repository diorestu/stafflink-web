<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('responsibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->constrained('positions')->cascadeOnDelete();
            $table->string('title_id', 255);
            $table->text('description_id')->nullable();
            $table->string('title_en', 255);
            $table->text('description_en')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['position_id', 'is_active']);
            $table->index('title_id');
            $table->index('title_en');
        });

        $positions = DB::table('positions')
            ->select('id')
            ->where('is_active', true)
            ->get();

        if ($positions->isEmpty()) {
            return;
        }

        $defaults = [
            [
                'title_id' => 'Interaksi dengan Klien',
                'description_id' => 'Berinteraksi dengan keluarga terkait pembayaran, pemesanan, dan koordinasi layanan.',
                'title_en' => 'Client Engagement',
                'description_en' => 'Engage with families regarding payments, bookings, and service coordination.',
            ],
            [
                'title_id' => 'Onboarding Staf',
                'description_id' => 'Menangani proses onboarding staf baru untuk Perusahaan serta klien dan mitra bisnis.',
                'title_en' => 'Staff Onboarding',
                'description_en' => 'Handle onboarding of new staff for the Company and for its clients and business partners.',
            ],
            [
                'title_id' => 'Integritas & Kepatuhan Keuangan',
                'description_id' => 'Mengelola keuangan dan penagihan secara akurat serta melaporkan aktivitas mencurigakan.',
                'title_en' => 'Financial Integrity & Compliance',
                'description_en' => 'Maintain company finances and invoicing accurately and report suspicious activity.',
            ],
            [
                'title_id' => 'Penagihan & Pelacakan Pembayaran',
                'description_id' => 'Membuat invoice, memantau pembayaran masuk, dan menjaga akun tetap mutakhir.',
                'title_en' => 'Invoicing & Payment Tracking',
                'description_en' => 'Generate invoices, monitor incoming payments, and keep accounts updated.',
            ],
        ];

        $legacyPath = storage_path('app/contracts/responsibilities.json');
        if (File::exists($legacyPath)) {
            $decoded = json_decode((string) File::get($legacyPath), true);
            if (is_array($decoded) && $decoded !== []) {
                $normalized = [];
                foreach ($decoded as $item) {
                    if (! is_array($item)) {
                        continue;
                    }

                    $titleId = trim((string) ($item['title_id'] ?? ''));
                    $titleEn = trim((string) ($item['title_en'] ?? ($item['title'] ?? '')));
                    $descId = trim((string) ($item['description_id'] ?? ''));
                    $descEn = trim((string) ($item['description_en'] ?? ($item['description'] ?? '')));

                    if ($titleId === '' && $titleEn === '') {
                        continue;
                    }

                    if ($titleId === '') {
                        $titleId = $titleEn;
                    }

                    if ($titleEn === '') {
                        $titleEn = $titleId;
                    }

                    $normalized[] = [
                        'title_id' => $titleId,
                        'description_id' => $descId,
                        'title_en' => $titleEn,
                        'description_en' => $descEn,
                    ];
                }

                if ($normalized !== []) {
                    $defaults = $normalized;
                }
            }
        }

        $rows = [];
        $now = now();
        foreach ($positions as $position) {
            foreach ($defaults as $item) {
                $rows[] = [
                    'position_id' => (int) $position->id,
                    'title_id' => (string) $item['title_id'],
                    'description_id' => (string) ($item['description_id'] ?? ''),
                    'title_en' => (string) $item['title_en'],
                    'description_en' => (string) ($item['description_en'] ?? ''),
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        if ($rows !== []) {
            DB::table('responsibilities')->insert($rows);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('responsibilities');
    }
};
