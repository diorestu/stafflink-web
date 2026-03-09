<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class NannyInquiryWeddingCsv
{
    public static function groupKey(string $coupleNames, string $weddingDate, ?string $uniqueCode = null): string
    {
        $normalizedCode = Str::of((string) $uniqueCode)
            ->upper()
            ->replaceMatches('/[^A-Z0-9]+/', '')
            ->value();

        if ($normalizedCode !== '') {
            return md5('code|'.$normalizedCode);
        }

        $normalizedNames = Str::of($coupleNames)
            ->lower()
            ->replaceMatches('/[^\pL\pN]+/u', ' ')
            ->squish()
            ->value();

        return md5($normalizedNames.'|'.$weddingDate);
    }

    /**
     * @param  Collection<int, \App\Models\NannyInquiry>  $inquiries
     * @return array{filename:string,content:string,total_children:int,total_nannies:int}
     */
    public static function build(Collection $inquiries): array
    {
        if ($inquiries->isEmpty()) {
            return [
                'filename' => 'wedding_nanny_bookings.csv',
                'content' => '',
                'total_children' => 0,
                'total_nannies' => 0,
            ];
        }

        $first = $inquiries->first();
        $weddingDate = (string) optional($first->wedding_date)->format('Y-m-d');
        $slugBase = Str::slug((string) ($first->wedding_couple_names ?: 'wedding'));
        $codeSuffix = Str::of((string) ($first->unique_code ?? ''))
            ->lower()
            ->replaceMatches('/[^a-z0-9]+/', '-')
            ->trim('-')
            ->value();
        $filenameBase = trim(($weddingDate !== '' ? $weddingDate.'_' : '').$slugBase, '_');
        if ($codeSuffix !== '') {
            $filenameBase .= '_'.$codeSuffix;
        }
        $filename = trim($filenameBase, '_').'_nanny_bookings.csv';

        $rows = [[
            'Wedding Of',
            'Unique Code',
            'Wedding Date',
            'Wedding Start Time',
            'Wedding Location Address',
            'Hotel/Villa Venue Name',
            'Guest Parent/Guardian',
            'Guest Email',
            'Guest Phone',
            'Children Count',
            'Nannies Needed',
            'Children Details',
            'Accommodation Option',
            'Accommodation Detail',
            'Ceremony Service',
            'Additional Hours',
            'Submitted At (UTC+8)',
        ]];

        $totalChildren = 0;
        $totalNannies = 0;
        foreach ($inquiries as $inquiry) {
            $children = collect($inquiry->children ?? [])->values();
            $childrenDetails = $children->map(function (array $child, int $index): string {
                $special = trim((string) ($child['special_requirement'] ?? ''));

                return 'Child '.($index + 1).': '
                    .'Name '.trim((string) ($child['name'] ?? '-')).', '
                    .'Age '.trim((string) ($child['age'] ?? '-')).', '
                    .'Special '.($special !== '' ? $special : '-');
            })->implode(' | ');

            $countValue = (string) ($inquiry->children_count ?? '0');
            $totalChildren += $countValue === '4+' ? 4 : (int) $countValue;
            $nanniesRequired = (string) ($inquiry->nannies_required ?? '0');
            $totalNannies += $nanniesRequired === '5+' ? 5 : (int) $nanniesRequired;

            $rows[] = [
                (string) ($inquiry->wedding_couple_names ?? ''),
                (string) ($inquiry->unique_code ?? ''),
                (string) optional($inquiry->wedding_date)->format('Y-m-d'),
                (string) ($inquiry->wedding_start_time ?? ''),
                (string) ($inquiry->wedding_location_address ?? ''),
                (string) ($inquiry->wedding_venue_name ?? ''),
                (string) ($inquiry->guardian_name ?? ''),
                (string) ($inquiry->guardian_email ?? ''),
                (string) ($inquiry->guardian_phone ?? ''),
                $countValue,
                $nanniesRequired,
                $childrenDetails,
                $inquiry->accommodation_location_option === 'prior' ? 'Prior to wedding' : 'At the wedding',
                (string) ($inquiry->accommodation_detail ?? ''),
                $inquiry->ceremony_service_choice === 'yes' ? 'Subsidized hour' : 'Self paid',
                (string) ($inquiry->additional_hours ?? ''),
                (string) optional($inquiry->created_at)->timezone('+08:00')->format('Y-m-d H:i'),
            ];
        }

        $csv = self::toCsv($rows);

        return [
            'filename' => $filename,
            'content' => $csv,
            'total_children' => $totalChildren,
            'total_nannies' => $totalNannies,
        ];
    }

    /**
     * @param  array<int, array<int, string>>  $rows
     */
    private static function toCsv(array $rows): string
    {
        $stream = fopen('php://temp', 'r+');
        if ($stream === false) {
            return '';
        }

        foreach ($rows as $row) {
            fputcsv($stream, $row);
        }

        rewind($stream);
        $content = stream_get_contents($stream);
        fclose($stream);

        return $content === false ? '' : $content;
    }
}
