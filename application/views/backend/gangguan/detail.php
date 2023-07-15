<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <a class="btn-sm btn-primary" href="<?= base_url('admin/gangguan'); ?>"><i class="fas fa-fw fa-arrow-left"></i></a>
                &nbspLaporan Gangguan <?= $data['tiket']; ?>
            </h6>
        </div>
        <div class="card-body text-gray-800">
            <div class="row">
                <div class="col-lg-4 border-right">
                    <p class="mb-1"><b>Tiket :</b></p>
                    <p><?= $data['tiket']; ?></p>
                    <p class="mb-1"><b>Nama Pelanggan :</b></p>
                    <p><?= $data['nama_pelanggan']; ?></p>
                    <p class="mb-1"><b>Nomor Internet :</b></p>
                    <p><?= $data['no_internet']; ?></p>
                    <p class="mb-1"><b>Nomor Telepon :</b></p>
                    <p><?= $data['no_voice']; ?></p>
                    <p class="mb-1"><b>Tipe :</b></p>
                    <p><?= tipe($data['tipe']); ?></p>
                    <p class="mb-1"><b>Status :</b></p>
                    <p><?= status($data['status']); ?></p>
                    <p class="mb-1"><b>Keterangan :</b></p>
                    <p><?= $data['ket']; ?></p>
                </div>
                <div class="col-lg-4">
                    <p class="mb-1"><b>Tanggal Laporan :</b></p>
                    <p><?= $data['report_date']; ?></p>
                    <p class="mb-1"><b>Expired :</b></p>
                    <p><span class="badge badge-warning">2 Jam 30 Menit</span></p>
                    <p class="mb-1"><b>Teknisi :</b></p>
                    <p><?= $data['nama_teknisi']; ?></p>
                    <p class="mb-1"><b>Penyebab :</b></p>
                    <p><?= $data['penyebab']; ?></p>
                    <p class="mb-1"><b>Perbaikan :</b></p>
                    <p><?= $data['perbaikan']; ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->