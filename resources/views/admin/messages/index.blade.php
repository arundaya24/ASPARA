<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .page-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .page-header h1 small {
        font-size: 0.9rem;
        font-weight: 400;
        color: #64748b;
        margin-left: 8px;
    }
    .badge-unread {
        background: #ef4444;
        color: #fff;
        padding: 2px 10px;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 600;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    .status-badge {
        display: inline-block;
        padding: 3px 14px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .status-unread { background: #fee2e2; color: #991b1b; }
    .status-read { background: #dbeafe; color: #1d4ed8; }
    .status-replied { background: #dcfce7; color: #166534; }
    .admin-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        padding: 22px 26px;
        border: 1px solid #f1f5f9;
    }
    .table-wrapper {
        overflow-x: auto;
    }
    .admin-table {
        width: 100%;
        font-size: 0.9rem;
        border-collapse: collapse;
    }
    .admin-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        white-space: nowrap;
    }
    .admin-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        background: #fff;
    }
    .admin-table tbody tr:hover td {
        background: #f8fafc;
    }
    .btn-sm {
        padding: 4px 12px;
        font-size: 0.75rem;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        text-decoration: none;
    }
    .btn-sm.btn-view { background: #dbeafe; color: #1d4ed8; }
    .btn-sm.btn-view:hover { background: #bfdbfe; }
    .btn-sm.btn-delete { background: #fee2e2; color: #b91c1c; }
    .btn-sm.btn-delete:hover { background: #fecaca; }
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
        box-shadow: 0 4px 12px rgba(16,185,129,0.25);
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
    .btn-danger {
        background: #ef4444;
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
    }
    .btn-danger:hover {
        background: #dc2626;
    }
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #94a3b8;
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
    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
    .message-actions {
        display: flex;
        gap: 6px;
        align-items: center;
        flex-wrap: wrap;
    }
    .message-actions .btn-icon {
        background: none;
        border: none;
        cursor: pointer;
        color: #94a3b8;
        transition: all 0.2s;
        padding: 4px 6px;
        border-radius: 6px;
    }
    .message-actions .btn-icon:hover {
        color: #ef4444;
        background: #fee2e2;
    }
    .message-actions .btn-icon i {
        font-size: 1.1rem;
    }
</style>

<div>
    <!-- ===== HEADER ===== -->
    <div class="page-header">
        <h1>📩 Pesan Masuk <small>Dari pengguna</small></h1>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <span style="background:#f1f5f9;padding:6px 16px;border-radius:40px;font-size:0.85rem;font-weight:600;">
                Belum Dibaca: <span style="color:#ef4444;" id="unreadCountDisplay">{{ $unreadCount ?? 0 }}</span>
            </span>
            <form action="{{ route('admin.messages.mark-all-read') }}" method="POST" style="display:inline;" id="markAllReadForm">
                @csrf
                <button type="submit" class="btn-secondary" style="padding:6px 16px;font-size:0.85rem;">
                    <i class="fas fa-check-double"></i> Tandai Semua Telah Dibaca
                </button>
            </form>
            <form action="{{ route('admin.messages.destroy-all') }}" method="POST" style="display:inline;" id="deleteAllForm" onsubmit="return confirm('Yakin ingin menghapus SEMUA pesan?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger" style="padding:6px 16px;font-size:0.85rem;">
                    <i class="fas fa-trash"></i> Hapus Semua Pesan
                </button>
            </form>
        </div>
    </div>

    <!-- ===== ALERT ===== -->
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

    <!-- ===== TABLE ===== -->
    <div class="admin-card">
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pengirim</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="messageTableBody">
                    @forelse ($messages as $msg)
                        <tr id="message-row-{{ $msg->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $msg->name }}</strong>
                                @if ($msg->status === 'unread')
                                    <span class="badge-unread">Baru</span>
                                @endif
                            </td>
                            <td>{{ $msg->email }}</td>
                            <td>
                                <a href="{{ route('admin.messages.show', $msg->id) }}" style="color:#1e293b;text-decoration:none;">
                                    {{ Str::limit($msg->message, 50) }}
                                </a>
                            </td>
                            <td>
                                @php
                                    $statusClass = $msg->status === 'unread' ? 'status-unread' : ($msg->status === 'read' ? 'status-read' : 'status-replied');
                                    $statusLabel = $msg->status === 'unread' ? 'Belum Dibaca' : ($msg->status === 'read' ? 'Sudah Dibaca' : 'Sudah Dibalas');
                                @endphp
                                <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                            </td>
                            <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="message-actions">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn-sm btn-view">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" style="display:inline-block;" class="delete-message-form" data-id="{{ $msg->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon" title="Hapus pesan" onclick="return confirm('Yakin hapus pesan ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-state">
                                <i class="fas fa-inbox fa-2x" style="display:block;margin-bottom:8px;color:#cbd5e1;"></i>
                                Belum ada pesan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            @if (method_exists($messages, 'links'))
                {{ $messages->links() }}
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== CSRF Token =====
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // ===== MARK ALL READ (AJAX) =====
        const markAllReadForm = document.getElementById('markAllReadForm');
        if (markAllReadForm) {
            markAllReadForm.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!confirm('Tandai semua pesan sebagai sudah dibaca?')) {
                    return;
                }

                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update badge unread
                        updateUnreadBadge();

                        // Update tampilan jumlah unread
                        const unreadDisplay = document.getElementById('unreadCountDisplay');
                        if (unreadDisplay) unreadDisplay.textContent = '0';

                        // Update semua status di tabel
                        document.querySelectorAll('#messageTableBody tr').forEach(row => {
                            const statusBadge = row.querySelector('.status-badge');
                            if (statusBadge) {
                                const isUnread = statusBadge.classList.contains('status-unread');
                                if (isUnread) {
                                    statusBadge.className = 'status-badge status-read';
                                    statusBadge.textContent = 'Sudah Dibaca';
                                }
                            }
                            const badgeUnread = row.querySelector('.badge-unread');
                            if (badgeUnread) badgeUnread.remove();
                        });

                        showAlert('success', 'Semua pesan telah ditandai sebagai sudah dibaca!');
                    } else {
                        showAlert('error', data.message || 'Gagal menandai semua pesan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', 'Terjadi kesalahan. Silakan coba lagi.');
                });
            });
        }

        // ===== DELETE SINGLE MESSAGE (AJAX) =====
        document.querySelectorAll('.delete-message-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const messageId = this.dataset.id;
                const row = document.getElementById('message-row-' + messageId);

                if (!confirm('Yakin ingin menghapus pesan ini?')) {
                    return;
                }

                fetch(this.action, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hapus baris dari tabel
                        if (row) row.remove();

                        // Update badge unread
                        updateUnreadBadge();

                        // Update jumlah unread di header
                        fetch('/admin/api/unread-count', {
                            headers: { 'Accept': 'application/json' }
                        })
                        .then(res => res.json())
                        .then(countData => {
                            const unreadDisplay = document.getElementById('unreadCountDisplay');
                            if (unreadDisplay) unreadDisplay.textContent = countData.count || 0;
                        });

                        // Cek jika tidak ada pesan lagi
                        const remainingRows = document.querySelectorAll('#messageTableBody tr');
                        if (remainingRows.length === 0) {
                            const tbody = document.getElementById('messageTableBody');
                            tbody.innerHTML = `
                                <tr>
                                    <td colspan="7" class="empty-state">
                                        <i class="fas fa-inbox fa-2x" style="display:block;margin-bottom:8px;color:#cbd5e1;"></i>
                                        Belum ada pesan masuk.
                                    </td>
                                </tr>
                            `;
                        }

                        showAlert('success', 'Pesan berhasil dihapus!');
                    } else {
                        showAlert('error', data.message || 'Gagal menghapus pesan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', 'Terjadi kesalahan. Silakan coba lagi.');
                });
            });
        });

        // ===== SHOW ALERT FUNCTION =====
        function showAlert(type, message) {
            const container = document.getElementById('alertContainer');
            const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

            // Hapus alert lama
            container.innerHTML = '';

            // Buat alert baru
            const alertDiv = document.createElement('div');
            alertDiv.className = alertClass;
            alertDiv.innerHTML = `
                <i class="fas ${icon}"></i>
                <span>${message}</span>
            `;

            container.appendChild(alertDiv);

            // Auto hilang setelah 5 detik
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.style.opacity = '0';
                    alertDiv.style.transition = 'opacity 0.5s';
                    setTimeout(() => {
                        if (alertDiv.parentNode) alertDiv.remove();
                    }, 500);
                }
            }, 5000);
        }

        // ===== DELETE ALL (AJAX) =====
        const deleteAllForm = document.getElementById('deleteAllForm');
        if (deleteAllForm) {
            deleteAllForm.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!confirm('Yakin ingin menghapus SEMUA pesan? Tindakan ini tidak dapat dibatalkan!')) {
                    return;
                }

                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Kosongkan tabel
                        const tbody = document.getElementById('messageTableBody');
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fas fa-inbox fa-2x" style="display:block;margin-bottom:8px;color:#cbd5e1;"></i>
                                    Belum ada pesan masuk.
                                </td>
                            </tr>
                        `;

                        // Update badge unread
                        updateUnreadBadge();

                        const unreadDisplay = document.getElementById('unreadCountDisplay');
                        if (unreadDisplay) unreadDisplay.textContent = '0';

                        showAlert('success', 'Semua pesan berhasil dihapus!');
                    } else {
                        showAlert('error', data.message || 'Gagal menghapus semua pesan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', 'Terjadi kesalahan. Silakan coba lagi.');
                });
            });
        }
    });
</script>
