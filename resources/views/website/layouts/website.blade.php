<!doctype html>
<html class="no-js">
<head>
   <meta charset="utf-8">
   <title>@yield('title')</title>
   @include('website.partials.head')
</head>
<body id="ap-milk-store" class="template-index  header-default layout-default  skin-default " >
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="VyCVfEcz"></script>
   <div class="website_loader"></div>
   <div id="page">
      <section id="page_content" class="">
         @include('website.partials.header')
         <main class="main-content" role="main">
            <section id="columns" class="columns-container">

               @yield('content')


            </section>
         </main>
         @include('website.partials.footer')
      </section>
       <!-- Messenger Plugin chat Code -->
       <!-- Messenger Plugin chat Code -->


      <p id="back-top" style=" bottom: 90px; ">
         <a href="#top" title="Scroll To Top">Scroll To Top</a>
      </p>
       <!--messenger-->
       <!-- Messenger Plugin chat Code -->
       <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet" />
       <p id="messenger_cus" style="bottom: 25px;">
           <a style="    font-size: 55px;
    color: #00bfff;
    position: fixed;
    right: 30px;
    bottom: 30px;" class="fab fa-facebook-messenger" href="https://m.me/107527408134434?fbclid=IwAR30tXx6enUXFPkgJK6_o29uqrxVPZr7gnpVAagsoaSVD6xZexCwLuYo6C4" target="_blank"></a>
       </p>
   </div>
   @include('website.partials.fb_messenger')
   @stack('fb_comment')
</body>
@include('website.partials.scripts')
</html>
