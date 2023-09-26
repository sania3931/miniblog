<!DOCTYPE html>
<html lang="en">
@include('templates.public.head')
<body>
   @include('templates.public.nav')
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="my-5">
   @yield('content')
  </main>
  <!--Main layout-->
  @include('templates.public.footer')

  <!--Footer-->

  <!--Footer-->
    <!-- MDB -->

</body>
</html>