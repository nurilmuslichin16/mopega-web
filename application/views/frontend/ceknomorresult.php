<!-- About-->
<section class="page-section" id="about">
    <?php if (isset($info)) { ?>
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Riwayat Laporan Gangguan Pelanggan</h2>
                <h3 class="section-subheading text-muted"><?= $info['nama_pelanggan']; ?> || <?= $info['no_internet']; ?> - <?= $info['no_voice']; ?></h3>
            </div>
            <ul class="timeline">
                <?php foreach ($data as $history) : ?>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?= base_url('assets/frontend/assets/img/log/history.svg'); ?>" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading"><?= $history['tiket']; ?></h4>
                                <h5 class="subheading" style="color: orange;"><?= statusText($history['status']); ?></h5>
                                <h4 class="subheading"><?= date_indo_jam($history['report_date']); ?></h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted"><b>Keterangan</b> : "<?= $history['ket']; ?>"</p>
                                <p class="text-muted"><b>Penyebab</b> : "<?= $history['penyebab']; ?>"</p>
                                <p class="text-muted"><b>Solusi</b> : "<?= $history['perbaikan']; ?>"</p>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="text-center" style="margin-top: 100px;">
                <div class="text-center"><a class="btn btn-primary btn-xl text-uppercase" href="<?= base_url('web/track'); ?>">Kembali</a></div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Nomor Tidak Ditemukan</h2>
                <h3 class="section-subheading text-muted">Silahkan cek kembali Nomor yang diinputkan.</h3>
                <div class="text-center"><a class="btn btn-primary btn-xl text-uppercase" href="<?= base_url('web/track'); ?>">Kembali</a></div>
            </div>
        </div>
    <?php } ?>
</section>