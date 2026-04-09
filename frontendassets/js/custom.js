
     
    
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

          function resetVideos($scope) {
            var $root = ($scope && $scope.length) ? $scope : owl;
            if (!$root || !$root.length) return;
            $root.find('video').each(function(){
              try {
                this.pause();
                this.currentTime = 0;
              } catch (e) {}
            });
            $root.find('.ct_video_play').removeClass('ct_hide_play');
            $root.find('.ct_video_pause').addClass('ct_hide_play');
          }

          function setVideoUiState($card, isPlaying) {
            if (!$card || !$card.length) return;
            var $playBtn = $card.find('.ct_video_play');
            var $pauseBtn = $card.find('.ct_video_pause');
            if (isPlaying) {
              $playBtn.addClass('ct_hide_play');
              $pauseBtn.removeClass('ct_hide_play');
            } else {
              $playBtn.removeClass('ct_hide_play');
              $pauseBtn.addClass('ct_hide_play');
            }
          }

          function pauseTutorialCarousel($carousel) {
            if (!$carousel || !$carousel.length) return;
            var el = $carousel.get(0);
            if (window.bootstrap && window.bootstrap.Carousel) {
              var instance = window.bootstrap.Carousel.getOrCreateInstance(el);
              instance.pause();
            } else if ($carousel.carousel) {
              $carousel.carousel('pause');
            }
          }

          function cycleTutorialCarousel($carousel) {
            if (!$carousel || !$carousel.length) return;
            var el = $carousel.get(0);
            if (window.bootstrap && window.bootstrap.Carousel) {
              var instance = window.bootstrap.Carousel.getOrCreateInstance(el);
              instance.cycle();
            } else if ($carousel.carousel) {
              $carousel.carousel('cycle');
            }
          }

          function lockTutorialCarousel($carousel, locked) {
            if (!$carousel || !$carousel.length) return;
            if (locked) {
              $carousel.attr('data-video-playing', '1').addClass('ct_carousel_locked');
            } else {
              $carousel.removeAttr('data-video-playing').removeClass('ct_carousel_locked');
            }
          }

          function lockOwlCarousel(locked) {
            if (!owl || !owl.length) return;
            var isLocked = owl.data('ct-locked') === true;
            if (locked === isLocked) return;
            owl.data('ct-locked', !!locked);
            var owlData = owl.data('owl.carousel');
            if (!owlData) return;
            owlData.options.mouseDrag = !locked;
            owlData.options.touchDrag = !locked;
            owlData.options.pullDrag = !locked;
            owlData.options.freeDrag = !locked;
            owl.toggleClass('ct_carousel_locked', !!locked);
            owl.trigger('refresh.owl.carousel');
            if (!locked) {
              owl.trigger('play.owl.autoplay',[bannerAutoplayTimeout]);
            }
          }

          owl.owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            navText:[
              '<span class="ct_nav_btn ct_nav_prev"><i class="fa-solid fa-angle-left"></i></span>',
              '<span class="ct_nav_btn ct_nav_next"><i class="fa-solid fa-angle-right"></i></span>'
            ],
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
          resetVideos(owl);
        });

          owl.trigger('play.owl.autoplay',[bannerAutoplayTimeout]);

        $(document).on('click', '.ct_video_play', function(){
          var $btn = $(this);
          var $card = $btn.closest('.ct_song_card');
          var video = $card.find('video').get(0);
          var $pauseBtn = $card.find('.ct_video_pause');
          if (!video) return;

          var $scope = $card.closest('.ct_app_screen_shot, #tutorialCarousel');
          var isOwl = $scope.is('.ct_app_screen_shot');

          resetVideos($scope);
          setVideoUiState($card, true);

          if (isOwl) {
            owl.trigger('stop.owl.autoplay');
            lockOwlCarousel(true);
          } else {
            pauseTutorialCarousel($scope);
            lockTutorialCarousel($scope, true);
          }

          video.muted = false;
          video.volume = 1;
          var playPromise = video.play();
          if (playPromise && playPromise.catch) {
            playPromise.catch(function(){
              setVideoUiState($card, false);
              if (isOwl) {
                lockOwlCarousel(false);
                owl.trigger('play.owl.autoplay',[bannerAutoplayTimeout]);
              } else {
                lockTutorialCarousel($scope, false);
                cycleTutorialCarousel($scope);
              }
            });
          }

          video.onplaying = function(){
            setVideoUiState($card, true);
          };

          video.onended = function(){
            setVideoUiState($card, false);
            if (isOwl) {
              lockOwlCarousel(false);
              owl.trigger('play.owl.autoplay',[bannerAutoplayTimeout]);
            } else {
              lockTutorialCarousel($scope, false);
              cycleTutorialCarousel($scope);
            }
          };

          video.onpause = function(){
            if (video.currentTime === 0 || video.ended) return;
            setVideoUiState($card, false);
            if (isOwl) {
              lockOwlCarousel(false);
              owl.trigger('play.owl.autoplay',[bannerAutoplayTimeout]);
            } else {
              lockTutorialCarousel($scope, false);
            }
          };
        });

        $(document).on('click', '.ct_video_pause', function(){
          var $btn = $(this);
          var $card = $btn.closest('.ct_song_card');
          var video = $card.find('video').get(0);
          var $playBtn = $card.find('.ct_video_play');
          if (!video) return;

          var $scope = $card.closest('.ct_app_screen_shot, #tutorialCarousel');
          var isOwl = $scope.is('.ct_app_screen_shot');

          video.pause();
          $btn.addClass('ct_hide_play');
          $playBtn.removeClass('ct_hide_play');

          if (isOwl) {
            lockOwlCarousel(false);
            owl.trigger('play.owl.autoplay',[bannerAutoplayTimeout]);
          } else {
            lockTutorialCarousel($scope, false);
          }
        });

        $(document).on('click', '.ct_song_card video', function(){
          var $card = $(this).closest('.ct_song_card');
          if (this.paused) {
            $card.find('.ct_video_play').trigger('click');
          } else {
            $card.find('.ct_video_pause').trigger('click');
          }
        });

        $('#tutorialCarousel').on('slide.bs.carousel', function(e){
          var $carousel = $(this);
          if ($carousel.attr('data-video-playing') === '1') {
            e.preventDefault();
            return;
          }
          resetVideos($carousel);
          cycleTutorialCarousel($carousel);
        });


       
