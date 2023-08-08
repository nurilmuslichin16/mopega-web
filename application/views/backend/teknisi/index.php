<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $subtitle; ?></h1>
    <p class="mb-4">Tombol <b>Edit</b> <a href="#" class="btn btn-warning btn-circle btn-sm">
            <i class="fas fa-edit"></i>
        </a> untuk mengubah data teknisi. || Tombol <b>Hapus</b> <a href="#" class="btn btn-danger btn-circle btn-sm">
            <i class="fas fa-trash"></i>
        </a> untuk mengahpus data teknisi.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Teknisi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Teknisi</th>
                            <th>Mitra</th>
                            <th>Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listData as $data) : ?>
                            <tr>
                                <td><?= $data['nik']; ?></td>
                                <td><?= $data['nama_teknisi']; ?></td>
                                <td><?= $data['mitra']; ?></td>
                                <td><?= statusTeknisi($data['status']); ?></td>
                                <td>
                                    <a href="#" onclick="edit(<?= $data['id_telegram']; ?>)" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- &nbsp;
                                    <a href="#" onclick="hapus(<?= $data['id_telegram']; ?>)" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a> -->
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

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();

        $("#formDataTeknisi").submit(function(e) {
            e.preventDefault();
        });
    });

    function hapus(id_telegram) {
        Swal.fire({
            title: 'Yakin ingin menghapus data teknisi?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('admin/teknisi/delete'); ?>",
                    type: "POST",
                    data: {
                        'id_telegram': id_telegram
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            Swal.fire('Data berhasil terhapus!', '', 'success').then(() => {
                                window.location.replace("<?= site_url('admin/teknisi') ?>");
                            });
                        } else {
                            Swal.fire('Server Error! Silahkan coba kembali.', '', 'error').then(() => {
                                window.location.replace("<?= site_url('admin/teknisi') ?>");
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

    function edit(id_telegram) {
        $('#title_modal').text('Edit Data Teknisi');
        $('#btnSave').text('Ubah');
        $('#formDataTeknisi')[0].reset();
        $('input').removeClass('inputerror');
        $('textarea').removeClass('inputerror');
        $('select').removeClass('inputerror');
        $('.form-group').find('#error').empty();

        $.ajax({
            url: "<?= site_url('admin/teknisi/getData'); ?>",
            type: 'POST',
            data: {
                'id_telegram': id_telegram
            },
            dataType: 'JSON',
            success: function(data) {
                $('#id_telegram').val(data.id_telegram);
                $('#nik').val(data.nik);
                $('#nama_teknisi').val(data.nama_teknisi);
                $('#mitra').val(data.mitra);
                $('#status').val(data.status);

                $('#ubahDataTeknisi').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error pada ajax!');
                $('#btnSave').text('Tambah');
                $('#btnSave').attr('disabled', false);
            }
        })
    }

    function save() {
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);

        $.ajax({
            url: "<?php echo site_url('admin/teknisi/edit') ?>",
            type: "POST",
            data: $('#formDataTeknisi').serialize(),
            dataType: "JSON",
            success: function(data) {
                // Status (1: Sukses, 2: Server Error)
                if (data.status == 1) {
                    Swal.fire(
                        'Sukses!',
                        'Data Teknisi berhasil diubah.',
                        'success'
                    ).then(() => {
                        window.location.replace("<?= site_url('admin/teknisi') ?>");
                    });
                } else {
                    Swal.fire(
                        'Gagal!',
                        'Sistem tidak dapat menyimpan data, silahkan ulangi kembali.',
                        'error'
                    ).then(() => {
                        window.location.replace("<?= site_url('admin/teknisi') ?>");
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
</script>

<!-- Modal -->
<div class="modal fade" id="ubahDataTeknisi" tabindex="-1" role="dialog" aria-labelledby="ubahDataTeknisi" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahDataTeknisi">Ubah Data Teknisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="formDataTeknisi" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="id_telegram" name="id_telegram">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama_teknisi">Nama Teknisi</label>
                        <input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" disabled>
                    </div>
                    <div class="form-group">
                        <label for="mitra">Mitra</label>
                        <input type="text" class="form-control" id="mitra" name="mitra" disabled>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btnSave" onclick="save()" class="btn btn-warning">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>