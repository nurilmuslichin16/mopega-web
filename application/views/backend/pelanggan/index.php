<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $subtitle; ?></h1>
    <p class="mb-4">Tombol <b>Info</b> <a href="#" class="btn btn-info btn-circle btn-sm">
            <i class="fas fa-info-circle"></i>
        </a> untuk melihat detail informasi pelanggan. || Tombol <b>Edit</b> <a href="#" class="btn btn-warning btn-circle btn-sm">
            <i class="fas fa-edit"></i>
        </a> untuk mengubah data pelanggan. || Tombol <b>Hapus</b> <a href="#" class="btn btn-danger btn-circle btn-sm">
            <i class="fas fa-trash"></i>
        </a> untuk mengahpus data pelanggan.</p>

    <a class="btn btn-primary mb-3 mr-2" href="#" onclick="add()"><i class="fas fa-fw fa-plus"></i>&nbspTambah Data Pelanggan</a>
    <a class="btn btn-success mb-3 mr-2" href="<?= base_url('admin/pelanggan/import'); ?>"><i class="fas fa-fw fa-upload"></i>&nbspImport Data Pelanggan</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Nomor</th>
                            <th>ODP / Port</th>
                            <th>Tipe</th>
                            <th>Serial Number ONT</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listData as $data) : ?>
                            <tr>
                                <td><?= $data['nama_pelanggan']; ?></td>
                                <td><?= $data['no_internet']; ?> / <?= $data['no_voice']; ?></td>
                                <td><?= $data['odp']; ?> - <?= $data['port']; ?></td>
                                <td><?= tipe($data['tipe']); ?></td>
                                <td><?= $data['sn_ont']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/pelanggan/detail/' . $data['id_pelanggan']); ?>" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#" onclick="edit(<?= $data['id_pelanggan']; ?>)" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#" onclick="hapus(<?= $data['id_pelanggan']; ?>)" class="btn btn-danger btn-circle btn-sm">
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
        $("#formTambahDataPelanggan").submit(function(e) {
            e.preventDefault();
        });
    });

    function add() {
        $('#title_modal').text('Tambah Data Pelanggan');
        $('#btnSave').text('Tambah');
        $('#formTambahDataPelanggan')[0].reset();
        $('input').removeClass('inputerror');
        $('textarea').removeClass('inputerror');
        $('select').removeClass('inputerror');
        $('.form-group').find('#error').empty();

        method = 'add';

        $('#tambahDataPelanggan').modal('show');
    }

    function hapus(id_pelanggan) {
        Swal.fire({
            title: 'Yakin ingin menghapus data pelanggan?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('admin/pelanggan/delete'); ?>",
                    type: "POST",
                    data: {
                        'id_pelanggan': id_pelanggan
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            Swal.fire('Data berhasil terhapus!', '', 'success').then(() => {
                                window.location.replace("<?= site_url('admin/pelanggan') ?>");
                            });
                        } else {
                            Swal.fire('Server Error! Silahkan coba kembali.', '', 'error').then(() => {
                                window.location.replace("<?= site_url('admin/pelanggan') ?>");
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

    function edit(id_pelanggan) {
        $('#title_modal').text('Edit Data Pelanggan');
        $('#btnSave').text('Ubah');
        $('#formTambahDataPelanggan')[0].reset();
        $('input').removeClass('inputerror');
        $('textarea').removeClass('inputerror');
        $('select').removeClass('inputerror');
        $('.form-group').find('#error').empty();

        method = 'edit';

        $.ajax({
            url: "<?= site_url('admin/pelanggan/getData'); ?>",
            type: 'POST',
            data: {
                'id_pelanggan': id_pelanggan
            },
            dataType: 'JSON',
            success: function(data) {
                $('#id_pelanggan').val(data.id_pelanggan);
                $('#nama_pelanggan').val(data.nama_pelanggan);
                $('#tipe').val(data.tipe);
                $('#email').val(data.email);
                $('#no_hp').val(data.no_hp);
                $('#alamat').val(data.alamat);
                $('#internet').val(data.no_internet);
                $('#telepon').val(data.no_voice);
                $('#odp').val(data.odp);
                $('#port').val(data.port);
                $('#sn').val(data.sn_ont);

                $('#tambahDataPelanggan').modal('show');
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
            url = "<?php echo site_url('admin/pelanggan/add') ?>";
        } else {
            url = "<?php echo site_url('admin/pelanggan/edit') ?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#formTambahDataPelanggan').serialize(),
            dataType: "JSON",
            success: function(data) {
                // Status (1: Form masih ada yang kosong, 2: Sukses, 3: Server Error)
                if (data.status == 2) {
                    Swal.fire(
                        'Sukses!',
                        method == 'add' ? 'Data Pelanggan berhasil ditambahkan.' : 'Data Pelanggan berhasil diubah.',
                        'success'
                    ).then(() => {
                        window.location.replace("<?= site_url('admin/pelanggan') ?>");
                    });
                } else if (data.status == 3) {
                    Swal.fire(
                        'Gagal!',
                        'Sistem tidak dapat menyimpan data, silahkan ulangi kembali.',
                        'error'
                    ).then(() => {
                        window.location.replace("<?= site_url('admin/pelanggan') ?>");
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
<div class="modal fade bd-example-modal-lg" id="tambahDataPelanggan" tabindex="-1" role="dialog" aria-labelledby="tambahDataPelanggan" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_modal">Tambah Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="formTambahDataPelanggan" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <input type="hidden" id="id_pelanggan" name="id_pelanggan">
                            <div class="form-group">
                                <label for="nama_pelanggan">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Nama Pelanggan *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="tipe">Tipe Pelanggan</label>
                                <select class="form-control" id="tipe" name="tipe">
                                    <option value="">Pilih Layanan</option>
                                    <option value="Indihome">Indihome</option>
                                    <option value="BGES / VPN IP">BGES / VPN IP</option>
                                    <option value="WIFI ID">WIFI ID</option>
                                </select>
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input type="text" maxlength="14" class="form-control" id="no_hp" name="no_hp" maxlength="13" placeholder="Nomor HP *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat *"></textarea>
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="internet">Nomor Internet</label>
                                <input type="text" maxlength="14" class="form-control" id="internet" name="internet" maxlength="13" placeholder="Nomor Internet *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Nomor Telepon</label>
                                <input type="text" maxlength="14" class="form-control" id="telepon" name="telepon" maxlength="10" placeholder="Nomor Telepon *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="odp">ODP</label>
                                <input type="text" class="form-control" id="odp" name="odp" placeholder="ODP *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="port">Port</label>
                                <input type="number" maxlength="2" class="form-control" id="port" name="port" placeholder="Nomor Port *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="sn">Serial Number ONT</label>
                                <input type="text" class="form-control" id="sn" name="sn" maxlength="15" placeholder="Serial Number *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                        </div>
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