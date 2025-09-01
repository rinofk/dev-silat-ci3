<div class="modal-header">
    <h5 class="modal-title">Daftar Visitor Tanggal <?= $this->input->get('date'); ?></h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>NIM</th>
                <!-- <th>Nama</th> -->
                <!-- <th>Prodi</th> -->
                <th>Session ID</th>
                <!-- <th>IP Address</th> -->
                <!-- <th>Referrer</th> -->
                <!-- <th>URI</th> -->
                <th>Login At</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($visitors)): $no=1; foreach($visitors as $v): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $v->nim; ?></td>
                    <!-- <td><?= $v->nama_lengkap; ?></td> -->
                    <!-- <td><?= $v->nama_prodi; ?></td> -->
                    <td><?= $v->session_id; ?></td>
                    <!-- <td><?= $v->ip_address; ?></td> -->
                    <!-- <td><?= $v->referrer; ?></td> -->
                    <!-- <td><?= $v->uri; ?></td> -->
                    <td><?= date('d-m-Y H:i:s', strtotime($v->login_at)); ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="7" class="text-center">Tidak ada visitor</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
