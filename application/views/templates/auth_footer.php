<!-- <div class="h7 text-center text-warning mt-4">
    Sistem Informasi Layanan Administrasi surat Terpadu
</div>
<div class="small text-center text-warning">
    version 28.03.2020
</div>
<div class="row justify-content-center">

    <div class="card mb" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-8-center">
                <div class="card-body">
                    <p class="card-text">Untuk Bantuan Penggunaan Aplikasi</p>
                    <p class="card-text"><a href="https://wa.me/6285391044299?text=Hai%20Administrator%20aplikasi%20silat%20fkuntan, " rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i> Hubungi Administrator Kami</a></p>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>


<!-- datepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-datepicker.js"></script>


<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>


<!-- Input Auto Kapital -->
<script>
    // ketika document sudah siap (termasuk jquery sudah terload)
    $(document).ready(function() {
        // tunggu jika ada input di element yang punya class 'input-upper'
        $('.input-upper').bind('input', function() {
            // ubah nilainya menjadi kapital
            $(this).val($(this).val().toUpperCase())
        })
    })
</script>


<!-- START js untuk halaman reset account -->
<script>
    function addToggle(inputId, toggleId, iconId) {
        const input = document.getElementById(inputId);
        const toggle = document.getElementById(toggleId);
        const icon = document.getElementById(iconId);

        toggle.addEventListener("click", function() {
            const type = input.getAttribute("type") === "password" ? "text" : "password";
            input.setAttribute("type", type);

            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        });
    }

    addToggle("password1", "togglePassword1", "iconPassword1");
    addToggle("password2", "togglePassword2", "iconPassword2");
</script>
<script>
    $(function() {
        $(".datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "1970:<?= date('Y'); ?>"
        });
    });
</script>

<!-- END js untuk halaman reset account -->

</body>

</html>