<?php

namespace Database\Seeders;

use App\Services\LocationSyncService;
use Illuminate\Database\Seeder;
use RuntimeException;
use Throwable;

class CountryStateSeeder extends Seeder
{
    /**
     * Seed countries and states using local snapshot, with API fallback.
     */
    public function run(): void
    {
        /** @var LocationSyncService $locationSyncService */
        $locationSyncService = app(LocationSyncService::class);

        try {
            // Force fresh fetch so seeding reflects latest global country/state data.
            $result = $locationSyncService->sync(false);

            $this->command?->info(
                "Countries seeded: {$result['countries']}, States seeded: {$result['states']}"
            );
        } catch (Throwable $e) {
            throw new RuntimeException(
                'Country/state seeding failed. Verify snapshot path or API credentials. '
                . $e->getMessage(),
                previous: $e
            );
        }
    }
}
