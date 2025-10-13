@extends('layouts.layout')

@section('content')
    <div id="flow-section" class="text-left p-3 p-md-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">

        <div id="search-results">
            <h3 class='mb-4'>Hasil pencarian untuk: "{{ $query }}"</h3>

            <!-- Hasil Pencarian Jasa Konstruksi -->
            <div class="search-section">
                @if ($jasaKonstruksis->isNotEmpty())
                <h4>JASA KONSTRUKSI</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($jasaKonstruksis as $jasa_konstruksi)
                            @php
                                $moduleColors = [
                                    'FI Module' => '#ff0404',
                                    'PS Module' => '#aeeff0', 
                                    'SD Module' => '#90c44c',
                                    'CO/FM Module' => '#ff9ccc',
                                    'MM Module' => '#08b4f4'
                                ];

                                $backgroundColor = $moduleColors[$jasa_konstruksi->module] ?? '#ffffff';

                                // Tambahkan highlight untuk judul
                                $highlightedJudul = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $jasa_konstruksi->judul);
                            @endphp

                            <div class="col mb-4">
                                <a href="{{ route('scenarios.jasa-konstruksi', $jasa_konstruksi->slug) }}" class="text-decoration-none">
                                    <div class="card h-100 portfolio-card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: {{ $backgroundColor }}; background-size: cover; background-position: center;"> 
                                        <div class="card-body" style="background: rgba(255,255,255,0.15); color: black;">
                                            <h5 class="card-number">- {{ $jasa_konstruksi->urutan }} -</h5>
                                            <h5 class="card-title">{!! $highlightedJudul !!}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian Manufacturing -->
            <div class="search-section">
                @if ($manufacturings->isNotEmpty())
                <h4>MANUFACTURING</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($manufacturings as $manufacturing)
                            @php
                                $moduleColors = [
                                    'FI Module' => '#ff0404',
                                    'PS Module' => '#aeeff0', 
                                    'SD Module' => '#90c44c',
                                    'CO/FM Module' => '#ff9ccc',
                                    'MM Module' => '#08b4f4'
                                ];

                                $backgroundColor = $moduleColors[$manufacturing->module] ?? '#ffffff';

                                // Tambahkan highlight untuk judul
                                $highlightedJudul = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $manufacturing->judul);
                            @endphp

                            <div class="col mb-4">
                                <a href="{{ route('scenarios.manufacturing', $manufacturing->slug) }}" class="text-decoration-none">
                                    <div class="card h-100 portfolio-card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: {{ $backgroundColor }}; background-size: cover; background-position: center;"> 
                                        <div class="card-body" style="background: rgba(255,255,255,0.15); color: black;">
                                            <h5 class="card-number">- {{ $manufacturing->urutan }} -</h5>
                                            <h5 class="card-title">{!! $highlightedJudul !!}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian Jasa Non Konstruksi -->
            <div class="search-section">
                
                @if ($jasaNonKonstruksis->isNotEmpty())
                <h4>JASA NON KONSTRUKSI</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($jasaNonKonstruksis as $jasa_non_konstruksi)
                            @php
                                $moduleColors = [
                                    'FI Module' => '#ff0404',
                                    'PS Module' => '#aeeff0', 
                                    'SD Module' => '#90c44c',
                                    'CO/FM Module' => '#ff9ccc',
                                    'MM Module' => '#08b4f4'
                                ];

                                $backgroundColor = $moduleColors[$jasa_non_konstruksi->module] ?? '#ffffff';

                                // Tambahkan highlight untuk judul
                                $highlightedJudul = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $jasa_non_konstruksi->judul);
                            @endphp

                            <div class="col mb-4">
                                <a href="{{ route('scenarios.jasa-non-konstruksi', $jasa_non_konstruksi->slug) }}" class="text-decoration-none">
                                    <div class="card h-100 portfolio-card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: {{ $backgroundColor }}; background-size: cover; background-position: center;"> 
                                        <div class="card-body" style="background: rgba(255,255,255,0.15); color: black;">
                                            <h5 class="card-number">- {{ $jasa_non_konstruksi->urutan }} -</h5>
                                            <h5 class="card-title">{!! $highlightedJudul !!}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian Capex Procurement -->
            <div class="search-section">
                
                @if ($capexProcurements->isNotEmpty())
                <h4>CAPEX PROCUREMENT</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($capexProcurements as $capex_procurement)
                            @php
                                $moduleColors = [
                                    'FI Module' => '#ff0404',
                                    'PS Module' => '#aeeff0', 
                                    'SD Module' => '#90c44c',
                                    'CO/FM Module' => '#ff9ccc',
                                    'MM Module' => '#08b4f4'
                                ];

                                $backgroundColor = $moduleColors[$capex_procurement->module] ?? '#ffffff';

                                // Tambahkan highlight untuk judul
                                $highlightedJudul = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $capex_procurement->judul);
                            @endphp

                            <div class="col mb-4">
                                <a href="{{ route('scenarios.capex-procurement', $capex_procurement->slug) }}" class="text-decoration-none">
                                    <div class="card h-100 portfolio-card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: {{ $backgroundColor }}; background-size: cover; background-position: center;"> 
                                        <div class="card-body" style="background: rgba(255,255,255,0.15); color: black;">
                                            <h5 class="card-number">- {{ $capex_procurement->urutan }} -</h5>
                                            <h5 class="card-title">{!! $highlightedJudul !!}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian Internal Project -->
            <div class="search-section">
                
                @if ($internalProjects->isNotEmpty())
                <h4>INTERNAL PROJECT</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($internalProjects as $internal_project)
                            @php
                                $moduleColors = [
                                    'FI Module' => '#ff0404',
                                    'PS Module' => '#aeeff0', 
                                    'SD Module' => '#90c44c',
                                    'CO/FM Module' => '#ff9ccc',
                                    'MM Module' => '#08b4f4'
                                ];

                                $backgroundColor = $moduleColors[$internal_project->module] ?? '#ffffff';

                                // Tambahkan highlight untuk judul
                                $highlightedJudul = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $internal_project->judul);
                            @endphp

                            <div class="col mb-4">
                                <a href="{{ route('scenarios.internal-project', $internal_project->slug) }}" class="text-decoration-none">
                                    <div class="card h-100 portfolio-card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: {{ $backgroundColor }}; background-size: cover; background-position: center;"> 
                                        <div class="card-body" style="background: rgba(255,255,255,0.15); color: black;">
                                            <h5 class="card-number">- {{ $internal_project->urutan }} -</h5>
                                            <h5 class="card-title">{!! $highlightedJudul !!}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian FAQ General -->
            <div class="search-section">
                
                @if ($faqGenerals->isNotEmpty())
                <h4>FAQ GENERAL</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($faqGenerals as $faqGeneral)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqGeneral->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqGeneral->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian FAQ Jasa Konstruksi -->
            <div class="search-section">
                
                @if ($faqJasaKonstruksis->isNotEmpty() && $faqJasaKonstruksisPs->isNotEmpty() && $faqJasaKonstruksisFi->isNotEmpty() && $faqJasaKonstruksisCoFm->isNotEmpty() && $faqJasaKonstruksisMm->isNotEmpty() && $faqJasaKonstruksisSd->isNotEmpty())
                <h4>FAQ JASA KONSTRUKSI</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($faqJasaKonstruksis as $faqJasaKonstruksi)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksi->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksi->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($faqJasaKonstruksisPs as $faqJasaKonstruksiPs)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksiPs->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksiPs->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: #aeeff0; background-size: cover; background-position: center;">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($faqJasaKonstruksisFi as $faqJasaKonstruksiFi)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksiFi->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksiFi->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: #ff0404; background-size: cover; background-position: center;">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($faqJasaKonstruksisCoFm as $faqJasaKonstruksiCoFm)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksiCoFm->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksiCoFm->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: #ff9ccc; background-size: cover; background-position: center;">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($faqJasaKonstruksisMm as $faqJasaKonstruksiMm)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksiMm->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksiMm->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: #08b4f4; background-size: cover; background-position: center;">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($faqJasaKonstruksisSd as $faqJasaKonstruksiSd)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksiSd->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaKonstruksiSd->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: #90c44c; background-size: cover; background-position: center;">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian FAQ Manufacturing -->
            <div class="search-section">
                
                @if ($faqManufacturings->isNotEmpty())
                <h4>FAQ MANUFACTURING</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($faqManufacturings as $faqManufacturing)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqManufacturing->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqManufacturing->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian FAQ Jasa Non Konstruksi -->
            <div class="search-section">
                
                @if ($faqJasaNonKonstruksis->isNotEmpty())
                <h4>FAQ JASA NON KONSTRUKSI</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($faqJasaNonKonstruksis as $faqJasaNonKonstruksi)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaNonKonstruksi->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqJasaNonKonstruksi->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian FAQ Capex Procurement -->
            <div class="search-section">
                
                @if ($faqCapexProcurements->isNotEmpty())
                <h4>FAQ CAPEX PROCUREMENT</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($faqCapexProcurements as $faqCapexProcurement)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqCapexProcurement->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqCapexProcurement->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian FAQ Internal Project -->
            <div class="search-section">
                
                @if ($faqInternalProjects->isNotEmpty())
                <h4>FAQ INTERNAL PROJECT</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($faqInternalProjects as $faqInternalProject)
                            @php
                                // Tambahkan highlight untuk question dan answer
                                $highlightedQuestion = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqInternalProject->question);
                                $highlightedAnswer = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $faqInternalProject->answer);
                            @endphp
                            <div class="col mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-question">{!! $highlightedQuestion !!}</h5>
                                        <div class="divider"></div> 
                                        <p class="card-answer">{!! $highlightedAnswer !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Styling untuk divider atau garis pemisah */
        .divider {
            height: 1px;
            background-color: #000000; /* Warna garis */
            margin: 10px 0; /* Spasi sebelum dan sesudah garis */
            width: 100%; /* Memastikan garis memenuhi lebar card */
        }

        .card {
            width: 70%;
            transition: all 0.3s ease;
            background-color: #aeeff0; 
        }

        .card:hover {
            outline: none;
            transition: all 0.3s ease;
        }

        .card-number {
            font-size: 17px;
            line-height: 1.2;
            margin-bottom: 3px;
            text-align: center;
            font-weight: 500;
        }

        .card-question {
            text-align: center;
            font-size: 17px;
        }

        .card-answer {
            text-align: left;
            font-size: 15px;
        }

        .card-title {
            font-size: 15px;
            line-height: 1.2;
            font-weight: 500;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .highlight {
            background-color: yellow;
        }
    </style>
@endsection