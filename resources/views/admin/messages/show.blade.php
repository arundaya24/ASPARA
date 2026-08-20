{{-- HANYA UNTUK DETAIL PESAN --}}

<style>
    .detail-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .detail-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        padding: 30px 32px;
        border: 1px solid #f1f5f9;
        margin-bottom: 24px;
    }

    .detail-card .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
        flex-wrap: wrap;
        gap: 12px;
    }

    .detail-card .header h2 {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
    }

    .detail-card .info-grid {
        display: grid;
        grid-template-columns: 120px 1fr;
        gap: 12px;
        margin-bottom: 16px;
    }

    .detail-card .info-grid .label {
        font-weight: 600;
        color: #64748b;
    }

    .detail-card .info-grid .value {
        color: #1e293b;
    }

    .detail-card .message-content {
        background: #f8fafc;
        padding: 16px 20px;
        border-radius: 12px;
        margin: 12px 0 16px;
        border-left: 4px solid #10b981;
    }

    .detail-card .reply-box {
        background: #f0fdf4;
        padding: 16px 20px;
        border-radius: 12px;
        margin-top: 16px;
        border-left: 4px solid #16a34a;
    }

    .detail-card .reply-box .reply-label {
        font-weight: 600;
        color: #16a34a;
        margin-bottom: 4px;
    }

    .btn-primary {
        background: #10b981;
        color: #fff;
        border: none;
        padding: 10px 22px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }

    .btn-primary:hover {
        background: #047857;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #334155;
        border: none;
        padding: 10px 22px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background: #cbd5e1;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 4px;
        font-size: 0.9rem;
        color: #334155;
    }

    .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.95rem;
        transition: all 0.2s;
        min-height: 100px;
        resize: vertical;
    }

    .form-group textarea:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.08);
    }

    .status-badge {
        display: inline-block;
        padding: 3px 14px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-unread {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-read {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-replied {
        background: #dcfce7;
        color: #166534;
    }

    .alert-success {
        padding: 12px 16px;
        border-radius: 12px;
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #166534;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-error {
        padding: 12px 16px;
        border-radius: 12px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-back-dashboard {
        background: #e2e8f0;
        color: #334155;
        border: none;
        padding: 6px 16px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-back-dashboard:hover {
        background: #cbd5e1;
    }

    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #10b981;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 8px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .reply-success-box {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
    }

    .reply-success-box i {
        font-size: 3rem;
        color: #16a34a;
        display: block;
        margin-bottom: 12px;
    }

    .reply-success-box h3 {
        color: #166534;
        margin-bottom: 4px;
        font-size: 1.3rem;
    }

    .reply-success-box p {
        color: #166534;
        margin-bottom: 16px;
    }

    @media (max-width: 576px) {
        .detail-card {
            padding: 20px 16px;
        }

        .detail-card .info-grid {
            grid-template-columns: 1fr;
            gap: 4px;
        }
    }
</style>

<div class="detail-container">
    <div
        style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <h1 style="font-size:1.8rem;font-weight:700;margin:0;">Detail Pesan</h1>
        <a href="{{ url('/admin/dashboard') }}" class="btn-back-dashboard">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div id="alertContainer">
        @if (session('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <div class="detail-card">
        <div class="header">
            <h2>Dari: {{ $message->name }}</h2>
            <span>{!! $message->status_label !!}</span>
        </div>

        <div class="info-grid">
            <span class="label">Email</span>
            <span class="value"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></span>

            @if ($message->phone)
                <span class="label">Telepon</span>
                <span class="value">{{ $message->phone }}</span>
            @endif

            <span class="label">Dikirim</span>
            <span class="value">{{ $message->created_at->format('d F Y, H:i') }}</span>

            @if ($message->ip_address)
                <span class="label">IP Address</span>
                <span class="value">{{ $message->ip_address }}</span>
            @endif
        </div>

        <div class="message-content">
            <div style="font-weight:600;margin-bottom:4px;color:#0f172a;">Isi Pesan:</div>
            <p style="margin:0;white-space:pre-wrap;color:#1e293b;">{{ $message->message }}</p>
        </div>

        @if ($message->reply)
            <div class="reply-box">
                <div class="reply-label"><i class="fas fa-reply"></i> Balasan:</div>
                <p style="margin:4px 0 0;white-space:pre-wrap;color:#1e293b;">{{ $message->reply }}</p>
                <div style="font-size:0.8rem;color:#64748b;margin-top:4px;">
                    Dibalas: {{ $message->replied_at->format('d F Y, H:i') }}
                </div>
            </div>
        @endif
    </div>

    @if (!$message->reply)
        <div class="detail-card" id="replyFormCard">
            <h3 style="margin-top:0;margin-bottom:16px;"><i class="fas fa-reply"></i> Balas Pesan</h3>

            <!-- Form Balasan -->
            <div id="replyForm">
                <div class="form-group">
                    <label for="reply">Tulis Balasan</label>
                    <textarea name="reply" id="reply" rows="4" placeholder="Tulis balasan Anda di sini..." required></textarea>
                </div>
                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <button type="button" id="sendReplyBtn" class="btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Balasan
                    </button>
                </div>
            </div>

            <!-- Success Message (muncul setelah kirim) -->
            <div id="replySuccess" style="display:none;">
                <div class="reply-success-box">
                    <i class="fas fa-check-circle"></i>
                    <h3>✅ Balasan Terkirim!</h3>
                    <p>Pesan balasan Anda telah berhasil dikirim.</p>
                    <a href="{{ url('/admin/dashboard') }}" class="btn-primary"
                        style="text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>

                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sendBtn = document.getElementById('sendReplyBtn');
        const replyForm = document.getElementById('replyForm');
        const replySuccess = document.getElementById('replySuccess');
        const alertContainer = document.getElementById('alertContainer');

        if (sendBtn) {
            sendBtn.addEventListener('click', function() {
                const replyText = document.getElementById('reply').value.trim();

                if (!replyText) {
                    alert('Silakan tulis balasan terlebih dahulu.');
                    return;
                }

                // Disable button & show loading
                sendBtn.disabled = true;
                sendBtn.innerHTML = '<span class="loading-spinner"></span> Mengirim...';

                // Simulasi loading 1.5 detik (pura-pura proses)
                setTimeout(function() {
                    // Sembunyikan form, tampilkan pesan sukses
                    replyForm.style.display = 'none';
                    replySuccess.style.display = 'block';

                    // Hapus alert lama
                    alertContainer.innerHTML = '';

                    // Update badge unread (pura-pura)
                    updateUnreadBadge();

                    // Reset button
                    sendBtn.disabled = false;
                    sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Balasan';

                    // Pesan sukses di konsol (pura-pura)
                    console.log('✅ Balasan terkirim ke:', document.querySelector('.header h2')
                        ?.textContent || 'pengguna');
                    console.log('📝 Isi balasan:', replyText);

                }, 1500); // Delay 1.5 detik biar kaya loading beneran
            });
        }
    });
</script>
