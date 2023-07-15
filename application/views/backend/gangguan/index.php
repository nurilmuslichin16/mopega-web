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
                                <td><?= expired($data['booking_date']); ?></td>
                                <td><?= status($data['status']); ?></td>
                                <td>
                                    <a href="#" onclick="followUp(<?= $data['id_gangguan']; ?>)" class="btn btn-primary btn-circle btn-sm">
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
            <form action="#" id="formFollowUp" method="POST">
                <div class="modal-body">Pilih teknisi untuk mengirim order.
                    <br />
                    <br />
                    <div class="form-group mb-4">
                        <input type="hidden" id="id_gangguan" name="id_gangguan">
                        <select class="form-control" id="teknisi" name="teknisi">
                            <option value="">Pilih Teknisi</option>
                            <?php foreach ($listTeknisi as $data) : ?>
                                <option value="<?= $data['id_telegram']; ?>"><?= $data['nama_teknisi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="mt-3 text-danger" id="error"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#formFollowUp").submit(function(e) {
            e.preventDefault();
        });
    });

    function followUp(id_gangguan) {
        $('#formFollowUp')[0].reset();
        $('select').removeClass('inputerror');
        $('.form-group').find('#error').empty();

        $('#id_gangguan').val(id_gangguan);

        $('#followUpModal').modal('show');
    }

    function save() {
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);

        $.ajax({
            url: "<?php echo site_url('admin/gangguan/followUp') ?>",
            type: "POST",
            data: $('#formFollowUp').serialize(),
            dataType: "JSON",
            success: function(data) {
                // Status (1: Form masih ada yang kosong, 2: Sukses, 3: Server Error)
                if (data.status == 2) {
                    Swal.fire(
                        'Sukses!',
                        'Order gangguan berhasil dikirim ke Teknisi.',
                        'success'
                    ).then(() => {
                        window.location.replace("<?= site_url('admin/gangguan') ?>");
                    });
                } else if (data.status == 3) {
                    Swal.fire(
                        'Gagal!',
                        'Sistem tidak dapat mengirim order, silahkan ulangi kembali.',
                        'error'
                    ).then(() => {
                        window.location.replace("<?= site_url('admin/gangguan') ?>");
                    });
                } else {
                    Swal.fire(
                        'Peringatan!',
                        'Wajib pilih teknisi, silahkan cek kembali.',
                        'error'
                    );
                    $.each(data.error, function(key, value) {
                        if (value != "") {
                            $('#' + key).addClass('inputerror');
                            $('#' + key).parent().find('#error').text(value);
                        }
                    });
                }
                $('#btnSave').text('Tambah');
                $('#btnSave').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error pada ajax!');
                $('#btnSave').text('Tambah');
                $('#btnSave').attr('disabled', false);
            }
        });
    }

    function hapus(id_gangguan) {
        Swal.fire({
            title: 'Yakin ingin menghapus data gangguan?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('admin/gangguan/delete'); ?>",
                    type: "POST",
                    data: {
                        'id_gangguan': id_gangguan
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            Swal.fire('Data berhasil terhapus!', '', 'success').then(() => {
                                window.location.replace("<?= site_url('admin/gangguan') ?>");
                            });
                        } else {
                            Swal.fire('Server Error! Silahkan coba kembali.', '', 'error').then(() => {
                                window.location.replace("<?= site_url('admin/gangguan') ?>");
                            });;
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error pada ajax!');
                        $('#btnSave').text('Tambah');
                        $('#btnSave').attr('disabled', false);
                    }
                });
            } else {
                Swal.fire('Membatalkan proses hapus.', '', 'info')
            }
        })
    }
</script>