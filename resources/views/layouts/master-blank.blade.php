<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo translate('app_name') ." - ".translate('admin_login'); ?></title>
        <meta content="<?php echo translate('admin_panel') ?>" name="description" />
        <meta content="{{config('app.author')}}" name="author" />
        @include('layouts.head')
  </head>
    <body class="pb-0" >
        @yield('content')
        @include('layouts.footer-script')
        @include('includes.flash')
    </body>
</html>
