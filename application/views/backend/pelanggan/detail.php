<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <a class="btn-sm btn-primary" href="<?= base_url('admin/pelanggan'); ?>"><i class="fas fa-fw fa-arrow-left"></i></a>
                &nbspData Pelanggan <?= $data['nama_pelanggan']; ?>
            </h6>
        </div>
        <div class="card-body text-gray-800">
            <div class="row">
                <div class="col-lg-4 border-right">
                    <p class="mb-1"><b>Nama Pelanggan :</b></p>
                    <p><?= $data['nama_pelanggan']; ?></p>
                    <p class="mb-1"><b>Email :</b></p>
                    <p><?= $data['email']; ?></p>
                    <p class="mb-1"><b>No HP :</b></p>
                    <p><?= $data['no_hp']; ?></p>
                    <p class="mb-1"><b>Kota / Kabupaten :</b></p>
                    <p><?= $data['kota_kab']; ?></p>
                    <p class="mb-1"><b>Kecamatan :</b></p>
                    <p><?= $data['kec']; ?></p>
                    <p class="mb-1"><b>Kelurahan :</b></p>
                    <p><?= $data['kel']; ?></p>
                    <p class="mb-1"><b>Alamat :</b></p>
                    <p><?= $data['alamat']; ?></p>
                </div>
                <div class="col-lg-4">
                    <p class="mb-1"><b>Nomor Internet :</b></p>
                    <p><?= $data['no_internet']; ?></p>
                    <p class="mb-1"><b>Nomor Telepon :</b></p>
                    <p><?= $data['no_voice']; ?></p>
                    <p class="mb-1"><b>Serial Number ONT :</b></p>
                    <p><?= $data['sn_ont']; ?></p>
                    <p class="mb-1"><b>ODP dan Port :</b></p>
                    <p><?= $data['odp']; ?> - <?= $data['port']; ?></p>
                    <p class="mb-1"><b>Tipe :</b></p>
                    <p><?= tipe($data['tipe']); ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->