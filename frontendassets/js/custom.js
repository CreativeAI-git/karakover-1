
     
    
        $(document).ready(function(){

            $("#navbar-toggle").click(function(){
                $('.nav-list').addClass("ct_active");
                $(".ct_mobile_close").addClass("ct_show_close");
            });

            $(".ct_mobile_close").click(function(){
                $('.nav-list').removeClass("ct_active");

                $(".ct_mobile_close").removeClass("ct_show_close");
            });


            AOS.init();
        });

        $(window).scroll(function(){
            var sticky = $('header'),
                scroll = $(window).scrollTop();
          
            if (scroll >= 200) sticky.addClass('ct_sticky');
            else sticky.removeClass('ct_sticky');
          });


          $(function(){
            $('.ct_music_tabs .ct_music_tab a').click(function(){
              var tabId = $(this).attr('data-tab');
              
              $('.ct_music_tab a').removeClass('active');
              $('.ct_music_tabs .Tabcondent').removeClass('active');
              
              $(this).addClass('active');
              $('#'+tabId).addClass('active');
            });
            
          });


          var x=document.getElementById("login");
          var y=document.getElementById("register");
          var z=document.getElementById("ct_btn");
          
          function register() {
            x.style.left = "-200px";
            y.style.left = "190px";
            z.style.left = "110px";
          }
          
          function login() {
            x.style.left = "190px";
            y.style.left = "-500px";
            z.style.left = "0";
          }
          
          const arr = [];
          try{
            arr.push('try');
            throw new Error();
          } catch (e) {
            arr.push ('catch');
          }finally{
            arr.push('finally');
          };




          $('.ct_app_screen_shot').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            autoplay:true,
            autoplayTimeout:2000 ,
            smartSpeed:1000,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:4
                }
            }
        })


       