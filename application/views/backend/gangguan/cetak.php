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
                            <div class="row">
                                <div class="col">
                                    <label>Tanggal Daftar Mulai</label>
                                </div>
                                <div class="col">
                                    <label>Tanggal Daftar Selesai</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="date" class="form-control" id="mulaitgldaftar" name="mulaitgldaftar" placeholder="Mulai" onchange="inputtgldaftar()">
                                </div>
                                <div class="col">
                                    <input type="date" class="form-control" id="selesaitgldaftar" name="selesaitgldaftar" placeholder="Selesai">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Tanggal Periksa Mulai</label>
                                </div>
                                <div class="col">
                                    <label>Tanggal Periksa Selesai</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="date" class="form-control" id="mulaitglperiksa" name="mulaitglperiksa" placeholder="Mulai" onchange="inputtglperiksa()">
                                </div>
                                <div class="col">
                                    <input type="date" class="form-control" id="selesaitglperiksa" name="selesaitglperiksa" placeholder="Selesai">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipe">Tipe Layanan</label>
                            <select class="form-control" id="tipe" name="tipe">
                                <option value="">Semua Layanan</option>
                                <option value="Indihome">Indihome</option>
                                <option value="BGES / VPN IP">BGES / VPN IP</option>
                                <option value="WIFI ID">WIFI ID</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Semua Status</option>
                                <option value="1">Work Order</option>
                                <option value="2">Ordered</option>
                                <option value="3">On The Way</option>
                                <option value="4">On Going Progress</option>
                                <option value="5">Closed</option>
                            </select>
                        </div>
                        <span style="color: red; font-size: 12px"><i>*Biarkan kosong jika ingin download semua</i></span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-download"></i>&nbspCetak</button>
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