<div class="visitor-drawer-header">
    <div class="visitor-drawer-title-box">
        <h5 class="visitor-drawer-title">Daftar Visitor</h5>
        <span class="visitor-drawer-subtitle">
            Tanggal: <strong><?= isset($selected_date) ? date('d-m-Y', strtotime($selected_date)) : ''; ?></strong> 
            (<?= count($visitors); ?> Pengunjung)
        </span>
    </div>
    <button type="button" class="visitor-drawer-close">&times;</button>
</div>

<div class="visitor-drawer-search-container">
    <div class="visitor-drawer-search-wrapper">
        <i class="fas fa-search visitor-drawer-search-icon"></i>
        <input type="text" id="visitorSearchInput" class="visitor-drawer-search-input" placeholder="Cari nama, NIM, atau prodi..." autocomplete="off">
    </div>
</div>

<div class="visitor-drawer-body">
    <?php 
    if (!empty($visitors)): 
        // Grouping
        $admins = [];
        $members = [];
        $alumni = [];
        
        foreach($visitors as $v) {
            if ($v->role_id == 2) {
                $members[] = $v;
            } elseif ($v->role_id == 4) {
                $alumni[] = $v;
            } else {
                $admins[] = $v;
            }
        }

        // Sort students/members: those who have submissions (jml_xxx > 0) go to the top
        usort($members, function($a, $b) {
            $has_a = ($a->jml_aktif_kuliah > 0 || $a->jml_bebas_lab > 0 || $a->jml_skl > 0 || $a->jml_bebas_perpus > 0);
            $has_b = ($b->jml_aktif_kuliah > 0 || $b->jml_bebas_lab > 0 || $b->jml_skl > 0 || $b->jml_bebas_perpus > 0);
            if ($has_a && !$has_b) return -1;
            if (!$has_a && $has_b) return 1;
            return strcmp($b->login_at, $a->login_at);
        });
        
        // Helper function to render a card
        function renderVisitorCard($v, $groupId) {
            $name = trim($v->nama_lengkap);
            $initials = '';
            $bg_class = 'bg-student';
            $is_admin = false;
            $is_alumni = ($groupId === 'alumni');
            
            if ($name) {
                $words = explode(' ', $name);
                if (count($words) >= 2) {
                    $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                } else {
                    $initials = strtoupper(substr($name, 0, 2));
                }
            } elseif ($v->nama_admin) {
                $is_admin = true;
                $name = trim($v->nama_admin);
                $words = explode(' ', $name);
                if (count($words) >= 2) {
                    $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                } else {
                    $initials = strtoupper(substr($name, 0, 2));
                }
                $bg_class = 'bg-admin';
            } else {
                $name = "Bukan Mahasiswa/Admin";
                $initials = "ADM";
                $bg_class = 'bg-admin';
            }
            ?>
            <div class="visitor-drawer-card" data-group-id="<?= $groupId; ?>">
                <div class="visitor-card-avatar <?= $bg_class; ?>">
                    <?= $initials; ?>
                </div>
                <div class="visitor-card-details">
                    <div class="visitor-card-name" title="<?= htmlspecialchars($name); ?>"><?= htmlspecialchars($name); ?></div>
                    
                    <div class="visitor-card-sub">
                        <i class="fas fa-id-card text-muted mr-1" style="font-size: 11px;"></i> 
                        NIM: <strong class="visitor-card-nim-val"><?= htmlspecialchars($v->nim); ?></strong>
                    </div>
                    
                    <?php if ($is_admin): ?>
                        <div class="visitor-card-sub">
                            <i class="fas fa-user-shield text-muted mr-1" style="font-size: 11px;"></i> 
                            Role: <span class="visitor-card-prodi-val font-weight-bold text-primary"><?= $v->nama_role ? htmlspecialchars($v->nama_role) : 'Admin / Staff'; ?></span>
                        </div>
                    <?php elseif ($is_alumni): ?>
                        <div class="visitor-card-sub">
                            <i class="fas fa-user-graduate text-muted mr-1" style="font-size: 11px;"></i> 
                            Status: <span class="visitor-card-prodi-val font-weight-bold text-success">Alumni (<?= $v->nama_prodi ? htmlspecialchars($v->nama_prodi) : '-'; ?>)</span>
                        </div>
                    <?php else: ?>
                        <div class="visitor-card-sub">
                            <i class="fas fa-graduation-cap text-muted mr-1" style="font-size: 11px;"></i> 
                            Prodi: <span class="visitor-card-prodi-val"><?= $v->nama_prodi ? htmlspecialchars($v->nama_prodi) : '-'; ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="visitor-card-time">
                        <i class="far fa-clock"></i>
                        <span>Login: <?= date('d-m-Y H:i:s', strtotime($v->login_at)); ?></span>
                    </div>
                    
                    <div class="visitor-card-badges">
                        <?php if ($is_admin): ?>
                            <?php 
                                $has_action = false;
                                if ($v->admin_proses > 0) {
                                    echo '<span class="badge badge-info">Diproses (' . $v->admin_proses . ')</span> ';
                                    $has_action = true;
                                }
                                if ($v->admin_reject > 0) {
                                    echo '<span class="badge badge-danger">Ditolak/Reject (' . $v->admin_reject . ')</span> ';
                                    $has_action = true;
                                }
                                if ($v->admin_selesai > 0) {
                                    echo '<span class="badge badge-success">Selesai (' . $v->admin_selesai . ')</span> ';
                                    $has_action = true;
                                }
                                if (!$has_action) {
                                    echo '<span class="badge badge-secondary">Tidak ada tindakan</span>';
                                }
                            ?>
                        <?php else: ?>
                            <?php 
                                $has_letter = false;
                                if ($v->jml_aktif_kuliah > 0) {
                                    echo '<span class="badge badge-primary">Aktif Kuliah (' . $v->jml_aktif_kuliah . ')</span>';
                                    $has_letter = true;
                                }
                                if ($v->jml_bebas_lab > 0) {
                                    echo '<span class="badge badge-warning text-dark">Bebas Lab (' . $v->jml_bebas_lab . ')</span>';
                                    $has_letter = true;
                                }
                                if ($v->jml_skl > 0) {
                                    echo '<span class="badge badge-info">SKL (' . $v->jml_skl . ')</span>';
                                    $has_letter = true;
                                }
                                if ($v->jml_bebas_perpus > 0) {
                                    echo '<span class="badge badge-success">Bebas Perpus (' . $v->jml_bebas_perpus . ')</span>';
                                    $has_letter = true;
                                }
                                if (!$has_letter) {
                                    echo '<span class="badge badge-secondary">Tidak ada pengajuan</span>';
                                }
                            ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
        }
        
        // 1. ADMINS / STAFF SECTION (Top)
        if (!empty($admins)):
            ?>
            <div class="visitor-group-header" data-group-id="admin">
                <i class="fas fa-user-shield mr-2"></i> Admin & Staff (<?= count($admins); ?>)
            </div>
            <?php 
            foreach($admins as $v) {
                renderVisitorCard($v, 'admin');
            }
        endif;
        
        // 2. MEMBERS / STUDENTS SECTION (Middle)
        if (!empty($members)):
            ?>
            <div class="visitor-group-header" data-group-id="member">
                <i class="fas fa-graduation-cap mr-2"></i> Mahasiswa & Member (<?= count($members); ?>)
            </div>
            <?php 
            foreach($members as $v) {
                renderVisitorCard($v, 'member');
            }
        endif;
        
        // 3. ALUMNI SECTION (Bottom)
        if (!empty($alumni)):
            ?>
            <div class="visitor-group-header" data-group-id="alumni">
                <i class="fas fa-user-graduate mr-2"></i> Alumni (<?= count($alumni); ?>)
            </div>
            <?php 
            foreach($alumni as $v) {
                renderVisitorCard($v, 'alumni');
            }
        endif;
        
    else: 
        ?>
        <div class="text-center py-5 text-muted font-weight-bold" style="font-family: var(--font-body); font-size: 13px;">
            Tidak ada visitor pada tanggal ini
        </div>
    <?php endif; ?>
</div>
