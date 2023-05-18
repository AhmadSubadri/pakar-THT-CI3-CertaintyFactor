<section class="py-xxl-10 pb-0" id="home">
    <div class="bg-holder bg-size" style="background-image:url(<?= base_url() ?>assets/asset/img/gallery/hero-bg.png);background-position:top center;background-size:cover;">
    </div>
    <div class="container">
        <div class="row min-vh-xl-100 min-vh-xxl-25">
            <div class="bg-holder bg-size" style="background-image:url(assets/img/gallery/people.png);background-position:top center;background-size:contain;">
            </div>
            <h1 class="text-center">PERIKSA</h1>
            <div class="bg-holder bg-size" style="background-image:url(<?= base_url() ?>assets/asset/img/gallery/dot-bg.png);background-position:bottom right;background-size:auto;">
            </div>
            <div class="col-lg-6 z-index-2 mb-5"><img class="w-100" src="<?= base_url() ?>assets/asset/img/gallery/appointment.png" alt="..." /></div>
            <div class="col-lg-6 z-index-2">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label class="visually-hidden" for="inputName">Name</label>
                        <input class="form-control form-livedoc-control" id="inputName" type="text" placeholder="Name" />
                    </div>
                    <div class="col-md-6">
                        <label class="visually-hidden" for="inputPhone">Umur</label>
                        <input class="form-control form-livedoc-control" id="inputPhone" type="text" placeholder="Umur" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label visually-hidden" for="inputCategory">Jenis Kelamin</label>
                        <select class="form-select" id="inputCategory">
                            <option selected="selected">Jenis Kelamin</option>
                            <option> Laki-Laki</option>
                            <option> Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="visually-hidden" for="inputPhone">Nomor Telp.</label>
                        <input class="form-control form-livedoc-control" id="inputPhone" type="text" placeholder="Nomor Telp" />
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn btn-primary rounded-pill" type="submit">Next Step <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8Zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5Z" />
                                </svg></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>