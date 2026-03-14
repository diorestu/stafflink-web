<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContractNumberService
{
    /**
     * Generate contract number in format: XXX/HR-PKWTT/VIII/2026
     * XXX = 3-digit sequence number
     * HR-PKWTT = Fixed prefix
     * VIII = Month in Roman numerals
     * 2026 = Year
     */
    public static function generate($contractType = 'PKWTT')
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $monthRoman = self::toRomanNumeral($month);
        
        // Get the next sequence number for this month/year
        $sequenceNumber = self::getNextSequenceNumber($year, $month, $contractType);
        
        return sprintf(
            '%03d/HR-%s/%s/%d',
            $sequenceNumber,
            $contractType,
            $monthRoman,
            $year
        );
    }

    /**
     * Get the next sequence number for the given month/year/contract type
     */
    private static function getNextSequenceNumber($year, $month, $contractType)
    {
        $key = "contract_counter_{$year}_{$month}_{$contractType}";
        
        // Get current value from cache/database
        $lastNumber = DB::table('contract_counter')
            ->where('year', $year)
            ->where('month', $month)
            ->where('contract_type', $contractType)
            ->first();
        
        if ($lastNumber) {
            $nextNumber = $lastNumber->sequence + 1;
            DB::table('contract_counter')
                ->where('id', $lastNumber->id)
                ->update(['sequence' => $nextNumber]);
        } else {
            $nextNumber = 1;
            DB::table('contract_counter')->insert([
                'year' => $year,
                'month' => $month,
                'contract_type' => $contractType,
                'sequence' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        return $nextNumber;
    }

    /**
     * Convert month number to Roman numeral
     */
    private static function toRomanNumeral($num)
    {
        $romanNumerals = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];
        
        return $romanNumerals[$num] ?? '';
    }
}
