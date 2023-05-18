<section class="py-xxl-10 pb-0" id="home">
    <div class="bg-holder bg-size" style="background-image:url(<?= base_url() ?>assets/asset/img/gallery/hero-bg.png);background-position:top center;background-size:cover;">
    </div>
    <div class="container">
        <div class="row min-vh-xl-100 min-vh-xxl-25">
            <div class="bg-holder bg-size" style="background-image:url(assets/img/gallery/people.png);background-position:top center;background-size:contain;">
            </div>
            <h1 class="text-center">KONTAK</h1>
            <div class="bg-holder bg-size" style="background-image:url(<?= base_url() ?>assets/asset/img/gallery/dot-bg.png);background-position:bottom right;background-size:auto;">
            </div>
            <div class="col-lg-6 z-index-2 mb-5"><img class="w-100" src="<?= base_url() ?>assets/asset/img/gallery/kontak_2.png" alt="..." /></div>
            <div class="col-lg-6 z-index-2">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label class="visually-hidden" for="inputName">Name</label>
                        <input class="form-control form-livedoc-control form-control-sm" id="inputName" type="text" placeholder="Name" />
                    </div>
                    <div class="col-md-6">
                        <label class="visually-hidden" for="inputPhone">Phone</label>
                        <input class="form-control form-livedoc-control" id="inputPhone" type="text" placeholder="Phone" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label visually-hidden" for="inputCategory">Category</label>
                        <select class="form-select" id="inputCategory">
                            <option selected="selected">Category</option>
                            <option> Category One</option>
                            <option> Category Two</option>
                            <option> Category Three</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label visually-hidden" for="inputEmail">Email</label>
                        <input class="form-control form-livedoc-control" id="inputEmail" type="email" placeholder="Email" />
                    </div>
                    <div class="col-md-12">
                        <label class="form-label visually-hidden" for="validationTextarea">Message</label>
                        <textarea class="form-control form-livedoc-control" id="validationTextarea" placeholder="Message" style="height: 250px;" required="required"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn btn-primary rounded-pill" type="submit">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>