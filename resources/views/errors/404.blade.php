<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>Hously - Tailwind CSS Real Estate Website Landing Page Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Real Estate Website Landing Page" name="description" />
    <meta content="Real Estate, buy, sell, Rent, tailwind Css" name="keywords" />
    <meta name="author" content="Shreethemes" />
    <meta name="website" content="https://shreethemes.in" />
    <meta name="email" content="support@shreethemes.in" />
    <meta name="version" content="2.0.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- Css -->
    <!-- Main Css -->
    <link href="/libs/@iconscout/unicons/css/line.css" type="text/css" rel="stylesheet" />
    <link href="/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/tailwind.css" />

</head>

<body class="dark:bg-slate-900">
<!-- Loader Start -->
<!-- <div id="preloader">
    <div id="status">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
</div> -->
<!-- Loader End -->
<section class="relative bg-green-600/5">
    <div class="container-fluid relative">
        <div class="grid grid-cols-1">
            <div class="flex flex-col min-h-screen justify-center md:px-10 py-10 px-4">
                <div class="text-center">
                    <a href="{{route('home.index',['locale'=>app()->getLocale()])}}"><img src="/images/logo-icon-64.png" class="mx-auto" alt=""></a>
                </div>
                <div class="title-heading text-center my-auto">
                    <img src="/images/error.png" class="mx-auto" alt="">
                    <h1 class="mt-3 mb-6 md:text-4xl text-3xl font-bold">Page Not Found?</h1>
                    <p class="text-slate-400">Whoops, this is embarassing. <br> Looks like the page you were looking for wasn't found.</p>

                    <div class="mt-4">
                        <a href="{{route('home.index',['locale'=>app()->getLocale()])}}" class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md">Back to Home</a>
                    </div>
                </div>
                <div class="text-center">
                    <p class="mb-0 text-slate-400">© <script>document.write(new Date().getFullYear())</script> Hously. Design with <i class="mdi mdi-heart text-red-600"></i> by <a href="https://shreethemes.in/" target="_blank" class="text-reset">Shreethemes</a>.</p>
                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->

<div class="fixed bottom-3 end-3 z-10">
    <a href="" class="back-button btn btn-icon bg-green-600 hover:bg-green-700 text-white rounded-full"><i data-feather="arrow-left" class="h-4 w-4"></i></a>
</div>


<!-- JAVASCRIPTS -->
<script src="/libs/particles.js/particles.js"></script>
<script src="/libs/feather-icons/feather.min.js"></script>
<script src="/js/plugins.init.js"></script>
<script src="/js/app.js"></script>
<!-- JAVASCRIPTS -->
</body>
</html>