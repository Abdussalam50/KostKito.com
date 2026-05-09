<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name='csrf-token' content="{{csrf_token()}}">
    <title>KostKito.id</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="manifest" href="{{ url('pwa/manifest.json') }}">
    <link
      rel="icon"
      href="{{url('../kaiadmin/assets/img/kaiadmin/favicon.ico')}}"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{url('../kaiadmin/assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{url('../kaiadmin/assets/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <script src='	https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js'></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="{{url('../kaiadmin/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{url('../kaiadmin/assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{url('../kaiadmin/assets/css/kaiadmin.min.css')}}" /> -->

    <!-- CSS Just for demo purpose, don't include it in your project -->
<!-- `    <link rel="stylesheet" href="{{url('../kaiadmin/assets/css/demo.css')}}" />` -->
  </head>