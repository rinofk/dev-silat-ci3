<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; fakultas kedokteran universitas tanjungpura</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>


<script>
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        });
    });
</script>

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
<!-- datepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-datepicker.js"></script>


<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#datatableAdmin').DataTable();
        $('#datatableMahasiswa').DataTable();
    });
</script>
<!-- START UPDATE JS UNTUK STATISTIK RESET -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('resetChart').getContext('2d');

    const resetChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($chart_labels); ?>,
            datasets: [{
                    label: 'Total Reset',
                    data: <?= json_encode($chart_total); ?>,
                    borderWidth: 2,
                    tension: 0.4
                },
                {
                    label: 'Reset Berhasil',
                    data: <?= json_encode($chart_success); ?>,
                    borderWidth: 2,
                    tension: 0.4
                },
                {
                    label: 'Reset Gagal',
                    data: <?= json_encode($chart_failed); ?>,
                    borderWidth: 2,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            interaction: {
                mode: 'nearest',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
<!-- END UPDATE JS UNTUK STATISTIK RESET -->
<script>
    Chart.defaults.font.family = "'Poppins', sans-serif";
    Chart.defaults.font.size = 12;
</script>

</body>

</html>