@extends('layouts.layout')

@section('content')
    <div class="p-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">

        <h2 class="section-title text-center mb-4" style="font-size: min(24px, 5vw);">Chatbot ADHI</h2>

        <div class="row">
            <!-- Sidebar untuk desktop -->
            <div class="col-12 col-md-3 order-2 order-md-1 mb-4 mb-md-0">
                <div id="chat-sessions-list" class="sessions-sidebar border rounded p-3">
                    <!-- Daftar sesi akan dimuat di sini -->
                </div>
            </div>

            <!-- Area Chat untuk desktop dan mobile -->
            <div class="col-12 col-md-9 order-1 order-md-2">
                <div id="chat-container" class="border rounded p-3 mb-3" style="height: 400px; overflow-y: auto;">
                    <div id="empty-chat-message" class="text-center" style="color: rgba(0, 0, 0, 0.3); font-size: 24px; font-weight: 500;">
                        Halo, ada yang bisa saya bantu?
                    </div>
                </div>
                <form id="chat-form">
                    @csrf
                    <div class="input-group">
                        <input type="text" id="user-input" class="form-control" placeholder="Tanya di sini..." required>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                        <button id="voice-input-btn" class="btn btn-danger" type="button">
                            <i class="bi bi-mic"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tambahkan style responsif baru -->
    <style>
        /* Tambahkan di bagian style yang sudah ada */
        @media (max-width: 767px) {
            .content-card {
                padding: 15px; /* Sedikit padding lebih kecil di mobile */
            }
            
            .sessions-sidebar {
                max-height: 300px; /* Batasi tinggi sidebar di mobile */
                overflow-y: auto; /* Tambahkan scroll jika konten melebihi */
                margin-top: 20px; /* Tambahkan margin bawah di mobile */
            }
            
            #chat-container {
                height: 350px; /* Sesuaikan tinggi container di mobile */
            }
            
            .message {
                max-width: 85%; /* Sesuaikan lebar pesan di mobile */
            }
        }

        @media (min-width: 768px) {
            .sessions-sidebar {
                max-height: 450px; /* Batasi tinggi sidebar di desktop */
                overflow-y: auto; /* Tambahkan scroll jika konten melebihi */
            }
        }
    </style>

    <style>
        /* Efek hover untuk tombol "Obrolan Baru" */
        #new-chat-btn:hover {
            background-color: #087032 !important; /* Warna hijau lebih gelap */
            box-shadow: 0 0 10px rgba(0,0,0,0.3); /* Bayangan ringan */
            transition: all 0.3s ease;
        }

        /* Efek hover untuk tombol di modal konfirmasi */
        .modal .btn-secondary:hover {
            background-color: #6c757d !important; /* Warna abu-abu lebih gelap */
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .modal .btn-danger:hover {
            background-color: #a71d2a !important; /* Warna merah lebih gelap */
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        /* Content card styling */
        .content-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            padding: 24px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        /* Dark mode styles for content card */
        .dark-mode .content-card {
            background-color: #2d2d2d;
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .form-control:focus {
            box-shadow: none;
            outline: none;
        }

        /* Add these new styles for the speech button */
        .speech-btn {
            position: absolute;
            bottom: 5px;
            right: 35px; /* Position it to the left of copy button */
            background-color: transparent;
            border: none;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }
        .speech-btn:hover {
            opacity: 1;
        }
        .speech-btn.speaking {
            color: #007bff; /* Blue color when speaking */
        }
        
        /* Adjust copy button position */
        .copy-btn {
            right: 5px; /* Keep copy button on the far right */
        }

        .message {
            max-width: 70%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            position: relative;
        }
        .user-message {
            background-color: #e6f2ff;
            margin-left: auto;
        }
        .bot-message {
            background-color: #f0f0f0;
            margin-right: auto;
        }
        .smooth-appear {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .smooth-appear.show {
            opacity: 1;
            transform: translateY(0);
        }
        .loading-dots span {
            animation: bounce 2s infinite ease-in-out;
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #333;
            margin-right: 6px;
        }
        .loading-dots span:nth-child(2) {
            animation-delay: 0.16s;
        }
        .loading-dots span:nth-child(3) {
            animation-delay: 0.32s;
        }
        @keyframes bounce {
            0%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-8px);
            }
        }
        .copy-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: transparent;
            border: none;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }
        .copy-btn:hover {
            opacity: 1;
        }
        .pop-up-confirmation {
            position: absolute;
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            z-index: 9999;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .pop-up-confirmation.show {
            opacity: 1;
            visibility: visible;
        }
        
        .btn-primary {
            background-color: #007bff; /* Original primary color */
            border-color: #007bff; /* Original border color */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker, softer blue for hover */
            border-color: #0056b3; /* Match border color with the background */
        }

        #voice-input-btn {
            background-color: #dc3545; /* Original color for the mic button */
            color: white; /* Text color */
        }

        #voice-input-btn:hover,
        #voice-input-btn:focus {
            background-color: #c82333; /* Darker, softer red for hover */
            color: white; /* Keep text color white */
        }

        /* Tambahan untuk latar belakang saat mendengarkan */
        #voice-input-btn.listening {
            background-color: #ec1c24; /* Warna lebih terang saat dalam keadaan "Mendengarkan..." */
        }
        
        /* Style tambahan untuk sidebar sesi */
        .sessions-sidebar {
            max-height: 500px;
            overflow-y: auto;
        }
        .session-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 5px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .session-item button {
            margin-left: 5px;
        }

        .btn-close:focus {
            box-shadow: none;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.js"></script>

    <script>
    $(document).ready(function() {
        // Generate UUID function
        function generateUUID() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0, 
                    v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        // Get or create session ID
        function getSessionId() {
            let sessionId = localStorage.getItem('current_session_id');
            if (!sessionId) {
                sessionId = generateUUID();
                localStorage.setItem('current_session_id', sessionId);
            }
            return sessionId;
        }

        // Function to start a new chat
        function startNewChat() {
            localStorage.removeItem('current_session_id');
            $('#chat-container').empty(); // Hapus chat yang ada
            $('#empty-chat-message').show(); // Tampilkan pesan default
            addDefaultMessage(); // Tambahkan teks default
            loadChatSessions(); // Refresh daftar sesi
        }

        // Fungsi untuk menambahkan pesan default
        function addDefaultMessage() {
            $('#chat-container').html(`
                <div id="empty-chat-message" class="text-center" style="color: rgba(0, 0, 0, 0.3); font-size: 24px; font-weight: 500;">
                    Halo, ada yang bisa saya bantu?
                </div>
            `);
            scrollToBottom();
        }

        // Fungsi memuat daftar sesi
        function loadChatSessions() {
            axios.get('{{ route("chatbot.sessions") }}')
                .then(response => {
                    const sessionsList = $('#chat-sessions-list');
                    
                    // Pastikan tombol "Obrolan Baru" tetap ada
                    if ($('#new-chat-btn').length === 0) {
                        const newChatButton = `
                            <button id="new-chat-btn" class="btn btn-success w-100 mb-3">
                                <i class="bi bi-plus-circle me-2"></i>Obrolan Baru
                            </button>
                        `;
                        sessionsList.prepend(newChatButton);
                    }

                    // Temukan elemen setelah tombol "Obrolan Baru"
                    const sessionsContainer = $('<div id="sessions-container"></div>');
                    sessionsList.find('#sessions-container').remove(); // Hapus kontainer lama jika ada

                    const titleElement = $('<h6 class="text-center mb-3">Riwayat Obrolan</h6>');
                    sessionsContainer.append(titleElement);
                    
                    if (response.data.length === 0) {
                        sessionsContainer.append('<p class="text-center text-muted">Belum ada obrolan</p>');
                    } else {
                        response.data.forEach(session => {
                            const sessionItem = `
                                <div class="session-item">
                                    <div>
                                        <strong>${session.title || 'Obrolan Baru'}</strong>
                                        <div><small>${session.date}</small></div>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary load-history mb-2" data-session-id="${session.session_id}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-session" data-session-id="${session.session_id}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            `;
                            sessionsContainer.append(sessionItem);
                        });
                    }

                    // Tambahkan kontainer ke sidebar
                    sessionsList.append(sessionsContainer);

                    // Event handler untuk tombol lihat riwayat
                    $('.load-history').on('click', function() {
                        const sessionId = $(this).data('session-id');
                        loadChatHistory(sessionId);
                    });

                    // Event handler untuk tombol hapus sesi
                    $('.delete-session').on('click', function() {
                        const sessionId = $(this).data('session-id');
                        deleteSession(sessionId);
                    });

                    // Pastikan event handler untuk "Obrolan Baru" tetap ada
                    $('#new-chat-btn').on('click', function() {
                        startNewChat();
                    });
                })
                .catch(error => {
                    console.error('Gagal memuat sesi:', error);
                });
        }

        // Tambahkan event handler awal untuk "Obrolan Baru"
        $(document).ready(function() {
            $(document).on('click', '#new-chat-btn', function() {
                startNewChat();
            });
        });

        // Fungsi memuat riwayat chat
        function loadChatHistory(sessionId) {
            axios.get('{{ route("chatbot.history") }}', {
                params: { session_id: sessionId }
            })
            .then(response => {
                // Bersihkan kontainer chat
                $('#chat-container').empty();
                $('#empty-chat-message').hide();

                response.data.forEach(chat => {
                    // Tambahkan pesan user
                    addMessageToChat('Anda', chat.user_message, 'user-message');
                    
                    // Tambahkan respons bot
                    addSmoothBotMessage("Adhi's Bot", chat.bot_response);
                });
            })
            .catch(error => {
                console.error('Gagal memuat riwayat chat:', error);
            });
        }

        // Fungsi menghapus sesi dengan konfirmasi modal
        function deleteSession(sessionId) {
            // Buat modal konfirmasi
            const confirmModal = `
            <div class="modal fade" id="deleteSessionModal" tabindex="-1" aria-labelledby="deleteSessionModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="deleteSessionModalLabel">
                                Konfirmasi Hapus Riwayat Obrolan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus riwayat obrolan ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            `;

            // Tambahkan modal ke body jika belum ada
            if ($('#deleteSessionModal').length === 0) {
                $('body').append(confirmModal);
            }

            // Inisialisasi modal
            const modal = new bootstrap.Modal(document.getElementById('deleteSessionModal'));
            modal.show();

            // Event handler untuk konfirmasi hapus
            $('#confirmDeleteBtn').off('click').on('click', function() {

                // Tutup modal
                modal.hide();
                $('#deleteSessionModal').remove();
                $('.modal-backdrop').remove();

                // Lakukan request penghapusan
                axios.delete('{{ route("chatbot.delete-session") }}', {
                    data: { session_id: sessionId }
                })
                .then(response => {

                    // Tampilkan notifikasi bootstrap toast dengan gaya baru
                    const toastHtml = `
                        <div class="position-fixed" style="top: 103px; right: 20px; z-index: 1050;">
                            <div id="deleteSuccessToast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000" style="background-color: #089700;">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        <i class="bi bi-check-circle-fill me-2"></i> Riwayat obrolan berhasil dihapus.
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    `;

                    // Tambahkan toast ke body
                    $('body').append(toastHtml);
                    const toast = new bootstrap.Toast($('#deleteSuccessToast'), {
                        delay: 3000
                    });
                    toast.show();

                    // Mulai obrolan baru setelah penghapusan
                    startNewChat(); // <-- Tambahkan ini
                })
                .catch(error => {

                    console.error('Gagal menghapus sesi:', error);

                    // Tampilkan notifikasi error dengan gaya baru
                    const toastHtml = `
                        <div class="position-fixed" style="top: 70px; right: 20px; z-index: 1050;">
                            <div id="deleteFailedToast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000" style="background-color: #dc3545;">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Gagal menghapus riwayat obrolan.
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    `;

                    // Tambahkan toast ke body
                    $('body').append(toastHtml);
                    const toast = new bootstrap.Toast($('#deleteFailedToast'), {
                        delay: 3000
                    });
                    toast.show();
                });
            });
        }

        // Panggil fungsi load sessions saat halaman dimuat
        loadChatSessions();

        var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (SpeechRecognition) {
            const recognition = new SpeechRecognition();
            recognition.lang = 'id-ID';  // Bahasa Indonesia
            recognition.continuous = false;
            recognition.interimResults = true;

            $('#voice-input-btn').on('click', function() {
                recognition.start();
            });

            recognition.onstart = function() {
                console.log('Voice recognition started. You can speak now.');
                $('#voice-input-btn').prop('disabled', true).text('Mendengarkan...').addClass('listening');
            };

            recognition.onresult = function(event) {
                let interimTranscript = '';
                let finalTranscript = '';
                for (let i = 0; i < event.results.length; i++) {
                    const transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalTranscript += transcript;
                    } else {
                        interimTranscript += transcript;
                    }
                }
                $('#user-input').val(finalTranscript || interimTranscript);
            };

            recognition.onspeechend = function() {
                console.log('Voice recognition ended.');
                $('#voice-input-btn').prop('disabled', false).html('<i class="bi bi-mic"></i>');
                $('#chat-form').submit();
            };

            recognition.onerror = function(event) {
                console.error('Speech recognition error: ', event.error);
                $('#voice-input-btn').prop('disabled', false).html('<i class="bi bi-mic"></i>');
            };
        } else {
            console.log('Speech Recognition not supported');
            $('#voice-input-btn').prop('disabled', true).html('Not Supported');
        }

        // Handle pengiriman form chat
        $('#chat-form').on('submit', function(e) {
            e.preventDefault();
            var userInput = $('#user-input').val();
            if (userInput.trim() !== '') {
                // Sembunyikan teks "Belum ada obrolan"
                $('#empty-chat-message').hide();

                addMessageToChat('Anda', userInput, 'user-message');
                showLoadingMessage();

                // Send message with session ID
                $.ajax({
                    url: '{{ route("chatbot.response") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        message: userInput,
                        session_id: getSessionId()
                    },
                    success: function(response) {
                        console.log('Response received:', response);
                        if (response && response.message) {
                            setTimeout(function() {
                                removeLoadingMessage();
                                addSmoothBotMessage("Adhi's Bot", response.message);
                                
                                // Perbarui daftar sesi setelah mendapat respons
                                loadChatSessions();
                            }, 1500);
                        } else {
                            console.error('Invalid response format');
                            removeLoadingMessage();
                            addSmoothBotMessage("Adhi's Bot", 'Maaf, terjadi kesalahan. Silakan coba lagi.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.log('Response Text:', xhr.responseText);
                        removeLoadingMessage();
                        addSmoothBotMessage("Adhi's Bot", 'Maaf, terjadi kesalahan. Silakan coba lagi.');
                    }
                });
                $('#user-input').val('');
            }
        });

        // Fungsi untuk menambahkan pesan ke chat
        function addMessageToChat(sender, message, messageClass) {
            var $messageDiv = $('<div class="message ' + messageClass + '">' +
                '<strong>' + sender + ':</strong> ' +
                '<span class="user-text">' + message + '</span>' +
                '</div>');
            
            $('#chat-container').append($messageDiv);
            scrollToBottom();
        }

        // Fungsi untuk menambahkan pesan bot dengan animasi
        function addSmoothBotMessage(sender, message) {
            var $messageDiv = $('<div class="message bot-message smooth-appear">' +
                '<strong>' + sender + ':</strong> ' +
                '<span class="bot-text">' + message + '</span>' +
                '<button class="copy-btn" data-bs-toggle="tooltip">' +
                '<i class="bi bi-clipboard" style="font-size: 16px;"></i></button>' +
                '</div>');
            
            $('#chat-container').append($messageDiv);
            $messageDiv[0].offsetHeight; // Trigger reflow
            $messageDiv.addClass('show');
            scrollToBottom();

            // Inisialisasi tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        // Fungsi untuk menampilkan animasi loading
        function showLoadingMessage() {
            var $loadingDiv = $('<div id="loading-message" class="message bot-message loading-dots"><strong>Adhi\'s Bot:</strong> <span></span><span></span><span></span></div>');
            $('#chat-container').append($loadingDiv);
            scrollToBottom();
        }

        // Fungsi untuk menghapus pesan loading
        function removeLoadingMessage() {
            $('#loading-message').remove();
        }

        // Fungsi untuk scroll ke bawah
        function scrollToBottom() {
            $('#chat-container').scrollTop($('#chat-container')[0].scrollHeight);
        }

        // Event handler untuk tombol copy
        $('#chat-container').on('click', '.copy-btn', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const $text = $btn.siblings('.bot-text').text();
            
            // Salin teks ke clipboard
            navigator.clipboard.writeText($text).then(function() {
                // Tampilkan konfirmasi
                const $confirmation = $('<span class="pop-up-confirmation"><i class="bi bi-check-circle-fill me-2" style="color: white;"></i>Tersalin.</span>');
                $btn.append($confirmation);
                $confirmation.addClass('show');
                
                // Hilangkan konfirmasi setelah 2 detik
                setTimeout(function() {
                    $confirmation.removeClass('show');
                    setTimeout(function() {
                        $confirmation.remove();
                    }, 300);
                }, 2000);
            }).catch(function(err) {
                console.error('Gagal menyalin teks: ', err);
            });
        });
    });
    
    </script>
@endsection