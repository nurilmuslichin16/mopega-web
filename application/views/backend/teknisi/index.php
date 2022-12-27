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
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#ubahDataTeknisi" class="btn btn-warning btn-circle btn-sm">
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
                            <td>
                                <a href="#" data-toggle="modal" data-target="#ubahDataTeknisi" class="btn btn-warning btn-circle btn-sm">
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
                            <td>
                                <a href="#" data-toggle="modal" data-target="#ubahDataTeknisi" class="btn btn-warning btn-circle btn-sm">
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
            title: 'Yakin ingin menghapus data teknisi?',
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
            <form action="#" id="formUbahDataTeknisi" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK *">
                        <small class="mt-3 text-danger" id="error"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama_teknisi">Nama Teknisi</label>
                        <input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" placeholder="Nama Teknisi *">
                    </div>
                    <div class="form-group">
                        <label for="mitra">Mitra</label>
                        <input type="text" class="form-control" id="mitra" name="mitra" placeholder="Mitra *">
                        <small class="mt-3 text-danger" id="error"></small>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Pilih Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        <small class="mt-3 text-danger" id="error"></small>
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