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
                <form action="<?= base_url('admin/gangguan/download'); ?>" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Tanggal Laporan</label>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="date" class="form-control" id="tgl_lapor_mulai" name="tgl_lapor_mulai" placeholder="Mulai" onchange="inputtgldaftar()">
                                </div>
                                <div class="col">
                                    <input type="date" class="form-control" id="tgl_lapor_akhir" name="tgl_lapor_akhir" placeholder="Selesai">
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
                                <option value="0">Work Order</option>
                                <option value="1">Ordered</option>
                                <option value="2">On The Way</option>
                                <option value="3">On Going Progress</option>
                                <option value="4">Closed</option>
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
            daftar = $('#tgl_lapor_mulai').val();
            if (daftar == '') {
                $('#tgl_lapor_akhir').attr('disabled', true);
                $('#tgl_lapor_akhir').val("");
            } else {
                $('#tgl_lapor_akhir').attr('disabled', false);
                $('#tgl_lapor_akhir').val("");
            }
        }

        $('#tgl_lapor_akhir').change(function() {
            mulai = $('#tgl_lapor_mulai').val();
            selesai = $('#tgl_lapor_akhir').val();
            if (mulai > selesai) {
                Swal.fire({
                    title: 'Tidak Valid!',
                    text: 'Tanggal Laporan harus lebih besar dari inputan sebelumnya.',
                    icon: 'error'
                });
                $('#tgl_lapor_akhir').val("");
            }
        });
    </script>

</div>
<!-- /.container-fluid -->