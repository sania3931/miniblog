<!-- Footer -->
<footer class="text-center text-lg-start bg-dark text-muted">
    <!-- Section: Links  -->
    <section class="mt-5">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-5">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 mt-5">
            <!-- Content -->
            <div class="footer-widget">
                <div class="footer-logo">
                    <a href="index.html" class="logo"><img src="{{ asset('images/logo-genius-tagline.png') }}" alt="" width="300px"></a>
                </div>
                <p>Nec feugiat nisl pretium fusce id velit ut tortor pretium. Nisl purus in mollis nunc sed. Nunc non blandit massa enim nec.</p>
            </div>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 mt-5">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
                @lang('footer.usefulLinks')
            </h6>
            <p>
              <a href="{{url('artikel-tentang')}}" class="text-reset">@lang('contact.aboutUs')</a>
            </p>
            <p>
              <a href="{{url('artikel-privacy')}}" class="text-reset">@lang('footer.privacy')</a>
            </p>
            {{-- <p>
              <a href="#!" class="text-reset">Vue</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Laravel</a>
            </p> --}}
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 mt-5">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
                @lang('footer.explore')
            </h6>
            {{-- <p>
              <a href="#!" class="text-reset">Pricing</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Settings</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Orders</a>
            </p> --}}
            <p>
              <a href="{{url('artikel-faq')}}" class="text-reset">FAQ</a>
            </p>
            <p>
                <a href="{{url('artikel-contac')}}" class="text-reset">@lang('footer.contactUs')</a>
                </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 mt-5">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">@lang('footer.socilaMedia')</h6>
            <section class="mb-4">
                <!-- Facebook -->
                <a
                  class="btn text-white btn-floating m-1"
                  style="background-color: #3b5998;"
                  href="#!"
                  role="button"
                  ><i class="fab fa-facebook-f"></i
                ></a>

                <!-- Twitter -->
                <a
                  class="btn text-white btn-floating m-1"
                  style="background-color: #55acee;"
                  href="https://twitter.com/dfherrrrr?t=rjI0KVfvi9uooJNA86NK_Q&s=09"
                  role="button"
                  ><i class="fab fa-twitter"></i
                ></a>

                <!-- Google -->
                <a
                  class="btn text-white btn-floating m-1"
                  style="background-color: #dd4b39;"
                  href="#!"
                  role="button"
                  ><i class="fab fa-google"></i
                ></a>

                <!-- Instagram -->
                <a
                  class="btn text-white btn-floating m-1"
                  style="background-color: #ac2bac;"
                  href="https://www.instagram.com/niah.sh_/"
                  role="button"
                  ><i class="fab fa-instagram"></i
                ></a>

                <!-- Linkedin -->
                <a
                  class="btn text-white btn-floating m-1"
                  style="background-color: #0082ca;"
                  href="https://www.linkedin.com/in/sani-ah-sani-ah-9323a4267/"
                  role="button"
                  ><i class="fab fa-linkedin-in"></i
                ></a>
                <!-- Github -->
                <a
                  class="btn text-white btn-floating m-1"
                  style="background-color: #333333;"
                  href="https://github.com/sania3931"
                  role="button"
                  ><i class="fab fa-github"></i
                ></a>
              </section>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->
    {{-- <div class="container p-0 pb-0 text-center">
        <!-- Section: Social media -->
        <section class="mb-4">
          <!-- Facebook -->
          <a
            class="btn text-white btn-floating m-1"
            style="background-color: #3b5998;"
            href="#!"
            role="button"
            ><i class="fab fa-facebook-f"></i
          ></a>

          <!-- Twitter -->
          <a
            class="btn text-white btn-floating m-1"
            style="background-color: #55acee;"
            href="https://twitter.com/dfherrrrr?t=rjI0KVfvi9uooJNA86NK_Q&s=09"
            role="button"
            ><i class="fab fa-twitter"></i
          ></a>

          <!-- Google -->
          <a
            class="btn text-white btn-floating m-1"
            style="background-color: #dd4b39;"
            href="#!"
            role="button"
            ><i class="fab fa-google"></i
          ></a>

          <!-- Instagram -->
          <a
            class="btn text-white btn-floating m-1"
            style="background-color: #ac2bac;"
            href="https://www.instagram.com/niah.sh_/"
            role="button"
            ><i class="fab fa-instagram"></i
          ></a>

          <!-- Linkedin -->
          <a
            class="btn text-white btn-floating m-1"
            style="background-color: #0082ca;"
            href="https://www.linkedin.com/in/sani-ah-sani-ah-9323a4267/"
            role="button"
            ><i class="fab fa-linkedin-in"></i
          ></a>
          <!-- Github -->
          <a
            class="btn text-white btn-floating m-1"
            style="background-color: #333333;"
            href="https://github.com/sania3931"
            role="button"
            ><i class="fab fa-github"></i
          ></a>
        </section>
        <!-- Section: Social media -->
    </div> --}}

    <!-- Copyright -->
    {{-- <div class="text-center mb-3">
        <p class="text-center bg-dark">Copyright @2023 | Designed With by <a href="#">Genius.id</a></p>
        <a class="text-reset fw-bold" href="https://mdbootstrap.com/">Genius.id</a>
    </div> --}}
    <div class="text-center p-2" style="background-color: lightgray!important;">
        <p class="text-center bg-dark">@lang('footer.copyright') @2023 | @lang('footer.designedWithBy') <a href="#">Genius.id</a></p>
      {{-- © 2023 Copyright:
      <a class="text-reset fw-bold" href="https://mdbootstrap.com/">Genius.id</a> --}}
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
<!--Footer-->
  {{-- <footer class="bg-light text-lg-start">

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2023 Copyright:
      <a class="text-dark" href="https://mdbootstrap.com/">Genius.id</a>
    </div>
    <!-- Copyright -->
  </footer> --}}
  <!--Footer-->
    <!-- MDB -->

    <script src="{{asset('admin/vendor/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('user/js/mdb.min.js')}}"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="{{ asset('user/js/script.js')}}"></script>
    @yield('script')
