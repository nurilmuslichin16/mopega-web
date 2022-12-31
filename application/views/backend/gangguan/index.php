<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $subtitle; ?></h1>
    <p class="mb-4">Tombol <b>Follow Up</b> <a href="#" class="btn btn-primary btn-circle btn-sm">
            <i class="fab fa-telegram"></i>
        </a> untuk mengirim order ke teknisi. || Tombol <b>Info</b> <a href="#" class="btn btn-info btn-circle btn-sm">
            <i class="fas fa-info-circle"></i>
        </a> untuk melihat detail informasi gangguan. || Tombol <b>Hapus</b> <a href="#" class="btn btn-danger btn-circle btn-sm">
            <i class="fas fa-trash"></i>
        </a> untuk mengahpus order gangguan.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Gangguan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tiket</th>
                            <th>Nomor</th>
                            <th>Tipe</th>
                            <th>Tanggal</th>
                            <th>Expired</th>
                            <th>Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listData as $data) : ?>
                            <tr>
                                <td><?= $data['tiket']; ?></td>
                                <td><?= $data['no_internet'] ?? '-'; ?> / <?= $data['no_voice'] ?? '-'; ?></td>
                                <td><?= tipe($data['tipe']); ?></td>
                                <td><?= $data['report_date']; ?></td>
                                <td><?= $data['expired']; ?></td>
                                <td><?= status($data['status']); ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#followUpModal" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fab fa-telegram"></i>
                                    </a>
                                    &nbsp;
                                    <a href="<?= base_url('admin/gangguan/detail/' . $data['id_gangguan']); ?>" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#" onclick="hapus(<?= $data['id_gangguan']; ?>)" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- Follow Up Modal-->
<div class="modal fade" id="followUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Follow Up</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih teknisi untuk mengirim order.
                <br />
                <br />
                <div class="form-group mb-4">
                    <select class="form-control" id="teknisi" name="teknisi">
                        <option value="">Pilih Teknisi</option>
                        <option value="">Andi</option>
                        <option value="">Bobby</option>
                        <option value="">Edi</option>
                    </select>
                    <small class="mt-3 text-danger" id="error"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('admin/gangguan'); ?>">Kirim</a>
            </div>
        </div>
    </div>
</div>

<script>
    function hapus() {
        Swal.fire({
            title: 'Yakin ingin menghapus order?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire('Terhapus!', '', 'success')
            } else {
                Swal.fire('Membatalkan proses hapus.', '', 'info')
            }
        })
    }
</script>