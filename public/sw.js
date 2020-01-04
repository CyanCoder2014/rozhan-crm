const STAYIC_CATCH_VERSION =' static_2'
const STATIC_ASSETS=[
    '/',
    '/index.html',
    //  '/js/app.js',
    // // '/dist/js/pages/jquery.min.js',
    //  '/dist/css/AdminLTE.css',
    // // '/dist/css/rtl.css',
    // // '/dist/css/bootstrap-theme.css',
    // '/dist/css/rtl.css',
    // '/dist/css/skins/_all-skins.css',
    // '/dist/css/bootstrap-theme.css',
    // '/dist/css/style.css',
    // '/dist/css/responsive.css',
    // '/dist/css/jquery.skeduler.css',
    // '/cal2/JalaliJSCalendar/skins/aqua/theme.css',
    // '/cal2/custom.css',
    // '/file/FontAwesome.css',
    // '/file/Bootstrap3.css',
    // '/file/snotify.css',
    // '/file/jQuery.js',
    // '/file/bootstrap3.min.js',
    // '/file/moment.js',
    // '/dist/js/pages/Chart.min.js',
    // '/dist/js/pages/jquery.min.js',
    // '/dist/js/pages/dashboard2.js',
    // '/cal2/JalaliJSCalendar/jalali.js',
    // '/cal2/JalaliJSCalendar/calendar.js',
    // '/cal2/JalaliJSCalendar/calendar-setup.js',
    // '/cal2/JalaliJSCalendar/lang/calendar-fa.js',
    // 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
    // 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js',
    // 'https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js',
    // 'https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js',
    // '/dist/js/pages/adminlte.min.js',
    // '/file/chart.js',
    // '/manifest.json',
    // '/fonts/Sahel.ttf',
    // '/favicon-32x32.png',
    // '/favicon-16x16.png',
    // '/favicon-96x96.png',
    // 'http://localhost:8000/fonts/fontawesome-webfont.ttf?v=4.7.0 ',
    // 'http://localhost:8000/images/icons/android-icon-144x144.png',
    // `/login`
]

self.addEventListener("install",function (e) {
    console.log(`[sw] insyalling sw`,e)
    e.waitUntil(
        caches.open(STAYIC_CATCH_VERSION)
            .then((cache) =>{
             return cache.addAll(STATIC_ASSETS)
        }).catch(function (e) {
            console.error(`[sw] catch ready install error `+e )
        })
    )

})

self.addEventListener("activate",function (e) {
    // console.log(`[sw] activate sw`,e)
})

self.addEventListener("fetch",function (e) {
    // console.log(`[sw] fetch sw`,e)
     const request = e.request;
    // console.log(e.request ,"sssssdadas")
    // if(request.url){
    //     console.log("init")
    //     e.respondWith(
    //         caches.match(request).then((response)=>{
    //             return response
    //         })
    //         .catch(console.error)
    //     )
    //
    // }
})