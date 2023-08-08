<!-- About-->
<section class="page-section" id="about">
    <?php if (isset($info)) { ?>
        <div class="container" style="zoom: 50%;">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Tiket <?= $info['tiket']; ?></h2>
                <h3 class="section-subheading text-muted"><?= $info['nama_pelanggan']; ?> || <?= $info['no_internet']; ?> - <?= $info['no_voice']; ?> || <?= $info['ket']; ?>.</h3>
            </div>
            <ul class="timeline">
                <?php $no = 1;
                foreach ($data as $log) : ?>
                    <li <?= fmod($no, 2) == 0 ? "class='timeline-inverted'" : ""; ?>>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?= base_url('assets/frontend/assets/img/log/' . $log['action'] . '.svg'); ?>" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading"><?= logActionText($log['action']); ?></h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted"><?= date_indo_jam($log['waktu']); ?></p>
                                <p class="text-muted">"<?= $log['keterangan']; ?>"</p>
                            </div>
                        </div>
                    </li>
                <?php $no++;
                endforeach; ?>
                <?php if ($info['status'] == 4) { ?>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                <br />
                                SELESAI!
                            </h4>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <div class="text-center" style="margin-top: 100px;">
                <div class="text-center"><a class="btn btn-primary btn-xl text-uppercase" href="<?= base_url('web/track'); ?>">Kembali</a></div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Tiket Tidak Ditemukan</h2>
                <h3 class="section-subheading text-muted">Silahkan cek kembali tiket yang diinputkan.</h3>
                <div class="text-center"><a class="btn btn-primary btn-xl text-uppercase" href="<?= base_url('web/track'); ?>">Kembali</a></div>
            </div>
        </div>
    <?php } ?>
</section>