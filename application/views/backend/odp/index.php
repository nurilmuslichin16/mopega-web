<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $subtitle; ?></h1>
    <p class="mb-4">Tombol <b>Info</b> <a href="#" class="btn btn-info btn-circle btn-sm">
            <i class="fas fa-info-circle"></i>
        </a> untuk melihat detail informasi ODP. || Tombol <b>Edit</b> <a href="#" class="btn btn-warning btn-circle btn-sm">
            <i class="fas fa-edit"></i>
        </a> untuk mengubah data ODP. || Tombol <b>Hapus</b> <a href="#" class="btn btn-danger btn-circle btn-sm">
            <i class="fas fa-trash"></i>
        </a> untuk mengahpus data ODP.</p>

    <a class="btn btn-primary mb-3 mr-2" href="#" onclick="add()"><i class="fas fa-fw fa-plus"></i>&nbspTambah Data ODP</a>
    <a class="btn btn-success mb-3 mr-2" href="<?= base_url('admin/odp/import'); ?>"><i class="fas fa-fw fa-upload"></i>&nbspImport Data ODP</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data ODP</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama ODP</th>
                            <th>Koordinat</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listData as $data) : ?>
                            <tr>
                                <td><?= $data['nama_odp']; ?></td>
                                <td><?= $data['koordinat']; ?></td>
                                <td>
                                    <a href="#" onclick="edit(<?= $data['id_odp']; ?>)" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#" onclick="hapus(<?= $data['id_odp']; ?>)" class="btn btn-danger btn-circle btn-sm">
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

<script>
    var method;

    $(document).ready(function() {
        $("#formTambahDataODP").submit(function(e) {
            e.preventDefault();
        });
    });

    function add() {
        $('#title_modal').text('Tambah Data ODP');
        $('#btnSave').text('Tambah');
        $('#formTambahDataODP')[0].reset();
        $('input').removeClass('inputerror');
        $('textarea').removeClass('inputerror');
        $('select').removeClass('inputerror');
        $('.form-group').find('#error').empty();

        method = 'add';

        $('#tambahDataODP').modal('show');
    }

    function hapus(id_odp) {
        Swal.fire({
            title: 'Yakin ingin menghapus data odp?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('admin/odp/delete'); ?>",
                    type: "POST",
                    data: {
                        'id_odp': id_odp
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            Swal.fire('Data berhasil terhapus!', '', 'success').then(() => {
                                window.location.replace("<?= site_url('admin/odp') ?>");
                            });
                        } else {
                            Swal.fire('Server Error! Silahkan coba kembali.', '', 'error').then(() => {
                                window.location.replace("<?= site_url('admin/odp') ?>");
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

    function edit(id_odp) {
        $('#title_modal').text('Edit Data ODP');
        $('#btnSave').text('Ubah');
        $('#formTambahDataODP')[0].reset();
        $('input').removeClass('inputerror');
        $('textarea').removeClass('inputerror');
        $('select').removeClass('inputerror');
        $('.form-group').find('#error').empty();

        method = 'edit';

        $.ajax({
            url: "<?= site_url('admin/odp/getData'); ?>",
            type: 'POST',
            data: {
                'id_odp': id_odp
            },
            dataType: 'JSON',
            success: function(data) {
                let koordinat = data.koordinat;
                let split_koordinat = koordinat.split(',');

                $('#id_odp').val(data.id_odp);
                $('#nama_odp').val(data.nama_odp);
                $('#latitude').val(split_koordinat[0]);
                $('#longitude').val(split_koordinat[1]);

                $('#tambahDataODP').modal('show');
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

        if (method == 'add') {
            url = "<?php echo site_url('admin/odp/add') ?>";
        } else {
            url = "<?php echo site_url('admin/odp/edit') ?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#formTambahDataODP').serialize(),
            dataType: "JSON",
            success: function(data) {
                // Status (1: Form masih ada yang kosong, 2: Sukses, 3: Server Error)
                if (data.status == 2) {
                    Swal.fire(
                        'Sukses!',
                        method == 'add' ? 'Data ODP berhasil ditambahkan.' : 'Data ODP berhasil diubah.',
                        'success'
                    ).then(() => {
                        window.location.replace("<?= site_url('admin/odp') ?>");
                    });
                } else if (data.status == 3) {
                    Swal.fire(
                        'Gagal!',
                        'Sistem tidak dapat menyimpan data, silahkan ulangi kembali.',
                        'error'
                    ).then(() => {
                        window.location.replace("<?= site_url('admin/odp') ?>");
                    });
                } else {
                    Swal.fire(
                        'Peringatan!',
                        'Semua form wajib di isi, silahkan cek kembali.',
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
</script>

<!-- Modal -->
<div class="modal fade bd-example" id="tambahDataODP" tabindex="-1" role="dialog" aria-labelledby="tambahDataODP" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_modal">Tambah Data ODP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="formTambahDataODP" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="id_odp" name="id_odp">
                    <div class="form-group">
                        <label for="nama_odp">Nama ODP</label>
                        <input type="text" class="form-control" id="nama_odp" name="nama_odp" placeholder="ODP-XXX-XXX">
                        <small class="mt-3 text-danger" id="error"></small>
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="-6.887072636732802">
                        <small class="mt-3 text-danger" id="error"></small>
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="109.66898814637734">
                        <small class="mt-3 text-danger" id="error"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>