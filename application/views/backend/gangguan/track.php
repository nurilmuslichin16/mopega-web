<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?= $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        &nbsp<?= $title; ?>
                    </h6>
                </div>
                <form action="<?= base_url('petugas/pendaftaranpasien/filter'); ?>" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tiket">Tiket</label>
                            <input type="text" class="form-control" id="tiket" name="tiket" placeholder="INxxxxxx *">
                            <small class="mt-3 text-danger" id="error"></small>
                        </div>
                        <span style="color: red; font-size: 12px"><i>*Silahkan masukkan tiket gangguan, untuk melihat log aktivitas tiket tersebut.</i></span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-download"></i>&nbspTrack</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            inputtgldaftar();
            inputtglperiksa();
        });

        function inputtgldaftar() {
            daftar = $('#mulaitgldaftar').val();
            if (daftar == '') {
                $('#selesaitgldaftar').attr('disabled', true);
                $('#selesaitgldaftar').val("");
            } else {
                $('#selesaitgldaftar').attr('disabled', false);
                $('#selesaitgldaftar').val("");
            }
        }

        function inputtglperiksa() {
            periksa = $('#mulaitglperiksa').val();
            if (periksa == '') {
                $('#selesaitglperiksa').attr('disabled', true);
                $('#selesaitglperiksa').val("");
            } else {
                $('#selesaitglperiksa').attr('disabled', false);
                $('#selesaitglperiksa').val("");
            }
        }

        $('#selesaitgldaftar').change(function() {
            mulai = $('#mulaitgldaftar').val();
            selesai = $('#selesaitgldaftar').val();
            if (mulai > selesai) {
                Swal.fire({
                    title: 'Tidak Valid!',
                    text: 'Tanggal Daftar Mulai tidak boleh lebih besar dari Tanggal Daftar Selesai',
                    icon: 'error'
                });
                $('#selesaitgldaftar').val("");
            }
        });

        $('#selesaitglperiksa').change(function() {
            mulai = $('#mulaitglperiksa').val();
            selesai = $('#selesaitglperiksa').val();
            if (mulai > selesai) {
                Swal.fire({
                    title: 'Tidak Valid!',
                    text: 'Tanggal Periksa Mulai tidak boleh lebih besar dari Tanggal Periksa Selesai',
                    icon: 'error'
                });
                $('#selesaitglperiksa').val("");
            }
        });
    </script>

</div>
<!-- /.container-fluid -->