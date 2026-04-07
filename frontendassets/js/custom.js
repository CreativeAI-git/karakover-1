
     
    
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




          var owl = $('.ct_app_screen_shot');
          var bannerAutoplayTimeout = 3000;

          function resetVideos() {
            owl.find('video').each(function(){
              try {
                this.pause();
                this.currentTime = 0;
              } catch (e) {}
            });
            owl.find('.ct_video_play').removeClass('ct_hide_play');
            owl.find('.ct_video_pause').addClass('ct_hide_play');
          }

          owl.owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            autoplay:true,
            autoplayTimeout:bannerAutoplayTimeout,
            autoplayHoverPause:true,
            smartSpeed:800,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        });

          owl.on('changed.owl.carousel', function() {
          resetVideos();
          owl.trigger('play.owl.autoplay',[bannerAutoplayTimeout]);
        });

        $(document).on('click', '.ct_video_play', function(){
          var $btn = $(this);
          var $card = $btn.closest('.ct_song_card');
          var video = $card.find('video').get(0);
          var $pauseBtn = $card.find('.ct_video_pause');
          if (!video) return;

          resetVideos();
          $btn.addClass('ct_hide_play');
          $pauseBtn.removeClass('ct_hide_play');
          owl.trigger('stop.owl.autoplay');
          video.play();

          video.onended = function(){
            $btn.removeClass('ct_hide_play');
            $pauseBtn.addClass('ct_hide_play');
            owl.trigger('play.owl.autoplay',[bannerAutoplayTimeout]);
          };

          video.onpause = function(){
            if (video.currentTime === 0 || video.ended) return;
            $btn.removeClass('ct_hide_play');
            $pauseBtn.addClass('ct_hide_play');
            owl.trigger('play.owl.autoplay',[bannerAutoplayTimeout]);
          };
        });

        $(document).on('click', '.ct_video_pause', function(){
          var $btn = $(this);
          var $card = $btn.closest('.ct_song_card');
          var video = $card.find('video').get(0);
          var $playBtn = $card.find('.ct_video_play');
          if (!video) return;
          video.pause();
          $btn.addClass('ct_hide_play');
          $playBtn.removeClass('ct_hide_play');
          owl.trigger('play.owl.autoplay',[bannerAutoplayTimeout]);
        });


       
