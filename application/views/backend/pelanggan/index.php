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

    <a class="btn btn-primary mb-3 mr-2" href="" data-toggle="modal" data-target="#tambahDataPelanggan"><i class="fas fa-fw fa-plus"></i>&nbspTambah Data Pelanggan</a>

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
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                            <td>
                                <a href="<?= base_url('admin/pelanggan/detail'); ?>" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                &nbsp;
                                <a href="#" data-toggle="modal" data-target="#tambahDataPelanggan" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                &nbsp;
                                <a href="#" onclick="hapus()" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>$170,750</td>
                            <td>
                                <a href="<?= base_url('admin/pelanggan/detail'); ?>" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                &nbsp;
                                <a href="#" data-toggle="modal" data-target="#tambahDataPelanggan" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                &nbsp;
                                <a href="#" onclick="hapus()" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>$86,000</td>
                            <td>
                                <a href="<?= base_url('admin/pelanggan/detail'); ?>" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                &nbsp;
                                <a href="#" data-toggle="modal" data-target="#tambahDataPelanggan" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                &nbsp;
                                <a href="#" onclick="hapus()" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
    function hapus() {
        Swal.fire({
            title: 'Yakin ingin menghapus data pelanggan?',
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

    function save() {
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);

        $.ajax({
            url: "<?php echo site_url('admin/pelanggan/add') ?>",
            type: "POST",
            data: $('#formTambahDataPelanggan').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status == 2) {
                    window.location.replace("<?= site_url('petugas/datapasien/proses_redirect/2') ?>");
                } else if (data.status == 3) {
                    window.location.replace("<?= site_url('petugas/datapasien/proses_redirect/3') ?>");
                } else {
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
                <h5 class="modal-title" id="tambahDataPelanggan">Tambah Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="formTambahDataPelanggan" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
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
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP *">
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
                                <input type="number" class="form-control" id="internet" name="internet" placeholder="Nomor Internet *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Nomor Telepon</label>
                                <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Nomor Telepon *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="odp">ODP</label>
                                <input type="text" class="form-control" id="odp" name="odp" placeholder="ODP *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="port">Port</label>
                                <input type="number" class="form-control" id="port" name="port" placeholder="Nomor Port *">
                                <small class="mt-3 text-danger" id="error"></small>
                            </div>
                            <div class="form-group">
                                <label for="sn">Serial Number ONT</label>
                                <input type="text" class="form-control" id="sn" name="sn" placeholder="Serial Number *">
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