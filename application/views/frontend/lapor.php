<!-- Contact-->
<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Lapor Gangguan</h2>
            <h3 class="section-subheading text-muted">Silahkan input informasi pada form berikut, untuk melakukan pelaporan.</h3>
        </div>
        <!-- * * * * * * * * * * * * * * *-->
        <!-- * * SB Forms Contact Form * *-->
        <!-- * * * * * * * * * * * * * * *-->
        <!-- This form is pre-integrated with SB Forms.-->
        <!-- To make this form functional, sign up at-->
        <!-- https://startbootstrap.com/solution/contact-forms-->
        <!-- to get an API token!-->
        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="nomor" name="nomor" type="text" placeholder="Nomor Telepon / Internet *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="nomor:required">Nomor wajib di isi.</div>
                    </div>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="email" name="email" type="email" placeholder="Email *" data-sb-validations="required,email" />
                        <div class="invalid-feedback" data-sb-feedback="email:required">Email wajib di isi.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email tersebut tidak valid.</div>
                    </div>
                    <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input class="form-control" id="phone" name="phone" type="text" placeholder="No HP *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="phone:required">No.HP wajib di isi.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea" style="height: 40%;">
                        <!-- Message input-->
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat / Ancer-ancer *" data-sb-validations="required"></textarea>
                        <div class="invalid-feedback" data-sb-feedback="alamat:required">Alamat wajib di isi.</div>
                    </div>
                    <div style="height: 10px;"></div>
                    <div class="form-group form-group-textarea mb-md-0" style="height: 40%;">
                        <!-- Message input-->
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan *" data-sb-validations="required"></textarea>
                        <div class="invalid-feedback" data-sb-feedback="keterangan:required">Keterangan wajib di isi.</div>
                    </div>
                </div>
            </div>
            <!-- Submit success message-->
            <!---->
            <!-- This is what your users will see when the form-->
            <!-- has successfully submitted-->
            <div class="d-none" id="submitSuccessMessage">
                <div class="text-center text-white mb-3">
                    <div class="fw-bolder">Gangguan berhasil dilaporkan!</div>
                    Mohon menunggu ya, teknisi kami segera datang ke rumah Anda.
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
            <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Lapor Gangguan</button></div>
        </form>
    </div>
</section>