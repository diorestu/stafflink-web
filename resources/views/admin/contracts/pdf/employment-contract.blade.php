<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ ($data['selected_template'] ?? 'fixed_term_pkwt') === 'fixed_term_pkwt' ? 'PKWT Contract' : 'PKWTT Contract' }}</title>
    @php
        $bookAntiquaAvailable =
            is_file(public_path('fonts/BookAntiqua.ttf')) &&
            is_file(public_path('fonts/BookAntiqua-Italic.ttf')) &&
            is_file(public_path('fonts/BookAntiqua-Bold.ttf')) &&
            is_file(public_path('fonts/BookAntiqua-BoldItalic.ttf'));
    @endphp
    <style>
        @if ($bookAntiquaAvailable)
        @font-face {
            font-family: 'BookAntiquaPdf';
            font-style: normal;
            font-weight: 400;
            src: url('{{ public_path('fonts/BookAntiqua.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'BookAntiquaPdf';
            font-style: italic;
            font-weight: 400;
            src: url('{{ public_path('fonts/BookAntiqua-Italic.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'BookAntiquaPdf';
            font-style: normal;
            font-weight: 700;
            src: url('{{ public_path('fonts/BookAntiqua-Bold.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'BookAntiquaPdf';
            font-style: italic;
            font-weight: 700;
            src: url('{{ public_path('fonts/BookAntiqua-BoldItalic.ttf') }}') format('truetype');
        }
        @endif

        @page { margin: 0; }
        body {
            margin: 0;
            padding: 178px 0.5in 82px 1.15in;
            font-family: {{ $bookAntiquaAvailable ? "'bookantiquapdf', 'Book Antiqua', 'Palatino Linotype', Palatino, serif" : "'DejaVu Serif', serif" }};
            font-size: 12px;
            color: #1f2937;
            line-height: 1.45;
            text-align: justify;
        }
        body, p, li, td, h1, h2, h3, h4, h5, h6, span, div {
            font-family: {{ $bookAntiquaAvailable ? "'bookantiquapdf', 'Book Antiqua', 'Palatino Linotype', Palatino, serif" : "'DejaVu Serif', serif" }};
        }
        header { position: fixed; top: 0; left: 0; right: 0; height: 138px; }
        footer { position: fixed; bottom: 0; left: 0; right: 0; height: 42px; }
        .letterhead { width: 100%; height: 138px; object-fit: cover; object-position: top; }
        .page-number {
            position: absolute;
            left: 22px;
            bottom: 12px;
            font-size: 10px;
            color: #374151;
        }
        .page-number::after {
            content: "Page " counter(page);
        }
        h1 {
            font-size: 14px;
            text-align: left;
            margin: 0 0 4px;
            text-decoration: underline;
            font-weight: 700;
        }
        .title-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .title-table td {
            vertical-align: top;
        }
        .title-logo-cell {
            width: 170px;
            padding-right: 14px;
        }
        .title-logo {
            width: 160px;
            height: auto;
            display: block;
        }
        h2 { font-size: 11px; margin: 12px 0 5px; border-bottom: 1px solid #d1d5db; padding-bottom: 2px; }
        .article-head {
            margin: 0.2in 0 8px;
            text-align: center;
        }
        .article-number {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;
        }
        .article-title {
            margin: 0;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            line-height: 1.25;
            text-align: center;
        }
        p { margin: 0 0 7px; text-align: justify; }
        li, td { text-align: justify; }
        .meta { font-size: 12px; text-align: center; color: #1f2937; margin-bottom: 8px; }
        .party-section { margin-bottom: 10px; margin-left: 0; }
        .party-title { font-weight: 400; margin-bottom: 2px; }
        .party-identity-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 24px;
        }
        .party-identity-table td {
            vertical-align: top;
            padding: 0;
            line-height: 1.2;
        }
        .party-identity-no {
            width: 20px;
            padding-right: 8px;
        }
        .party-identity-label {
            width: 260px;
            padding-right: 8px;
        }
        .party-identity-label em {
            font-style: italic;
        }
        .party-identity-colon {
            width: 14px;
            text-align: center;
        }
        .party-identity-value {
            width: auto;
        }
        .label { font-weight: 700; }
        .small { font-size: 9.5px; color: #6b7280; }
        ul { margin: 0 0 7px 22px; padding: 0; }
        li { margin-bottom: 4px; margin-left: 50px; }
        .signature { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .signature td { width: 50%; vertical-align: top; padding-right: 14px; }
        .line { margin-top: 40px; border-top: 1px solid #111827; width: 92%; }
        .text-center{ text-align: center; }
        .page-break {
            page-break-after: always;
        }
        .role-highlights {
            margin: 6px 0 10px;
            line-height: 1.15;
        }
        .role-highlights p {
            margin: 0 0 6px;
        }
        .role-highlights-columns {
            width: 100%;
            border-collapse: collapse;
        }
        .role-highlights-columns td {
            width: 50%;
            vertical-align: top;
            padding-right: 16px;
        }
        .role-highlights-columns ul {
            margin: 0 0 0 20px;
            padding: 0;
        }
        .role-highlights-columns li {
            margin-bottom: 4px;
            margin-left: 10px;
            line-height: 1.15;
        }
        ol.alpha-list { margin: 0 0 7px 26px; padding: 0; list-style-type: lower-alpha; }
        ol.alpha-list li { margin-bottom: 4px; }
        p.ayat-label { font-weight: 700; margin: 10px 0 2px; text-indent: 0; }
        p.para-label { font-style: italic; font-weight: 700; margin: 3px 0 2px; text-indent: 0; }
        p.ayat-label + p,
        p.para-label + p {
            margin-left: 1in;
        }
        p.ayat-label + ul,
        p.para-label + ul,
        p.ayat-label + ol,
        p.para-label + ol {
            margin-left: 1in;
        }
    </style>
</head>
<body>
    <header>
        @if ($data['header_image'])
            <img src="{{ $data['header_image'] }}" class="letterhead" alt="Header">
        @endif
    </header>

    <footer>
        <div class="page-number"></div>
    </footer>

    <table class="title-table">
        <tr>
            <td class="title-logo-cell">
                @if ($data['logo_image'])
                    <img src="{{ $data['logo_image'] }}" class="title-logo" alt="Staff Link Logo">
                @endif
            </td>
            <td>
                <h1 class="text-center">SURAT PERJANJIAN KERJA KONTRAK {{ ($data['selected_template'] ?? 'fixed_term_pkwt') === 'fixed_term_pkwt' ? 'PKWT' : 'PKWTT' }}/ <em>CONTRACT {{ strtoupper($data['contract_type_en']) }} EMPLOYMENT AGREEMENT</em></h1>
            </td>
        </tr>
    </table>
    <p class="meta">
        @if ($data['contract_number'] !== '')
            Nomor: {{ $data['contract_number'] }}<br>
        @endif
    </p>

    <div class="party-section">
        <p class="party-title">Yang bertanda tangan di bawah ini / <em>The undersigned:</em></p>
        <table class="party-identity-table">
            <tr>
                <td class="party-identity-no">1.</td>
                <td class="party-identity-label">Nama / <em>Name</em></td>
                <td class="party-identity-colon">:</td>
                <td class="party-identity-value">{{ $data['company_name'] }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="party-identity-label">Alamat / <em>Address</em></td>
                <td class="party-identity-colon">:</td>
                <td class="party-identity-value">{{ $data['first_party_address'] }}</td>
            </tr>
        </table>
        <p><em>In this matter acting for and on behalf of {{ $data['company_name'] }} with registered address at {{ $data['company_address'] }}, hereinafter referred to as <strong>The Employer</strong>.</em></p>
    </div>

    <div class="party-section">
        <table class="party-identity-table">
            <tr>
                <td class="party-identity-no">2.</td>
                <td class="party-identity-label">Nama / <em>Name</em></td>
                <td class="party-identity-colon">:</td>
                <td class="party-identity-value">{{ trim(($data['employee_title'] ? $data['employee_title'].' ' : '').$data['employee_name']) }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="party-identity-label">Tempat dan tanggal lahir / <em>DoB</em></td>
                <td class="party-identity-colon">:</td>
                <td class="party-identity-value">{{ $data['employee_birth_info'] ?: '-' }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="party-identity-label">Jenis kelamin / <em>Gender</em></td>
                <td class="party-identity-colon">:</td>
                <td class="party-identity-value">{{ $data['employee_gender'] ?: '-' }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="party-identity-label">Agama / <em>Religion</em></td>
                <td class="party-identity-colon">:</td>
                <td class="party-identity-value">{{ $data['employee_religion'] ?: '-' }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="party-identity-label">Alamat / <em>Address</em></td>
                <td class="party-identity-colon">:</td>
                <td class="party-identity-value">{{ $data['employee_address'] ?: '-' }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="party-identity-label">No. KTP / SIM / <em>ID Card</em></td>
                <td class="party-identity-colon">:</td>
                <td class="party-identity-value">{{ $data['employee_id_number'] ?: '-' }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="party-identity-label">Telepon / <em>Phone Number</em></td>
                <td class="party-identity-colon">:</td>
                <td class="party-identity-value">{{ $data['employee_phone'] ?: '-' }}</td>
            </tr>
        </table>
        <p><em> In this matter, acting for and on behalf of himself/herself as the employee and hereinafter referred to as the Employee. Both parties agree to enter into this Agreement under the following terms and conditions:</em></p>
        <br/>
        <p>Kedua belah pihak setuju untuk membuat Perjanjian ini berdasarkan syarat dan ketentuan sebagai berikut:</p>
        <p><em>Both parties agree to enter into this Agreement under the following terms and conditions:</em></p>
    </div>
    <br/>

    <p><strong><em>For the position title of: {{ $data['position_title'] }}</em></strong></p>
    <p><em>For clarity the role covers but not limited to:</em></p>
    @php
        $roleBriefRaw = trim((string) ($data['role_brief_points'] ?? ''));
        $roleHighlightItems = [];

        if ($roleBriefRaw !== '' && preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $roleBriefRaw, $matches)) {
            foreach ($matches[1] as $match) {
                $item = trim(html_entity_decode(strip_tags($match), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                if ($item !== '') {
                    $roleHighlightItems[] = $item;
                }
            }
        }

        $roleHighlightLeft = array_slice($roleHighlightItems, 0, 4);
        $roleHighlightRight = array_slice($roleHighlightItems, 4);
    @endphp
    @if ($roleBriefRaw !== '' && $roleBriefRaw !== '<p><br></p>')
        <div class="role-highlights">
            @if (count($roleHighlightItems) > 0)
                <table class="role-highlights-columns">
                    <tr>
                        <td>
                            <ul>
                                @foreach ($roleHighlightLeft as $item)
                                    <li><em>{{ $item }}</em></li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @if (count($roleHighlightRight) > 0)
                                <ul>
                                    @foreach ($roleHighlightRight as $item)
                                        <li><em>{{ $item }}</em></li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                    </tr>
                </table>
            @else
                {!! $roleBriefRaw !!}
            @endif
        </div>
    @endif

    <div class="page-break"></div>
    <div class="article-head">
        <p class="article-number"><em>BACKGROUND</em></p>
        <p><em>A. The Employer has agreed to employ the Employee, and the Employee has agreed to work for the Employer in the position described in this Agreement and the Schedule.</em></p>
        <p><em>B. The Employer and the Employee have agreed to enter into this Contract to record the terms and conditions of the employment relationship.</em></p>
        <p><em>C. The Employer acknowledges its obligation to apply applicable employment protections to the Employee and to comply with the provisions of relevant Indonesian legislation.</em></p>
        <p><em>D. The Employer and Employee agree that the following terms shall have the meanings set out below:</em></p>
        <p><em><strong>Affiliate</strong> means any entity that directly or indirectly controls, is controlled by, or is under common control with the Employer, including but not limited to subsidiaries, parent companies, and entities with shared ownership or management, whether incorporated in Indonesia or elsewhere.</em></p>
        <p><em><strong>Confidential Information</strong> means all information, whether written, oral, electronic, or otherwise, relating to the business, operations, clients, staff, finances, pricing, trade secrets, Intellectual Property, systems, processes, marketing strategies, business plans, personal data, or any other proprietary or sensitive information of the Employer, its Affiliates, or its clients, whether disclosed before or after the commencement of this Contract.</em></p>
        <p><em>Confidential Information does not include information that is publicly available other than through a breach of this Contract or applicable law.</em></p>
        <p><em><strong>Contract</strong> means this employment agreement, including all schedules, appendices, and any written amendments made in accordance with Indonesian law.</em></p>
        <p><em><strong>Intellectual Property</strong> means all intellectual property rights recognised under the laws of {{ $data['governing_law'] }} and international conventions to which Indonesia is a party, including but not limited to copyrights, trademarks, service marks, patents, industrial designs, trade secrets, confidential information, know-how, business methods, databases, software, documentation, and any improvements or derivatives thereof, whether registered or unregistered.</em></p>
        <p><em><strong>Moral Rights</strong> means the rights of attribution and integrity recognised under applicable Indonesian copyright law.</em></p>
        <p><em>The Employee acknowledges these rights and agrees not to exercise such rights in a manner that interferes with the Employer's lawful use, modification, publication, or exploitation of the Works to the maximum extent permitted by Indonesian law.</em></p>
        <p><em><strong>Applicable Law</strong> means all laws and regulations of {{ $data['governing_law'] }}, including but not limited to:</em></p>
        <ul style="list-style-type: lower-alpha; margin-left: 20px; text-align: left;">
            <li style="margin-left: 30px;"><em>laws governing employment and manpower;</em></li>
            <li style="margin-left: 30px;"><em>laws governing intellectual property;</em></li>
            <li style="margin-left: 30px;"><em>data protection and privacy regulations; and</em></li>
            <li style="margin-left: 30px;"><em>implementing regulations, as amended from time to time.</em></li>
        </ul>
        <p><em><strong>Works</strong> means all works, materials, inventions, concepts, designs, documents, reports, software, content, systems, processes, improvements, data, and other materials created, developed, or contributed to by the Employee, whether alone or jointly with others, during the course of employment and in connection with the Employer's business, regardless of form or medium.</em></p>
    </div>
    <div class="article-head">
        <p class="article-number">LATAR BELAKANG</p>
        <p>A. Pemberi Kerja telah sepakat untuk mempekerjakan Karyawan, dan Karyawan telah sepakat untuk bekerja bagi Pemberi Kerja pada posisi sebagaimana tercantum dalam Perjanjian ini dan Jadwal.</p>
        <p>B. Pemberi Kerja dan Karyawan sepakat untuk mengikatkan diri dalam Kontrak ini guna mencatat dan mengatur syarat serta ketentuan hubungan kerja para pihak.</p>
        <p>C. Pemberi Kerja mengakui kewajibannya untuk menerapkan perlindungan ketenagakerjaan yang berlaku kepada Karyawan serta untuk mematuhi peraturan perundang-undangan yang relevan di Republik Indonesia.</p>
        <p>D. Pemberi Kerja dan Karyawan sepakat bahwa istilah-istilah berikut memiliki arti sebagaimana dimaksud di bawah ini:</p>
        <p><strong>Afiliasi</strong> berarti setiap entitas yang secara langsung atau tidak langsung mengendalikan, dikendalikan oleh, atau berada di bawah pengendalian yang sama dengan Pemberi Kerja, termasuk namun tidak terbatas pada anak perusahaan, perusahaan induk, serta entitas dengan kepemilikan atau manajemen yang sama, baik yang didirikan di Indonesia maupun di yurisdiksi lain.</p>
        <p><strong>Informasi Rahasia</strong> berarti seluruh informasi, baik tertulis, lisan, elektronik, atau dalam bentuk lainnya, yang berkaitan dengan usaha, operasional, klien, staf, keuangan, harga, rahasia dagang, Hak Kekayaan Intelektual, sistem, proses, strategi pemasaran, rencana bisnis, data pribadi, atau informasi lain yang bersifat kepemilikan atau sensitif milik Pemberi Kerja, Afiliasinya, atau kliennya, baik yang diungkapkan sebelum maupun setelah berlakunya Kontrak ini.</p>
        <p>Informasi Rahasia tidak termasuk informasi yang telah tersedia untuk umum kecuali jika ketersediaan tersebut terjadi akibat pelanggaran terhadap Kontrak ini atau hukum yang berlaku.</p>
        <p><strong>Kontrak</strong> berarti perjanjian kerja ini, termasuk seluruh jadwal, lampiran, dan setiap perubahan tertulis yang dibuat sesuai dengan hukum yang berlaku di Republik Indonesia.</p>
        <p><strong>Hak Kekayaan Intelektual</strong> berarti seluruh hak kekayaan intelektual yang diakui berdasarkan hukum Republik Indonesia dan konvensi internasional yang diikuti oleh Indonesia, termasuk namun tidak terbatas pada hak cipta, merek, merek jasa, paten, desain industri, rahasia dagang, informasi rahasia, pengetahuan teknis (<em>know-how</em>), metode bisnis, basis data, perangkat lunak, dokumentasi, serta setiap pengembangan atau karya turunan darinya, baik yang terdaftar maupun tidak terdaftar.</p>
        <p><strong>Hak Moral</strong> berarti hak pencantuman nama dan hak atas keutuhan ciptaan sebagaimana diakui berdasarkan hukum hak cipta Indonesia yang berlaku.</p>
        <p>Karyawan mengakui hak-hak tersebut dan setuju untuk tidak menggunakan Hak Moral dengan cara apa pun yang dapat mengganggu penggunaan, perubahan, publikasi, atau pemanfaatan Ciptaan oleh Pemberi Kerja secara sah, sejauh diizinkan oleh hukum Republik Indonesia.</p>
        <p><strong>Hukum yang Berlaku</strong> berarti seluruh peraturan perundang-undangan Republik Indonesia, termasuk namun tidak terbatas pada:</p>
        <ul style="list-style-type: lower-alpha; margin-left: 20px; text-align: left;">
            <li style="margin-left: 30px;">peraturan perundang-undangan di bidang ketenagakerjaan;</li>
            <li style="margin-left: 30px;">peraturan perundang-undangan di bidang hak kekayaan intelektual;</li>
            <li style="margin-left: 30px;">peraturan perlindungan data dan privasi; dan</li>
            <li style="margin-left: 30px;">serta peraturan pelaksanaannya sebagaimana diubah dari waktu ke waktu.</li>
        </ul>
        <p><strong>Ciptaan</strong> berarti seluruh karya, materi, penemuan, konsep, desain, dokumen, laporan, perangkat lunak, konten, sistem, proses, pengembangan, data, dan materi lainnya yang dibuat, dikembangkan, atau dikontribusikan oleh Karyawan, baik secara sendiri maupun bersama pihak lain, selama masa hubungan kerja dan sehubungan dengan usaha Pemberi Kerja, tanpa memperhatikan bentuk atau media apa pun.</p>
    </div>
    <!-- <div class="page-break"></div> -->
    <div class="article-head">
        <p class="article-number">PASAL 1 / <em>ARTICLE 1</em></p>
        <p class="article-title">MASA KERJA / <em>EMPLOYMENT PERIOD</em></p>
    </div>

    <p class="ayat-label">Ayat 1</p>
    <p>PIHAK PERTAMA dengan ini menyatakan menerima PIHAK KEDUA sebagai
        @if ($data['selected_template'] === 'fixed_term_pkwt')
            karyawan kontrak (Perjanjian Kerja Waktu Tertentu/PKWT)
        @else
            karyawan tetap (Perjanjian Kerja Waktu Tidak Tertentu/PKWTT)
        @endif
        pada perusahaan {{ $data['company_name'] }} yang berkedudukan di {{ $data['first_party_address'] }}, dan PIHAK KEDUA dengan ini menyatakan kesediaannya untuk menerima dan melaksanakan pekerjaan tersebut sesuai dengan ketentuan dalam Perjanjian ini.</p>
    <p class="para-label">Paragraph 1</p>
    <p><em>The Employer hereby declares its acceptance of the Employee as a
        @if ($data['selected_template'] === 'fixed_term_pkwt')
            fixed-term contract employee under a Fixed-Term Employment Agreement (PKWT)
        @else
            permanent employee under an Indefinite-Term Employment Agreement (PKWTT)
        @endif
        at {{ $data['company_name'] }}, having its registered address at {{ $data['first_party_address'] }}, and the Employee hereby declares his/her willingness to accept and perform the employment in accordance with the terms and conditions set forth in this Agreement.</em></p>

    <p class="ayat-label">Ayat 2</p>
    <p>Perjanjian kerja ini merupakan
        @if ($data['selected_template'] === 'fixed_term_pkwt')
            Perjanjian Kerja Waktu Tertentu (PKWT) yang mulai berlaku sejak tanggal {{ $data['start_date_id'] }} sampai {{ $data['end_date_id'] }}, kecuali diperpanjang atau diakhiri sesuai ketentuan Perjanjian ini dan peraturan perundang-undangan yang berlaku.
        @else
            Perjanjian Kerja Waktu Tidak Tertentu (PKWTT) yang mulai berlaku sejak tanggal {{ $data['start_date_id'] }} dan tetap berlaku sampai diakhiri sesuai dengan ketentuan dalam Perjanjian ini dan peraturan perundang-undangan yang berlaku.
        @endif
        Evaluasi kinerja akan dilakukan secara berkala oleh Direktur.</p>
    <p class="para-label">Paragraph 2</p>
    <p><em>This Employment Agreement constitutes a
        @if ($data['selected_template'] === 'fixed_term_pkwt')
            Fixed-Term Employment Agreement (PKWT) commencing on {{ $data['start_date'] }} and shall remain in effect until {{ $data['end_date'] }}, unless lawfully extended or terminated in accordance with this Agreement and the applicable laws and regulations.
        @else
            Indefinite-Term Employment Agreement (PKWTT) commencing on {{ $data['start_date'] }} and shall remain in effect until terminated in accordance with this Agreement and the applicable laws and regulations.
        @endif
        Performance evaluations shall be conducted periodically by the Director.</em></p>
    <p><em>The first {{ $data['probation_months'] }} month(s) shall constitute a trial period. During this time, either party may terminate the employment with immediate effect if the performance is deemed unsatisfactory.</em></p>
    <p>{{ $data['probation_months'] }} bulan pertama merupakan masa percobaan. Selama masa ini, masing-masing pihak dapat mengakhiri hubungan kerja secara langsung apabila kinerja dianggap tidak memuaskan.</p>

    <p class="ayat-label">Ayat 3</p>
    <p>Selama jangka waktu tersebut masing-masing pihak dapat memutuskan hubungan kerja dengan pemberitahuan secara tertulis minimal {{ $data['notice_period_days'] }} hari kerja.</p>
    <p class="para-label">Paragraph 3</p>
    <p><em>During the term of this Agreement, either party may terminate the employment relationship by providing written notice at least {{ $data['notice_period_days'] }} days in advance.</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 2 / <em>ARTICLE 2</em></p>
        <p class="article-title">MULAI BEKERJA DAN PERNYATAAN JAMINAN / <em>COMMENCEMENT AND WARRANTIES</em></p>
    </div>
    <p><em>Your date of commencement of employment with the Employer is identified at 1 of the Schedule.</em></p>
    <p><em>The terms and conditions of the Employee's employment shall be governed by this Contract and applicable laws and regulations of {{ $data['governing_law'] }}, including employment and manpower regulations, as amended from time to time.</em></p>
    <p><em>The Employee represents and warrants that:</em></p>
    <ol class="alpha-list">
        <li><em>the Employee possesses the qualifications, skills, experience, and competence as represented to the Employer and required to perform the role;</em></li>
        <li><em>the Employee has fully disclosed to the Employer any restriction, obligation, or legal limitation (including but not limited to non-competition obligations, prior agreements, medical conditions affecting work, or immigration restrictions) that may affect the Employee's ability to perform their duties;</em></li>
        <li><em>the Employee enters into this Contract voluntarily, of their own free will, without coercion, pressure, or undue influence from any party;</em></li>
        <li><em>the Employee is legally entitled to work in {{ $data['governing_law'] }} and agrees to provide valid and accurate documentation upon request by the Employer, including but not limited to identity documents, residency permits, and work authorization as required by Indonesian law;</em></li>
        <li><em>the Employee holds and shall maintain all licences, permits, certifications, and qualifications required to lawfully and properly perform their duties throughout the term of employment.</em></li>
    </ol>
    <p>Tanggal mulai kerja Karyawan dengan Pemberi Kerja sebagaimana tercantum dalam Butir 1 Jadwal (Schedule).</p>
    <p>Syarat dan ketentuan hubungan kerja Karyawan diatur oleh Kontrak ini dan peraturan perundang-undangan yang berlaku di Republik Indonesia, termasuk peraturan ketenagakerjaan dan ketenagakerjaan tenaga kerja, sebagaimana diubah dari waktu ke waktu.</p>
    <p>Karyawan dengan ini menyatakan dan menjamin bahwa:</p>
    <ol class="alpha-list">
        <li>Karyawan memiliki kualifikasi, keahlian, pengalaman, dan kompetensi sebagaimana telah dinyatakan kepada Pemberi Kerja dan yang diperlukan untuk menjalankan tugas dan tanggung jawab jabatannya;</li>
        <li>Karyawan telah mengungkapkan secara lengkap kepada Pemberi Kerja setiap pembatasan, kewajiban, atau ketentuan hukum apa pun (termasuk namun tidak terbatas pada perjanjian larangan bersaing, perjanjian sebelumnya, kondisi kesehatan yang memengaruhi pekerjaan, atau pembatasan keimigrasian) yang dapat memengaruhi pelaksanaan tugas Karyawan;</li>
        <li>Karyawan menandatangani dan menyetujui Kontrak ini secara sukarela, atas kehendak sendiri, tanpa adanya paksaan, tekanan, atau pengaruh tidak wajar dari pihak mana pun;</li>
        <li>Karyawan secara sah berhak untuk bekerja di wilayah Republik Indonesia dan bersedia untuk menyerahkan dokumen yang sah dan benar apabila diminta oleh Pemberi Kerja, termasuk namun tidak terbatas pada dokumen identitas, izin tinggal, dan izin kerja sesuai dengan ketentuan hukum yang berlaku;</li>
        <li>Karyawan memiliki dan akan senantiasa menjaga keabsahan seluruh izin, lisensi, sertifikasi, dan kualifikasi yang diperlukan untuk melaksanakan tugasnya secara sah dan sesuai hukum selama masa hubungan kerja.</li>
    </ol>

    <div class="article-head">
        <p class="article-number">PASAL 3 / <em>ARTICLE 3</em></p>
        <p class="article-title">POSISI DAN JABATAN / <em>POSITION AND TITLE</em></p>
    </div>
    <p><em>You are employed on a {{ $data['employment_basis'] }} basis in the position of <strong>{{ $data['position_title'] }}</strong> as described at the beginning of this contract. You may be required to perform other tasks from time to time, as reasonably requested by the Employer.</em></p>
    <p>Karyawan dipekerjakan dengan status {{ $data['employment_basis'] }} pada posisi <strong>{{ $data['position_title'] }}</strong> sebagaimana tercantum dalam Perjanjian ini. Karyawan dapat diminta untuk melaksanakan tugas lain dari waktu ke waktu sepanjang wajar dan sesuai dengan kebutuhan Pemberi Kerja, serta masih berada dalam ruang lingkup pekerjaan Karyawan.</p>

    <div class="article-head">
        <p class="article-number">PASAL 4 / <em>ARTICLE 4</em></p>
        <p class="article-title">TUGAS DAN KEWAJIBAN POKOK / <em>PRINCIPAL DUTIES</em></p>
    </div>
    <p><em>The Employee's duties and responsibilities include, but are not limited to, the following. The Company reserves the right to assign additional tasks or responsibilities as reasonably required in accordance with business needs.</em></p>

    <p class="ayat-label">Ayat 1</p>
    <p>PIHAK KEDUA memiliki kewajiban umum untuk melaksanakan tugas dan tanggung jawabnya dengan itikad baik serta mematuhi setiap perintah yang sah dan wajar yang diberikan oleh PIHAK PERTAMA.</p>
    <p class="para-label">Paragraph 1</p>
    <p><em>The Employee has general obligations to perform their duties in good faith and to comply with all lawful and reasonable directions given by the Employer.</em></p>

    <p class="ayat-label">Ayat 2</p>
    <p>PIHAK KEDUA wajib senantiasa bertindak secara jujur, setia, bertanggung jawab, profesional, dan penuh kehati-hatian dalam melaksanakan seluruh tugas dan tanggung jawab pekerjaannya.</p>
    <p class="para-label">Paragraph 2</p>
    <p><em>The Employee shall at all times act honestly, faithfully, responsibly, professionally, and diligently in the performance of their duties and responsibilities.</em></p>

    <p class="ayat-label">Ayat 3</p>
    <p>PIHAK KEDUA wajib memastikan bahwa selama jam kerja berbayar, hanya melaksanakan pekerjaan yang berkaitan dengan tugas kedinasan dan tidak melakukan kegiatan pribadi yang dapat mengganggu kinerja, produktivitas, atau kepentingan PIHAK PERTAMA.</p>
    <p class="para-label">Paragraph 3</p>
    <p><em>The Employee shall ensure that during paid working hours, they perform only work-related duties and do not engage in personal activities that may interfere with work performance, productivity, or the interests of the Employer.</em></p>

    <p class="ayat-label">Ayat 4</p>
    <p>PIHAK KEDUA wajib bersikap profesional, sopan, dan menghormati PIHAK PERTAMA, klien, pelanggan, karyawan, pemasok, mitra kerja, serta masyarakat umum dalam setiap pelaksanaan tugas dan hubungan kerja.</p>
    <p class="para-label">Paragraph 4</p>
    <p><em>The Employee shall conduct themselves in a professional, respectful, and courteous manner when dealing with the Employer, its clients, customers, employees, suppliers, business partners, and members of the public.</em></p>

    <p class="ayat-label">Ayat 5</p>
    <p>PIHAK KEDUA wajib senantiasa bertindak demi kepentingan terbaik PIHAK PERTAMA serta menghindari setiap tindakan, perbuatan, atau kelalaian yang dapat merugikan reputasi, operasional usaha, klien, maupun sumber daya manusia PIHAK PERTAMA.</p>
    <p class="para-label">Paragraph 5</p>
    <p><em>The Employee shall at all times act in the best interests of the Employer and refrain from any conduct, action, or omission that may harm the reputation, business operations, clients, or personnel of the Employer.</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 5 / <em>ARTICLE 5</em></p>
        <p class="article-title">PENEMPATAN, TUGAS, DAN TANGGUNG JAWAB / <em>POSITION, DUTIES, AND RESPONSIBILITIES</em></p>
    </div>
    @php
        $responsibilityRows = [];
        $decodedResponsibilities = json_decode((string) ($data['responsibilities'] ?? ''), true);

        if (is_array($decodedResponsibilities)) {
            foreach ($decodedResponsibilities as $row) {
                if (!is_array($row)) {
                    continue;
                }

                $titleId = trim((string) ($row['title_id'] ?? $row['title'] ?? ''));
                $descId = trim((string) ($row['description_id'] ?? $row['description'] ?? ''));
                $titleEn = trim((string) ($row['title_en'] ?? $row['title'] ?? ''));
                $descEn = trim((string) ($row['description_en'] ?? $row['description'] ?? ''));

                if ($titleId === '' && $titleEn === '') {
                    continue;
                }

                if ($titleId === '') {
                    $titleId = $titleEn;
                }

                if ($titleEn === '') {
                    $titleEn = $titleId;
                }

                $responsibilityRows[] = [
                    'title_id' => $titleId,
                    'description_id' => $descId,
                    'title_en' => $titleEn,
                    'description_en' => $descEn,
                ];
            }
        } else {
            // Backward compatibility for legacy plain-text responsibilities.
            $legacyItems = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) ($data['responsibilities'] ?? '')))));
            foreach ($legacyItems as $item) {
                if ($item === '') {
                    continue;
                }

                $title = $item;
                $description = '';
                if (str_contains($item, ':')) {
                    [$left, $right] = array_pad(explode(':', $item, 2), 2, '');
                    $title = trim((string) $left);
                    $description = trim((string) $right);
                }

                $responsibilityRows[] = [
                    'title_id' => $title,
                    'description_id' => $description,
                    'title_en' => $title,
                    'description_en' => $description,
                ];
            }
        }
    @endphp

    <p class="ayat-label">Ayat 1</p>
    <p>PIHAK KEDUA akan bekerja sebagai HR dan Finance Manager. PIHAK KEDUA bersedia melaksanakan seluruh tugas dan tanggung jawab yang berkaitan dengan pekerjaan HR dan Finance sesuai dengan kebutuhan operasional Perusahaan dari waktu ke waktu.</p>
    <p class="para-label">Paragraph 1</p>
    <p><em>The SECOND PARTY shall be employed as a HR and Finance Manager. The SECOND PARTY agrees to perform all HR and Finance-related duties and responsibilities as may be required by the Company from time to time, in accordance with the Company's operational needs.</em></p>

    <p class="ayat-label">Ayat 2</p>
    <p>Tugas dan tanggung jawab PIHAK KEDUA meliputi, namun tidak terbatas pada, hal-hal sebagai berikut:</p>
    @if (count($responsibilityRows) > 0)
        <ol>
            @foreach ($responsibilityRows as $row)
                <li>
                    {{ $row['title_id'] }}@if ($row['description_id'] !== ''): {{ $row['description_id'] }}@endif
                </li>
            @endforeach
        </ol>
    @else
        <p>Rincian tugas akan ditetapkan oleh Perusahaan dari waktu ke waktu sesuai kebutuhan operasional.</p>
    @endif

    <p class="para-label">Paragraph 2</p>
    <p><em>The duties and responsibilities of the SECOND PARTY shall include, but are not limited to the following:</em></p>
    @if (count($responsibilityRows) > 0)
        <ol>
            @foreach ($responsibilityRows as $row)
                <li>
                    <em>{{ $row['title_en'] }}@if ($row['description_en'] !== ''): {{ $row['description_en'] }}@endif</em>
                </li>
            @endforeach
        </ol>
    @else
        <p><em>Duties shall include, but are not limited to, responsibilities relevant to {{ $data['position_title'] }} as assigned by the Company from time to time.</em></p>
    @endif

    <div class="article-head">
        <p class="article-number">PASAL 6 / <em>ARTICLE 6</em></p>
        <p class="article-title">JAM KERJA / <em>WORKING HOURS</em></p>
    </div>
    <p class="ayat-label">Ayat 1</p>
    <p>Berdasarkan peraturan ketenagakerjaan yang berlaku, jam kerja efektif perusahaan ditetapkan {{ $data['working_hours_per_day'] }} setiap hari dengan jumlah hari kerja {{ $data['working_days_per_week'] }} hari setiap minggu. Total jam kerja perminggu adalah 45 jam. Waktu istirahat pada hari Minggu ditetapkan selama satu hari penuh.</p>
    <p class="para-label">Paragraph 1</p>
    <p><em>Based on the applicable manpower regulations, the Company's effective working hours are determined as {{ $data['working_hours_per_day'] }} per day, excluding one (1) hour of unpaid break, with a total of {{ $data['working_days_per_week'] }} working days per week. The total weekly working hours shall be 45 (forty-five) hours. The weekly rest period on Sunday shall be designated as one (1) full day.</em></p>

    <p class="ayat-label">Ayat 2</p>
    <p>Jam masuk adalah jam {{ $data['work_start_time'] }} dan jam pulang adalah jam {{ $data['work_end_time'] }}.</p>
    <p class="para-label">Paragraph 2</p>
    <p><em>The working hours shall commence at {{ $data['work_start_time'] }} and end at {{ $data['work_end_time'] }}.</em></p>

    <p class="ayat-label">Ayat 3</p>
    <p>Apabila pada suatu hari kerja PIHAK KEDUA dijadwalkan bekerja kurang dari jam kerja penuh standar, maka gaji dapat disesuaikan secara proporsional berdasarkan jumlah jam kerja aktual yang dijalani oleh PIHAK KEDUA.</p>
    <p class="para-label">Paragraph 3</p>
    <p><em>If on any working day the EMPLOYEE is scheduled to work fewer hours than the standard full-time working hours, the salary may be adjusted proportionally based on the actual hours worked.</em></p>

    <p class="ayat-label">Ayat 4</p>
    <p>Apabila PIHAK KEDUA bekerja lebih dari 10 (sepuluh) jam dalam satu hari, maka jam kerja tambahan tersebut dapat:</p>
    <ol>
        <li>dikompensasikan sebagai pengganti jam kerja yang lebih sedikit pada hari kerja lain dalam minggu yang sama; atau</li>
        <li>dihitung sebagai lembur, sepanjang total jam kerja mingguan telah terpenuhi.</li>
    </ol>
    <p>Kompensasi lembur akan dilaksanakan sesuai dengan kebijakan Perusahaan dan ketentuan peraturan perundang-undangan ketenagakerjaan yang berlaku.</p>
    <p class="para-label">Paragraph 4</p>
    <p><em>If the EMPLOYEE works more than ten (10) hours in a single day, the additional hours may be:</em></p>
    <ol>
        <li><em>credited toward any shorter working day within the same week; or</em></li>
        <li><em>counted as overtime, provided that the full weekly working hour requirement has been met.</em></li>
    </ol>
    <p><em>Overtime compensation shall be provided in accordance with Company policy and applicable labor laws and regulations.</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 7 / <em>ARTICLE 7</em></p>
        <p class="article-title">GAJI POKOK DAN TUNJANGAN-TUNJANGAN / <em>BASIC SALARY AND ALLOWANCES</em></p>
    </div>
    <p class="ayat-label">Ayat 1</p>
    <p>{{ $data['pasal7_ayat1_id'] ?? ('PIHAK PERTAMA harus memberikan gaji pokok kepada PIHAK KEDUA sebesar '.($data['salary_base'] ?: '-').' setiap bulan yang harus dibayarkan PIHAK PERTAMA pada tanggal '.$data['pay_day'].' di bulan berikutnya.') }}</p>
    <p class="para-label">Paragraph 1</p>
    <p><em>{{ $data['pasal7_paragraph1_en'] ?? ('The EMPLOYER shall pay the EMPLOYEE a basic salary in the amount of '.($data['salary_base'] ?: '-').' per month, which shall be paid by the EMPLOYER on day '.$data['pay_day'].' of the following month.') }}</em></p>

    <p class="ayat-label">Ayat 2</p>
    <p>{{ $data['pasal7_ayat2_id'] ?? 'Selain gaji pokok, PIHAK KEDUA juga berhak mendapatkan tunjangan-tunjangan sebagai berikut:' }}</p>
    @php
        $bpjsEmploymentActive = ($data['bpjs_employment_status'] ?? 'yes') === 'yes';
        $bpjsHealthActive = ($data['bpjs_health_status'] ?? 'yes') === 'yes';
        $bpjsEmploymentComponents = [];

        if (!empty($data['bpjs_jht_enabled'])) {
            $bpjsEmploymentComponents['id'][] = 'JHT';
            $bpjsEmploymentComponents['en'][] = 'JHT';
        }
        if (!empty($data['bpjs_jkk_enabled'])) {
            $bpjsEmploymentComponents['id'][] = 'JKK';
            $bpjsEmploymentComponents['en'][] = 'JKK';
        }
        if (!empty($data['bpjs_jkm_enabled'])) {
            $bpjsEmploymentComponents['id'][] = 'JKM';
            $bpjsEmploymentComponents['en'][] = 'JKM';
        }
        if (!empty($data['bpjs_jp_enabled'])) {
            $bpjsEmploymentComponents['id'][] = 'JP';
            $bpjsEmploymentComponents['en'][] = 'JP';
        }
        if (!empty($data['bpjs_jkp_enabled'])) {
            $bpjsEmploymentComponents['id'][] = 'JKP';
            $bpjsEmploymentComponents['en'][] = 'JKP';
        }

        $bpjsComponentsIdText = !empty($bpjsEmploymentComponents['id'])
            ? implode(', ', $bpjsEmploymentComponents['id'])
            : 'tidak ada komponen BPJS Ketenagakerjaan yang dipilih';
        $bpjsComponentsEnText = !empty($bpjsEmploymentComponents['en'])
            ? implode(', ', $bpjsEmploymentComponents['en'])
            : 'no BPJS Employment components are selected';
    @endphp
    <ol>
        <li>{{ $data['pasal7_ayat2_id_item1'] ?? ('Tunjangan Lembur dan Hari Libur sebesar '.($data['salary_allowance'] ?: '-')) }}</li>
        <li>{{ $data['pasal7_ayat2_id_item2'] ?? ('Tunjangan Makan sebesar '.($data['food_allowance'] ?: '-')) }}</li>
        <li>{{ $data['pasal7_ayat2_id_item3'] ?? ('Tunjangan Transport sebesar '.($data['transport_allowance'] ?? '-')) }}</li>
        <li>{{ $data['pasal7_ayat2_id_item4'] ?? ($bpjsHealthActive ? 'BPJS Kesehatan diberikan sesuai ketentuan yang berlaku' : 'BPJS Kesehatan tidak diberikan') }}</li>
        <li>{{ $data['pasal7_ayat2_id_item5'] ?? ($bpjsEmploymentActive ? ('BPJS Ketenagakerjaan diberikan dengan komponen: '.$bpjsComponentsIdText) : 'BPJS Ketenagakerjaan tidak diberikan') }}</li>
    </ol>
    <p class="para-label">Paragraph 2</p>
    <p><em>{{ $data['pasal7_paragraph2_en'] ?? 'In addition to the basic salary, the EMPLOYEE shall also be entitled to receive the following allowances:' }}</em></p>
    <ol>
        <li><em>{{ $data['pasal7_paragraph2_en_item1'] ?? ('Overtime and Holiday Allowance in the amount of '.($data['salary_allowance'] ?: '-').';') }}</em></li>
        <li><em>{{ $data['pasal7_paragraph2_en_item2'] ?? ('Food Allowance in the amount of '.($data['food_allowance'] ?: '-').';') }}</em></li>
        <li><em>{{ $data['pasal7_paragraph2_en_item3'] ?? ('Transport Allowance in the amount of '.($data['transport_allowance'] ?? '-').';') }}</em></li>
        <li><em>{{ $data['pasal7_paragraph2_en_item4'] ?? ($bpjsHealthActive ? 'BPJS Health Insurance shall be provided in accordance with the applicable regulations.' : 'BPJS Health Insurance shall not be provided.') }}</em></li>
        <li><em>{{ $data['pasal7_paragraph2_en_item5'] ?? ($bpjsEmploymentActive ? ('BPJS Employment coverage shall be provided with the following components: '.$bpjsComponentsEnText.'.') : 'BPJS Employment coverage shall not be provided.') }}</em></li>
    </ol>

    <p class="ayat-label">Ayat 3</p>
    <p>{{ $data['pasal7_ayat3_id'] ?? ($bpjsEmploymentActive ? ('PIHAK PERTAMA wajib mendaftarkan PIHAK KEDUA dalam program BPJS Ketenagakerjaan sesuai komponen yang dipilih pada kontrak ini ('.$bpjsComponentsIdText.'), serta membayarkan iuran sesuai ketentuan peraturan perundang-undangan yang berlaku.') : 'PIHAK KEDUA tidak didaftarkan dalam program BPJS Ketenagakerjaan berdasarkan kesepakatan para pihak dalam perjanjian ini.') }}</p>
    <p class="para-label">Paragraph 3</p>
    <p><em>{{ $data['pasal7_paragraph3_en'] ?? ($bpjsEmploymentActive ? ('The EMPLOYER shall register the EMPLOYEE in BPJS Employment according to the selected components in this Contract ('.$bpjsComponentsEnText.') and shall pay contributions in accordance with applicable laws and regulations.') : 'The EMPLOYEE shall not be enrolled in BPJS Employment based on the parties\' agreement in this Contract.') }}</em></p>

    <p class="ayat-label">Ayat 4</p>
    <p>{{ $data['pasal7_ayat4_id'] ?? ('Total gaji pokok + tunjangan adalah '.($data['salary_total'] ?: '-').' per bulan, sebelum potongan wajib. PIHAK PERTAMA akan memotong dan menyetorkan PPh 21 dan potongan wajib lainnya sesuai ketentuan yang berlaku. Pembayaran tunjangan-tunjangan tersebut akan disatukan dengan pembayaran gaji pokok yang akan diterima PIHAK KEDUA pada setiap tanggal '.$data['pay_day'].' di bulan berikutnya.') }}</p>
    <p class="para-label">Paragraph 4</p>
    <p><em>{{ $data['pasal7_paragraph4_en'] ?? ('The total basic salary and allowances amount to '.($data['salary_total'] ?: '-').' per month, before mandatory deductions. The EMPLOYER shall deduct and remit Income Tax (PPh 21) and other mandatory deductions in accordance with the applicable laws and regulations. Payment of the above-mentioned allowances shall be made together with the payment of the basic salary and shall be received by the EMPLOYEE on day '.$data['pay_day'].' of the following month.') }}</em></p>

    <p class="ayat-label">Ayat 5</p>
    <p>{{ $data['pasal7_ayat5_id'] ?? 'Tidak ada pembayaran yang akan dilakukan apabila karyawan mengundurkan diri tanpa pemberitahuan atau alasan yang sah sebelum berakhirnya masa kerja yang disepakati.' }}</p>
    <p class="para-label">Paragraph 5</p>
    <p><em>{{ $data['pasal7_paragraph5_en'] ?? 'No payment shall be made if the staff member leaves employment without notice or valid reason before the completion of the agreed period.' }}</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 8 / <em>ARTICLE 8</em></p>
        <p class="article-title">PEMUTUSAN HUBUNGAN KERJA – PENGUNDURAN DIRI / <em>TERMINATION – RESIGNATION</em></p>
    </div>
    <p class="ayat-label">Ayat 1</p>
    <p>PIHAK KEDUA dapat mengakhiri Perjanjian Kerja ini dengan memberikan pemberitahuan tertulis paling lambat {{ $data['notice_period_days'] }} hari kalender sebelumnya kepada PIHAK PERTAMA.</p>
    <p class="para-label">Paragraph 1</p>
    <p><em>The EMPLOYEE may terminate this Agreement by providing at least {{ $data['notice_period_days'] }} calendar days prior written notice to the EMPLOYER.</em></p>

    <p class="ayat-label">Ayat 2</p>
    <p>Apabila PIHAK KEDUA mengundurkan diri tanpa memberikan pemberitahuan tertulis {{ $data['notice_period_days'] }} hari sebelumnya, maka PIHAK PERTAMA berhak tidak membayarkan gaji pada bulan berjalan secara proporsional sesuai ketentuan hukum yang berlaku.</p>
    <p class="para-label">Paragraph 2</p>
    <p><em>If the EMPLOYEE resigns without providing the required {{ $data['notice_period_days'] }} days prior written notice, the EMPLOYER shall be entitled to withhold the salary for the relevant period, in accordance with applicable laws and regulations.</em></p>

    <p class="ayat-label">Ayat 3</p>
    <p>PIHAK PERTAMA berhak melakukan pemutusan hubungan kerja secara langsung apabila PIHAK KEDUA melakukan pelanggaran berat, kelalaian serius, atau tindakan lain yang membahayakan keselamatan, keamanan, atau kepentingan Perusahaan, klien, atau pihak terkait lainnya, sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.</p>
    <p class="para-label">Paragraph 3</p>
    <p><em>The EMPLOYER may terminate the employment with immediate effect if the EMPLOYEE commits serious misconduct, gross negligence, or any act that endangers the safety, security, or interests of the Company, its clients, or other related parties, subject to applicable laws and regulations.</em></p>

    <p class="ayat-label">Ayat 4</p>
    <p>Pada saat berakhirnya hubungan kerja dengan alasan apa pun, PIHAK KEDUA wajib segera mengembalikan kepada PIHAK PERTAMA seluruh barang, properti, dokumen, dan perlengkapan yang berkaitan dengan kegiatan usaha PIHAK PERTAMA yang berada dalam penguasaan atau kendali PIHAK KEDUA, termasuk namun tidak terbatas pada kendaraan, peralatan, kunci, laporan, dokumen, komputer, data, catatan, serta hak kekayaan intelektual.</p>
    <p class="para-label">Paragraph 4</p>
    <p><em>Upon termination of employment for any reason, the EMPLOYEE must immediately return to the EMPLOYER all property, documents, equipment, and materials relating to the EMPLOYER's business in the possession or control of the EMPLOYEE, including but not limited to vehicles, equipment, keys, reports, documents, computers, data, records, and intellectual property.</em></p>

    <p class="ayat-label">Ayat 5</p>
    <p>PIHAK KEDUA juga wajib menghapus secara permanen dan tidak dapat dipulihkan kembali seluruh Informasi Rahasia milik PIHAK PERTAMA yang tersimpan dalam bentuk apa pun pada perangkat pribadi atau media penyimpanan di luar lingkungan PIHAK PERTAMA.</p>
    <p class="para-label">Paragraph 5</p>
    <p><em>The EMPLOYEE must also permanently and irretrievably delete all Confidential Information of the EMPLOYER stored in any form on personal devices or storage media outside the EMPLOYER's premises.</em></p>

    <p class="ayat-label">Ayat 6 - Klausul Kabur</p>
    <p>Apabila PIHAK KEDUA mengundurkan diri tanpa komunikasi, meninggalkan pekerjaan tanpa alasan yang sah, atau mengundurkan diri tanpa persetujuan tertulis PIHAK PERTAMA selama masa kontrak, maka tindakan tersebut dianggap sebagai kabur (<em>runaway</em>). Dalam hal demikian, PIHAK KEDUA wajib membayar kompensasi kepada PIHAK PERTAMA sebesar 6 (enam) bulan gaji terakhir PIHAK KEDUA sebagai ganti rugi tetap (<em>liquidated damages</em>) dan kompensasi atas kerugian usaha, sejauh diperbolehkan oleh hukum yang berlaku.</p>
    <p class="para-label">Paragraph 6 - Runaway Clause</p>
    <p><em>If the EMPLOYEE resigns without communication, abandons the position without valid reason, or resigns without prior written approval from the EMPLOYER during the contract period, such action shall be deemed a runaway. In such event, the EMPLOYEE shall be liable to pay compensation to the EMPLOYER equivalent to six (6) months of the EMPLOYEE's last salary as liquidated damages and compensation for business losses, to the extent permitted by applicable law.</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 9 / <em>ARTICLE 9</em></p>
        <p class="article-title">TATA TERTIB, DISIPLIN, DAN PROFESIONALISME KERJA / <em>WORKPLACE RULES, DISCIPLINE, AND PROFESSIONAL CONDUCT</em></p>
    </div>
    <p class="ayat-label">Ayat 1</p>
    <p>PIHAK KEDUA wajib selalu berpenampilan sopan, bersih, dan profesional, serta mengenakan seragam kerja yang disediakan oleh PIHAK PERTAMA setiap saat selama jam kerja.</p>
    <p class="para-label">Paragraph 1</p>
    <p><em>The EMPLOYEE shall at all times present themselves in a modest, clean, and professional manner and shall wear the uniform provided by the EMPLOYER at all times during working hours.</em></p>

    <p class="ayat-label">Ayat 2</p>
    <p>PIHAK KEDUA dilarang merokok di dalam properti atau area mana pun tempat PIHAK KEDUA melaksanakan pekerjaan.</p>
    <p class="para-label">Paragraph 2</p>
    <p><em>The EMPLOYEE is strictly prohibited from smoking inside any property or premises where work is being performed.</em></p>

    <p class="ayat-label">Ayat 3</p>
    <p>PIHAK KEDUA dilarang mengonsumsi alkohol, narkotika, atau obat-obatan terlarang dalam kondisi apa pun, baik selama jam kerja maupun di lingkungan kerja.</p>
    <p class="para-label">Paragraph 3</p>
    <p><em>The EMPLOYEE shall not consume alcohol, illegal drugs, or prohibited substances at any time, whether during working hours or within the work environment.</em></p>

    <p class="ayat-label">Ayat 4</p>
    <p>Setiap pelanggaran terhadap ketentuan dalam Pasal ini, terutama yang terjadi di sekitar anak-anak, dapat mengakibatkan tindakan hukum dan sanksi finansial, termasuk denda yang nilainya dapat melebihi USD 50.000 (lima puluh ribu Dolar Amerika Serikat), sesuai dengan hukum yang berlaku.</p>
    <p class="para-label">Paragraph 4</p>
    <p><em>Any violation of this Article, particularly involving or occurring around children, may result in legal action and financial penalties, including fines exceeding USD 50,000 (fifty thousand United States Dollars), subject to applicable law.</em></p>

    <p class="ayat-label">Ayat 5</p>
    <p>PIHAK KEDUA wajib menjaga sikap profesional selama jam kerja berbayar dan memahami bahwa PIHAK KEDUA dibayar untuk bekerja, bukan untuk menggunakan telepon genggam pribadi secara berlebihan atau tidak terkait pekerjaan.</p>
    <p class="para-label">Paragraph 5</p>
    <p><em>The EMPLOYEE is expected to maintain professional conduct during paid working hours and acknowledges that they are paid to work, not to engage in excessive or non-work-related use of personal mobile phones.</em></p>

    <p class="ayat-label">Ayat 6</p>
    <p>PIHAK KEDUA tidak diperkenankan melakukan panggilan pribadi selama jam kerja, kecuali dalam keadaan darurat. Dalam hal keadaan darurat tersebut, PIHAK KEDUA wajib memberitahukan PIHAK PERTAMA sesegera mungkin.</p>
    <p class="para-label">Paragraph 6</p>
    <p><em>The EMPLOYEE shall not make personal calls during working hours, except in the case of an emergency, in which event the EMPLOYEE must notify the EMPLOYER as soon as reasonably practicable.</em></p>

    <p class="ayat-label">Ayat 7</p>
    <p>Dalam keadaan darurat medis dan pertolongan pertama, PIHAK KEDUA wajib segera memanggil ambulans apabila keadaan darurat bersifat kritis dan Anak mengalami cedera berat. Dalam keadaan yang lebih ringan, PIHAK KEDUA wajib terlebih dahulu menghubungi orang tua Anak dan mengonfirmasi tindakan selanjutnya yang harus dilakukan.</p>
    <p class="para-label">Paragraph 7</p>
    <p><em>In the event of a medical emergency or first aid situation, the EMPLOYEE must immediately call an ambulance if the emergency is critical and the Children have been seriously injured. In minor cases, the EMPLOYEE must first call the Children's parents and confirm the next course of action.</em></p>

    <p class="ayat-label">Ayat 8</p>
    <p>PIHAK KEDUA diharapkan menjaga profesionalisme selama jam kerja berbayar dan memahami bahwa PIHAK KEDUA dibayar untuk bekerja, bukan untuk menggunakan telepon genggam pribadi secara berlebihan atau untuk kepentingan yang tidak berkaitan dengan pekerjaan.</p>
    <p class="para-label">Paragraph 8</p>
    <p><em>The EMPLOYEE is expected to maintain professionalism during paid working hours and understands that they are paid to work, not to spend time on a mobile phone for excessive or non-work-related purposes.</em></p>

    <p class="ayat-label">Ayat 9</p>
    <p>PIHAK KEDUA dengan ini menyetujui hal-hal berikut:</p>
    <ol class="alpha-list">
        <li>tidak diperkenankan melakukan panggilan pribadi selama jam kerja kecuali dalam keadaan darurat, dan dalam hal demikian PIHAK KEDUA wajib memberitahukan PIHAK PERTAMA sesegera mungkin; dan</li>
        <li>apabila membawa Anak keluar rumah atau melakukan kegiatan di luar, PIHAK KEDUA wajib memastikan telepon genggam dalam mode dering (bukan senyap) serta wajib segera menjawab panggilan dari PIHAK PERTAMA apabila aman untuk dilakukan.</li>
    </ol>
    <p class="para-label">Paragraph 9</p>
    <p><em>The EMPLOYEE agrees to the following:</em></p>
    <ol class="alpha-list">
        <li><em>no personal calls are allowed during work hours unless there is an emergency, in which case the EMPLOYEE must notify the EMPLOYER as soon as reasonably practicable; and</em></li>
        <li><em>when taking the Children on outings, the EMPLOYEE must keep their phone on ring mode (not silent) and must answer the EMPLOYER's calls immediately when it is safe to do so.</em></li>
    </ol>

    <p class="ayat-label">Ayat 10</p>
    <p>Standar kebersihan dan tata berpakaian yang diharapkan bagi PIHAK KEDUA adalah sebagai berikut:</p>
    <ol class="alpha-list">
        <li>PIHAK KEDUA wajib selalu tampil sopan, rapi, bersih, dan profesional;</li>
        <li>PIHAK KEDUA wajib mengenakan celana panjang atau celana pendek, kaos, dan sepatu anti-slip (bukan sandal) untuk menjaga penampilan yang profesional dan aman, apabila seragam Staff Link belum tersedia;</li>
        <li>PIHAK KEDUA wajib membawa celana renang dan kacamata renang setiap hari apabila dibutuhkan untuk pelaksanaan tugas;</li>
        <li>PIHAK KEDUA wajib mengenakan seragam Staff Link selama bekerja setiap saat apabila seragam telah diberikan;</li>
        <li>deposit sebesar IDR 500.000 akan dipotong dari gaji pertama untuk setiap seragam dan akan dikembalikan pada saat seragam dikembalikan dalam keadaan baik dan tidak rusak;</li>
        <li>apabila seragam rusak dalam bentuk apa pun, deposit tidak akan dikembalikan dan seragam tetap menjadi milik Staff Link karena seragam tersebut hanya dipinjamkan kepada PIHAK KEDUA selama masa kerja; dan</li>
        <li>tidak mengembalikan seragam karyawan dapat dianggap sebagai pencurian, dapat memengaruhi pembayaran gaji terakhir PIHAK KEDUA, dan dapat dilaporkan kepada pihak kepolisian sebagai barang yang dicuri.</li>
    </ol>
    <p class="para-label">Paragraph 10</p>
    <p><em>The expected hygiene and dress code standards for the EMPLOYEE are as follows:</em></p>
    <ol class="alpha-list">
        <li><em>the EMPLOYEE is expected to present in a modest, neat, clean, and professional manner at all times;</em></li>
        <li><em>the EMPLOYEE must wear pants or shorts, a t-shirt, and non-slip sneakers (not slippers) to ensure a professional and presentable appearance where the Staff Link uniform is not yet available;</em></li>
        <li><em>the EMPLOYEE must bring swimming shorts and goggles daily where required for the role;</em></li>
        <li><em>the EMPLOYEE must wear the Staff Link uniform to work at all times once the uniform has been provided;</em></li>
        <li><em>a deposit of IDR 500,000 shall be deducted from the first salary for each uniform and shall be refunded upon return of the uniform provided it is not damaged;</em></li>
        <li><em>if the uniform is damaged in any way, the deposit shall not be refunded and the uniform shall remain the property of Staff Link, as it is only loaned to the staff member or EMPLOYEE during the period of employment; and</em></li>
        <li><em>failure to return the EMPLOYEE uniform may be treated as theft, may affect the EMPLOYEE's final salary payment, and may be reported to the police as stolen property.</em></li>
    </ol>

    <p class="ayat-label">Ayat 11</p>
    <p>Perilaku yang dilarang bagi PIHAK KEDUA meliputi hal-hal berikut:</p>
    <ol class="alpha-list">
        <li>dilarang merokok di dalam rumah;</li>
        <li>dilarang mengonsumsi alkohol atau narkotika/obat-obatan terlarang kapan pun; dan</li>
        <li>apabila PIHAK KEDUA terbukti melanggar ketentuan ini, khususnya di sekitar anak di bawah umur yang berada dalam pengawasannya, PIHAK KEDUA dapat menghadapi tuntutan hukum dan dengan menandatangani Perjanjian ini PIHAK KEDUA menyetujui adanya sanksi finansial lebih dari USD 50.000, sejauh diperbolehkan oleh hukum yang berlaku.</li>
    </ol>
    <p class="para-label">Paragraph 11</p>
    <p><em>Prohibited behaviour for the EMPLOYEE includes the following:</em></p>
    <ol class="alpha-list">
        <li><em>no smoking is allowed inside the house;</em></li>
        <li><em>no consumption of alcohol or drugs is permitted at any time; and</em></li>
        <li><em>if the EMPLOYEE is found violating these terms, particularly around underage children entrusted to their care, the EMPLOYEE may face legal claims and, by signing this Agreement, agrees to financial penalties exceeding USD 50,000, to the extent permitted by applicable law.</em></li>
    </ol>

    <div class="article-head">
        <p class="article-number">PASAL 10 / <em>ARTICLE 10</em></p>
        <p class="article-title">NON-SOLISITASI, KERAHASIAAN, DAN PERLINDUNGAN USAHA / <em>NON-SOLICITATION, CONFIDENTIALITY, AND BUSINESS PROTECTION</em></p>
    </div>
    @php
        $positionTitleArticle10 = mb_strtolower((string) ($data['position_title'] ?? ''), 'UTF-8');
        $showFamilyConfidentialityClause = str_contains($positionTitleArticle10, 'nanny') || str_contains($positionTitleArticle10, 'cleaner');
    @endphp
    <p class="ayat-label">Ayat 1</p>
    <p>Setelah berakhirnya hubungan kerja dengan alasan apa pun, PIHAK KEDUA dilarang, baik secara langsung maupun tidak langsung, melakukan pendekatan, penawaran, permintaan, atau upaya solisitasi terhadap Klien PIHAK PERTAMA untuk memberikan jasa yang bersaing atau sejenis, sepanjang tindakan tersebut didasarkan pada atau memanfaatkan Informasi Rahasia, rahasia dagang, struktur harga, data klien, atau hubungan usaha yang diperoleh selama PIHAK KEDUA bekerja pada PIHAK PERTAMA.</p>
    <p class="para-label">Paragraph 1</p>
    <p><em>Upon termination of employment for any reason, the EMPLOYEE shall not, directly or indirectly, solicit, approach, canvass, or attempt to solicit any Client of the EMPLOYER for the purpose of providing competing or similar services, where such solicitation relies upon or arises from Confidential Information, trade secrets, pricing structures, client data, or business relationships obtained during the course of employment.</em></p>

    <p class="ayat-label">Ayat 2</p>
    <p>PIHAK KEDUA mengakui bahwa meskipun hukum di Republik Indonesia tidak melarang persaingan usaha yang sah, PIHAK KEDUA secara tegas dilarang melakukan persaingan usaha tidak sehat, termasuk namun tidak terbatas pada penggunaan, pengungkapan, pemanfaatan, atau ketergantungan pada Informasi Rahasia, rahasia dagang, sistem internal, metode operasional, struktur harga, atau informasi strategis milik PIHAK PERTAMA, baik untuk kepentingan pribadi maupun pihak ketiga.</p>
    <p class="para-label">Paragraph 2</p>
    <p><em>The EMPLOYEE acknowledges that while Indonesian law does not prohibit lawful competition, the EMPLOYEE is strictly prohibited from engaging in any form of unfair competition, including but not limited to the use, disclosure, exploitation, or reliance upon the EMPLOYER's Confidential Information, trade secrets, internal systems, operational methods, pricing structures, or strategic information, whether for personal benefit or for the benefit of any third party.</em></p>

    <p class="ayat-label">Ayat 3</p>
    <p>Sejak tanggal berakhirnya hubungan kerja, PIHAK KEDUA dilarang secara langsung maupun tidak langsung menarik, membujuk, mempengaruhi, atau mendorong karyawan, kontraktor, atau staf PIHAK PERTAMA atau Afiliasinya untuk mengakhiri atau mengubah hubungan kerja atau kerja sama mereka dengan PIHAK PERTAMA, sepanjang tindakan tersebut timbul dari hubungan, pengaruh, atau informasi yang diperoleh selama masa kerja.</p>
    <p class="para-label">Paragraph 3</p>
    <p><em>From the date employment ends, the EMPLOYEE shall not directly or indirectly solicit, entice, induce, or encourage any employee, contractor, or staff member of the EMPLOYER or its Affiliates to terminate or alter their engagement with the EMPLOYER, where such conduct arises from relationships, influence, or information obtained during employment.</em></p>

    <p class="ayat-label">Ayat 4</p>
    <p>PIHAK KEDUA dilarang mengganggu atau berupaya mengganggu hubungan usaha yang telah ada maupun yang berpotensi ada antara PIHAK PERTAMA dengan Klien, pemasok, mitra usaha, atau stafnya, termasuk melalui pernyataan yang merugikan, penyampaian informasi yang menyesatkan, bujukan, atau penyalahgunaan Informasi Rahasia.</p>
    <p class="para-label">Paragraph 4</p>
    <p><em>The EMPLOYEE shall not interfere, disrupt, or attempt to interfere with any existing or prospective business relationship between the EMPLOYER and its clients, suppliers, business partners, or staff, including through disparagement, misrepresentation, inducement, or misuse of Confidential Information.</em></p>

    <p class="ayat-label">Ayat 5</p>
    <p>Dalam Pasal ini yang dimaksud dengan:</p>
    <ol>
        <li>Klien adalah setiap orang, badan usaha, atau organisasi yang dalam jangka waktu dua belas (12) bulan sebelum berakhirnya hubungan kerja merupakan klien, pelanggan, atau calon klien aktif PIHAK PERTAMA atau Afiliasinya, dan yang informasinya diketahui atau dapat diakses oleh PIHAK KEDUA selama masa kerja;</li>
        <li>Informasi Rahasia mencakup rahasia dagang sebagaimana dilindungi berdasarkan Undang-Undang Nomor 30 Tahun 2000 tentang Rahasia Dagang, termasuk namun tidak terbatas pada data klien, harga, metode kerja, dan informasi strategis lainnya.</li>
    </ol>
    <p class="para-label">Paragraph 5</p>
    <p><em>For the purposes of this Article:</em></p>
    <ol>
        <li><em>Client means any individual, entity, or organisation that, within twelve (12) months prior to the termination date, was a client, customer, or active prospective client of the EMPLOYER or its Affiliates, and with whom the EMPLOYEE had dealings or access to information during employment;</em></li>
        <li><em>Confidential Information includes trade secrets protected under Law No. 30 of 2000 on Trade Secrets, including but not limited to client data, pricing, operational methods, and strategic business information.</em></li>
    </ol>

    <p class="ayat-label">Ayat 6</p>
    <p>Ketentuan dalam Pasal ini berlaku terhadap setiap tindakan yang dilakukan secara langsung maupun tidak langsung, baik secara pribadi maupun melalui perantara, rekan, anggota keluarga, atau pihak ketiga lainnya, serta baik untuk kepentingan PIHAK KEDUA sendiri maupun pihak lain.</p>
    <p class="para-label">Paragraph 6</p>
    <p><em>The obligations in this Article apply to conduct undertaken directly or indirectly, whether personally or through any intermediary, associate, family member, or third party, and whether for the benefit of the EMPLOYEE or any other person or entity.</em></p>

    <p class="ayat-label">Ayat 7</p>
    <p>Setiap kewajiban dalam Pasal ini merupakan kewajiban yang berdiri sendiri dan terpisah. Apabila salah satu ketentuan dinyatakan tidak dapat dilaksanakan, tidak sah, atau bertentangan dengan hukum, maka ketentuan lainnya tetap berlaku sepenuhnya.</p>
    <p class="para-label">Paragraph 7</p>
    <p><em>Each obligation in this Article operates as a separate and independent covenant. If any provision is found unenforceable, illegal, or invalid, such finding shall not affect the enforceability of the remaining provisions, which shall continue in full force and effect.</em></p>

    <p class="ayat-label">Ayat 8</p>
    <p>PIHAK KEDUA dengan ini mengakui bahwa seluruh kewajiban dan pembatasan dalam Pasal ini bersifat wajar, proporsional, dan diperlukan untuk melindungi kepentingan usaha yang sah, rahasia dagang, hubungan klien, reputasi, dan itikad baik PIHAK PERTAMA.</p>
    <p class="para-label">Paragraph 8</p>
    <p><em>The EMPLOYEE expressly acknowledges that the obligations and restrictions contained in this Article are reasonable, proportionate, and necessary to protect the EMPLOYER's legitimate business interests, trade secrets, client relationships, reputation, and goodwill.</em></p>

    <p class="ayat-label">Ayat 9</p>
    <p>PIHAK KEDUA memahami bahwa setiap pelanggaran terhadap Pasal ini dapat menimbulkan kerugian serius dan tidak dapat diperbaiki (irreparable harm) bagi PIHAK PERTAMA, dan oleh karenanya PIHAK PERTAMA berhak menuntut ganti rugi, perintah pengadilan (injunction), serta upaya hukum lain yang tersedia berdasarkan hukum Republik Indonesia.</p>
    <p class="para-label">Paragraph 9</p>
    <p><em>The EMPLOYEE acknowledges that any breach of this Article may cause irreparable harm to the EMPLOYER, and that the EMPLOYER shall be entitled to seek damages, injunctive relief, and any other remedies available under the laws of {{ $data['governing_law'] }}.</em></p>

    @if ($showFamilyConfidentialityClause)
        <p class="ayat-label">Ayat 10</p>
        <p>Karyawan pekerja setuju untuk menjaga kerahasiaan penuh terkait informasi pribadi, medis, atau sensitif milik keluarga Pemberi Kerja.</p>
        <p class="para-label">Paragraph 10</p>
        <p><em>The staff member agrees to maintain strict confidentiality regarding any personal, medical, or sensitive information pertaining to the Employer's family.</em></p>

        <p class="ayat-label">Ayat 11</p>
        <ol class="alpha-list">
            <li>Karyawan pekerja tidak diperbolehkan mengambil foto atau video anggota keluarga Pemberi Kerja tanpa persetujuan tertulis dari Pemberi Kerja.</li>
            <li>Karyawan pekerja juga setuju untuk tidak memposting foto atau informasi terkait keluarga Pemberi Kerja di media sosial atau platform publik dalam keadaan apa pun.</li>
            <li>Pelanggaran terhadap perjanjian kerahasiaan ini dianggap sebagai pelanggaran kontrak, dan Pemberi Kerja berhak memutuskan hubungan kerja secara langsung tanpa kompensasi.</li>
            <li>Selain itu, karyawan pekerja memahami bahwa setiap pelanggaran kerahasiaan dapat mengakibatkan konsekuensi hukum, termasuk namun tidak terbatas pada denda finansial atau tindakan hukum.</li>
            <li>Karyawan pekerja juga dilarang membicarakan urusan keluarga, kondisi anak, atau informasi rumah tangga kepada pihak luar tanpa izin tertulis dari Pemberi Kerja.</li>
            <li>Pekerja dilarang keras berkomunikasi dengan tamu yang datang ke rumah keluarga dan tidak boleh terlibat dalam percakapan dengan mereka. Fokus utama Pekerja harus selalu tertuju pada anak, memastikan pengasuhan dan pengawasannya. Pekerja setuju untuk bertindak dengan profesionalisme tinggi dan menjaga kerahasiaan penuh setiap saat.</li>
            <li>Selain itu, Pekerja setuju untuk tidak membagikan informasi kontak, nomor telepon, atau informasi pribadi keluarga kepada siapa pun dalam keadaan apa pun. Setiap pelanggaran ketentuan ini akan dianggap sebagai pelanggaran serius terhadap kerahasiaan dan dapat menyebabkan pemutusan hubungan kerja secara langsung tanpa kompensasi, serta konsekuensi hukum.</li>
        </ol>
        <p class="para-label">Paragraph 11</p>
        <ol class="alpha-list">
            <li><em>The staff member is not permitted to take photos or videos of the Employer's family members without explicit written consent from the Employer.</em></li>
            <li><em>Additionally, the staff member agrees not to post any photos or information related to the Employer's family on social media or public platforms under any circumstances.</em></li>
            <li><em>Failure to adhere to this confidentiality agreement constitutes a breach of contract, and the Employer reserves the right to terminate the staff member's employment immediately without compensation.</em></li>
            <li><em>Furthermore, the staff member acknowledges that any breach of confidentiality may result in legal consequences, including but not limited to financial penalties or legal action.</em></li>
            <li><em>The staff member is also prohibited from discussing private family matters, the child's condition, or any household-related information with external parties without explicit written permission from the Employer.</em></li>
            <li><em>The staff member is strictly prohibited from communicating with visitors to the family home and must not engage in discussions with them. The staff member's primary focus must always remain on the child, ensuring their care and supervision. The staff member agrees to act with the utmost professionalism and maintain strict privacy at all times.</em></li>
            <li><em>Additionally, the staff member agrees not to share the family's contact details, phone numbers, or any personal information with anyone under any circumstances. Any breach of this provision will be considered a serious violation of confidentiality and may lead to immediate termination without compensation, as well as potential legal consequences.</em></li>
        </ol>
    @endif

    <div class="article-head">
        <p class="article-number">PASAL 11 / <em>ARTICLE 11</em></p>
        <p class="article-title">KLAUSUL PERSETUJUAN MEDIA DAN KONTEN / <em>MEDIA AND CONTENT CONSENT CLAUSE</em></p>
    </div>
    <p class="ayat-label">Ayat 1</p>
    <p>Karyawan menyetujui bahwa Staff Link dapat, dari waktu ke waktu, mengambil foto atau video Karyawan untuk keperluan bisnis, pemasaran, atau media sosial. Karyawan dengan ini memberikan persetujuan dan izin penuh kepada Staff Link untuk menggunakan, mempublikasikan, menggandakan, dan mendistribusikan konten tersebut dalam bentuk media apa pun, baik yang telah dikenal saat ini maupun yang akan dikembangkan di kemudian hari, tanpa adanya kompensasi tambahan apa pun.</p>
    <p class="para-label">Paragraph 1</p>
    <p><em>The staff member agrees that Staff Link may, from time to time, take photographs or videos of them for business, marketing, or social media purposes. The staff member hereby grants full consent and permission to Staff Link to use, publish, reproduce, and distribute such content in any form of media, whether now known or hereafter developed, without any further compensation.</em></p>

    <p class="ayat-label">Ayat 2</p>
    <p>Seluruh foto, video, dan konten media lainnya yang dihasilkan merupakan dan akan tetap menjadi milik eksklusif Staff Link, dengan seluruh hak dilindungi. Kepemilikan dan persetujuan ini tetap berlaku meskipun hubungan kerja Karyawan telah berakhir, baik karena pengunduran diri maupun pemutusan hubungan kerja.</p>
    <p class="para-label">Paragraph 2</p>
    <p><em>All photographs, videos, and other media content produced shall remain the sole property of Staff Link, with all rights reserved. This ownership and consent shall continue to apply even after the Employee's resignation or termination of employment.</em></p>

    <p class="ayat-label">Ayat 3</p>
    <p>Dengan menandatangani Kontrak ini, Karyawan menyatakan telah membaca, memahami, dan sepenuhnya menyetujui ketentuan-ketentuan tersebut di atas.</p>
    <p class="para-label">Paragraph 3</p>
    <p><em>By signing this contract, you fully consent and agree to these terms.</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 12 / <em>ARTICLE 12</em></p>
        <p class="article-title">PERUBAHAN KETENTUAN DAN KETERPISAHAN / <em>VARIATION OF TERMS AND SEVERABILITY</em></p>
    </div>
    <p class="ayat-label">Ayat 1</p>
    <p>Ketentuan-ketentuan dalam Kontrak ini dapat diubah, ditambah, atau diperbarui dari waktu ke waktu berdasarkan kesepakatan tertulis bersama antara PIHAK PERTAMA dan PIHAK KEDUA.</p>
    <p class="para-label">Paragraph 1</p>
    <p><em>The terms of this Contract may be varied, amended, or updated from time to time by mutual written agreement between the EMPLOYER and the EMPLOYEE.</em></p>

    <p class="ayat-label">Ayat 2</p>
    <p>Apabila terdapat satu atau lebih ketentuan dalam Kontrak ini yang dinyatakan tidak sah, batal, atau dapat dibatalkan berdasarkan peraturan perundang-undangan atau ketentuan hukum yang berlaku, maka ketentuan tersebut dianggap dipisahkan (severed) dari Kontrak ini.</p>
    <p class="para-label">Paragraph 2</p>
    <p><em>If any provision of this Contract is held to be invalid, void, or voidable by reason of any statute or rule of law, such provision shall be deemed severed from this Contract.</em></p>

    <p class="ayat-label">Ayat 3</p>
    <p>Pemisahan sebagaimana dimaksud pada Ayat (2) tidak mempengaruhi keabsahan, keberlakuan, dan kekuatan hukum dari ketentuan lainnya dalam Kontrak ini, yang tetap berlaku sepenuhnya dan mengikat para pihak.</p>
    <p class="para-label">Paragraph 3</p>
    <p><em>Such severance shall not affect the validity, enforceability, or legal effect of the remaining provisions of this Contract, which shall continue in full force and effect.</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 13 / <em>ARTICLE 13</em></p>
        <p class="article-title">BERAKHIRNYA PERJANJIAN / <em>TERMINATION OF THE AGREEMENT</em></p>
    </div>
    <p>Selain sebagaimana diatur dalam ayat-ayat pada Pasal 8 Perjanjian ini, Perjanjian Kerja ini akan berakhir dengan sendirinya apabila PIHAK KEDUA meninggal dunia.</p>
    <p><em>In addition to the provisions stipulated in the clauses of Article 8 of this Agreement, this Employment Agreement shall automatically terminate if the EMPLOYEE passes away.</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 14 / <em>ARTICLE 14</em></p>
        <p class="article-title">KEADAAN DARURAT / <em>FORCE MAJEURE</em></p>
    </div>
    <p>Perjanjian kerja ini batal dengan sendirinya jika karena keadaan atau situasi yang memaksa, seperti: bencana alam, pemberontakan, perang, huru-hara, kerusuhan, Peraturan Pemerintah atau apapun yang mengakibatkan perjanjian kerja ini tidak mungkin lagi untuk diwujudkan.</p>
    <p><em>This Employment Agreement shall be deemed null and void by operation of law in the event of force majeure circumstances, including but not limited to natural disasters, rebellion, war, riots, civil unrest, Government Regulations, or any other events that render the performance of this Employment Agreement impossible.</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 15 / <em>ARTICLE 15</em></p>
        <p class="article-title">PENYELESAIAN PERSELISIHAN / <em>DISPUTE RESOLUTION</em></p>
    </div>
    <p>Setiap perselisihan yang terkait dengan kontrak ini akan diselesaikan melalui mediasi internal. Jika tidak terselesaikan, proses hukum dapat dilakukan berdasarkan hukum ketenagakerjaan Indonesia melalui lembaga hubungan industrial yang berwenang di Bali.</p>
    <p><em>Any dispute relating to this contract shall be resolved through internal mediation. If unresolved, legal proceedings may be brought under Indonesian labor law through the appropriate industrial relations authority in Bali.</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 16 / <em>ARTICLE 16</em></p>
        <p class="article-title">BAHASA / <em>LANGUAGE</em></p>
    </div>
    <p>Perjanjian kerja ini dibuat dalam Bahasa Inggris dan Bahasa Indonesia. Jika terjadi perbedaan antara teks Bahasa Inggris dan teks Bahasa Indonesia, maka {{ $data['language_law_id'] ?? 'teks Bahasa Inggris yang berlaku' }} dan mengikat para pihak.</p>
    <p><em>Contract Agreement is made in English and in Bahasa. In the event of any conflict between the English text and the Indonesian text, {{ $data['language_law'] ?? 'English text shall prevail' }} and bind the parties.</em></p>

    <div class="article-head">
        <p class="article-number">PASAL 17 / <em>ARTICLE 17</em></p>
        <p class="article-title">PENUTUP / <em>CLOSING</em></p>
    </div>
    <p>Demikianlah perjanjian ini dibuat, disetujui, dan ditandatangani dalam rangkap dua, asli dan tembusan bermaterei cukup dan berkekuatan hukum yang sama. Satu dipegang oleh PIHAK PERTAMA dan lainnya untuk PIHAK KEDUA.</p>
    <p><em>This Agreement is made, agreed, and signed in two (2) counterparts, consisting of an original and a copy, duly affixed with sufficient stamp duty and having equal legal force. One counterpart shall be retained by the EMPLOYER and the other by the EMPLOYEE.</em></p>

    @if ($data['additional_terms'])
        <h2><em>ADDITIONAL TERMS</em> / KETENTUAN TAMBAHAN</h2>
        <p>{!! nl2br(e($data['additional_terms'])) !!}</p>
    @endif

    <p class="small"><em>Language Law</em> / Hukum Bahasa: {{ $data['language_law'] ?? 'English text shall prevail' }} / {{ $data['language_law_id'] ?? 'teks Bahasa Inggris yang berlaku' }}</p>
    <p class="small"><em>Governing Law</em> / Hukum yang Berlaku: {{ $data['governing_law'] }}</p>

    <table class="signature">
        <tr>
            <td>
                <strong><em>THE EMPLOYER</em> / PIHAK PERTAMA</strong>
                <div class="line"></div>
                <p><em>Name:</em> {{ $data['sign_employer_name'] }}</p>
                <p><em>Date:</em> __________________</p>
            </td>
            <td>
                <strong><em>THE EMPLOYEE</em> / PIHAK KEDUA</strong>
                <div class="line"></div>
                <p><em>Name:</em> {{ $data['sign_employee_name'] }}</p>
                <p><em>Date:</em> __________________</p>
            </td>
        </tr>
    </table>
</body>
</html>
