<!DOCTYPE html>

  <html>

    <head>

      <meta charset="utf-8">

      <meta httpequiv="XUACompatible" content="IE=edge">

      <meta name="viewport" content="width=devicewidth, initialscale=1">

      <title>Training Laravel</title>

      <?= stylesheetLinkTag() ?>

      <?= javascript_include_tag() ?>

    </head>

    <body style="padding-top:60px;">

      <!--bagian navigation-->

      @include('shared.head_nav')


      <!-- Bagian Content -->

      <div class="container clearfix">

        <div class="row row-offcanvas row-offcanvas-left ">

          <!--Bagian Kiri-->

          @include("shared.left_nav")


          <!--Bagian Kanan-->

          <div id="main-content" class="col-xs-12 col-sm-9 main pull-right">

            <div class="panel-body">

              @yield("content")

            </div>

          </div>

        </div>

      </div>

    </body>

  </html>