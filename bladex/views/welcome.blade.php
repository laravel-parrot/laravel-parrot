<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- <style media="screen">
      {!! file_get_contents(parrot_path('bladex/css/test.css'))!!}
    </style> -->
    <link rel="stylesheet" href="{{assetx('css/test.css')}}">

  </head>
  <body>
    <div class="header_part">
      <h1>welcome to parrot project</h1>
      <p>{{mime_content_type(parrot_path('bladex/css/test.css'))}}</p>
      <a href="{{asset2x('blog','routes/web.php')}}" target="_blank">me</a>

      <div class="">
        <img style="width:100%" src="{{assetx('test.png')}}" alt="">
      </div>
    </div>
  </body>
</html>
