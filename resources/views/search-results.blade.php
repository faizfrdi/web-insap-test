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
                @if ($faqJasaKonstruksis->isNotEmpty() || $faqJasaKonstruksisPs->isNotEmpty() || $faqJasaKonstruksisFi->isNotEmpty() || $faqJasaKonstruksisCoFm->isNotEmpty() || $faqJasaKonstruksisMm->isNotEmpty() || $faqJasaKonstruksisSd->isNotEmpty())
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

            <!-- Hasil Pencarian Info - General-->
            <div class="search-section">
                @if ($infoGenerals->isNotEmpty())
                    <h4>General UPDATES</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($infoGenerals as $info_general)
                            @php
                                $highlightedReport = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $info_general->report);
                                $highlightedStatus = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $info_general->status);
                                $highlightedDescription = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $info_general->description);
                            @endphp
                            <div class="col mb-4">
                                <a href="{{ url('/info/fico-fm/' . $info_general->id) }}" class="text-decoration-none text-dark">
                                    <div class="card" style="border-radius: 10px; overflow: hidden; background-color: #add8e6;">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! $highlightedReport !!}</h5>
                                            <div class="divider"></div>
                                            <p class="card-answer"><strong>Status:</strong> {!! $highlightedStatus !!}</p>
                                            <p class="card-answer"><strong>Deskripsi:</strong> {!! $highlightedDescription !!}</p>
                                            <p class="card-answer"><strong>Update terakhir:</strong> {{ $info_general->updated_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian FICO / FM -->
            <div class="search-section">
                @if ($ficofmReports->isNotEmpty())
                    <h4>FICO/FM UPDATES</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($ficofmReports as $fico_fm)
                            @php
                                $highlightedReport = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $fico_fm->report);
                                $highlightedStatus = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $fico_fm->status);
                                $highlightedDescription = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $fico_fm->description);
                            @endphp
                            <div class="col mb-4">
                                <a href="{{ url('/info/fico-fm/' . $fico_fm->id) }}" class="text-decoration-none text-dark">
                                    <div class="card" style="border-radius: 10px; overflow: hidden; background-color: #ff0404;">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! $highlightedReport !!}</h5>
                                            <div class="divider"></div>
                                            <p class="card-answer"><strong>Status:</strong> {!! $highlightedStatus !!}</p>
                                            <p class="card-answer"><strong>Deskripsi:</strong> {!! $highlightedDescription !!}</p>
                                            <p class="card-answer"><strong>Update terakhir:</strong> {{ $fico_fm->updated_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>          

            <!-- Hasil Pencarian PS -->
            <div class="search-section">
                @if ($psReports->isNotEmpty())
                    <h4>PS UPDATES</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($psReports as $ps)
                            @php
                                $highlightedReport = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $ps->report);
                                $highlightedStatus = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $ps->status);
                                $highlightedDescription = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $ps->description);
                            @endphp
                            <div class="col mb-4">
                                <a href="{{ url('/info/ps/' . $ps->id) }}" class="text-decoration-none text-dark">
                                    <div class="card" style="border-radius: 10px; overflow: hidden; background-color: #aeeff0;">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! $highlightedReport !!}</h5>
                                            <div class="divider"></div>
                                            <p class="card-answer"><strong>Status:</strong> {!! $highlightedStatus !!}</p>
                                            <p class="card-answer"><strong>Deskripsi:</strong> {!! $highlightedDescription !!}</p>
                                            <p class="card-answer"><strong>Update terakhir:</strong> {{ $ps->updated_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian SD --> 
            <div class="search-section">
                @if ($sdReports->isNotEmpty())
                    <h4>SD UPDATES</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($sdReports as $sd)
                            @php
                                $highlightedReport = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $sd->report);
                                $highlightedStatus = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $sd->status);
                                $highlightedDescription = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $sd->description);
                            @endphp
                            <div class="col mb-4">
                                <a href="{{ url('/info/sd/' . $sd->id) }}" class="text-decoration-none text-dark">
                                    <div class="card" style="border-radius: 10px; overflow: hidden; background-color: #90c44c;">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! $highlightedReport !!}</h5>
                                            <div class="divider"></div>
                                            <p class="card-answer"><strong>Status:</strong> {!! $highlightedStatus !!}</p>
                                            <p class="card-answer"><strong>Deskripsi:</strong> {!! $highlightedDescription !!}</p>
                                            <p class="card-answer"><strong>Update terakhir:</strong> {{ $sd->updated_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hasil Pencarian MM-->
            <div class="search-section">
                @if ($mmReports->isNotEmpty())
                    <h4>MM UPDATES</h4>
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($mmReports as $mm)
                            @php
                                $highlightedReport = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $mm->report);
                                $highlightedStatus = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $mm->status);
                                $highlightedDescription = preg_replace("/($query)/i", '<span class="highlight">$1</span>', $mm->description);
                            @endphp
                            <div class="col mb-4">
                                <a href="{{ url('/info/mm/' . $mm->id) }}" class="text-decoration-none text-dark">
                                    <div class="card" style="border-radius: 10px; overflow: hidden; background-color: #08b4f4;">
                                        <div class="card-body">
                                            <h5 class="card-title">{!! $highlightedReport !!}</h5>
                                            <div class="divider"></div>
                                            <p class="card-answer"><strong>Status:</strong> {!! $highlightedStatus !!}</p>
                                            <p class="card-answer"><strong>Deskripsi:</strong> {!! $highlightedDescription !!}</p>
                                            <p class="card-answer"><strong>Update terakhir:</strong> {{ $mm->updated_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </a>
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