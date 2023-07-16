<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <a class="btn-sm btn-primary" href="<?= base_url('admin/odp'); ?>"><i class="fas fa-fw fa-arrow-left"></i></a>
                &nbspImport Data ODP
            </h6>
        </div>
        <div class="card-body text-gray-800">
            <!-- form start -->
            <?php echo form_open_multipart('admin/odp/import'); ?>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="file">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file" placeholder="Upload File Data ODP">
                    </div>
                    <button type="submit" name="upload" id="upload" class="btn btn-primary">Import File</button>
                </div>
                <div class="col-lg-4">
                    <a href="<?= base_url('admin/odp/getTemplateUpload'); ?>" class="btn btn-success" style="margin-top: 33px;"><i class="fa fa-file-excel"></i>&nbsp; Download File Template</a>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
    $(document).ready(function() {
        <?php if (!empty($this->session->flashdata('info'))) { ?>
            var message = '<?= $this->session->flashdata('info'); ?>'
            Swal.fire(
                'Sukses Import Data ODP',
                message,
                'success'
            )
        <?php } elseif (!empty($this->session->flashdata('error'))) { ?>
            var message = '<?= $this->session->flashdata('error'); ?>'
            Swal.fire(
                'Error!',
                message,
                'error'
            )
        <?php } ?>
    });
</script>