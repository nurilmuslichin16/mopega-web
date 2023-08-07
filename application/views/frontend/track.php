<!-- Contact-->
<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Track Gangguan</h2>
            <h3 class="section-subheading text-muted">Silahkan inputkan tiket gangguan.</h3>
        </div>
        <!-- * * * * * * * * * * * * * * *-->
        <!-- * * SB Forms Contact Form * *-->
        <!-- * * * * * * * * * * * * * * *-->
        <!-- This form is pre-integrated with SB Forms.-->
        <!-- To make this form functional, sign up at-->
        <!-- https://startbootstrap.com/solution/contact-forms-->
        <!-- to get an API token!-->
        <form id="contactForm" data-sb-form-api-token="API_TOKEN" method="POST" action="<?= base_url('web/trackresult'); ?>">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input class="form-control" id="tiket" name="tiket" maxlength=8 type="text" placeholder="Nomor Tiket *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="tiket:required">Nomor Tiket wajib di isi.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">Mohon Menunggu!</div>
                            Kami carikan datanya dulu ya.
                            <br />
                            <a href="<?= base_url(); ?>">KEMBALI</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage">
                        <div class="text-center text-danger mb-3">Error server!</div>
                    </div>
                    <!-- Submit Button-->
                    <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="submit" type="submit">Cek Laporan</button></div>
                </div>
            </div>
        </form>
    </div>
</section>