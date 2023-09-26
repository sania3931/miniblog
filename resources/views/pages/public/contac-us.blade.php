@extends('templates.public.main')
@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>@lang('contact.contactUs')</h2>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Contact Section ======= -->
<div class="map-section">
    <iframe style="border:0; width: 100%; height: 350px;"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63366.52146683452!2d111.3863242934176!3d-6.961151812502969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7740e3a326c045%3A0x6f5bfd9bc5ace9b8!2sBlora%2C%20Blora%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1690099575080!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        frameborder="0" allowfullscreen></iframe>
</div>

<section id="contact" class="contact">
    <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

            <div class="col-lg-10">

                <div class="info-wrap">
                    <div class="row col d-block d-sm-flex justify-content-evenly mt-2 mt-sm-5">
                        <div class="col-lg-4 info">
                            <i class="fa fa-map-marker me-3"></i>
                            <h4>Location:</h4>
                            <p>Blora,Jawa Tengah, Indonesia</p>
                        </div>

                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <i class="fas fa-envelope me-3"></i>
                            <h4>Email:</h4>
                            <p>genius@gmail.com</p>
                        </div>

                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <i class="fas fa-phone me-3"></i>
                            <h4>Call:</h4>
                            <p>+62 234 567 88</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
<style>
    .breadcrumbs {
        padding: 15px 0;
        background: blue;
        min-height: 40px;
        margin-top: 0px;

    }

    .contact .info-wrap {
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .contact .info {
        background: #fff;
    }

    .contact .info i {
        font-size: 20px;
        color: blue;
        float: left;
        width: 44px;
        height: 44px;
        border: 1px solid blue;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50px;
        transition: all 0.3s;
    }

    .breadcrumbs h2 {
        font-size: 26px;
        font-weight: 300;
        color: #fff;
    }

    .breadcrumbs ol {
        display: flex;
        flex-wrap: wrap;
        list-style: none;
        padding: 0;
        margin: 0;
        color: #fff;
    }

    li {
        display: list-item;
        text-align: -webkit-match-parent;
    }
</style>
