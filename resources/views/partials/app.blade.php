@include('partials.header')

@include('partials.topmenu')

  <div id="wrapper">

    <!-- Sidebar -->
    @include('partials.sidebar')

    <div id="content-wrapper">
        <div class="container-fluid">

            <!-- Breadcrumbs-->
            

     @yield('content')
      <!-- /.container-fluid -->

    </div>
      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
 @include('partials.footer')