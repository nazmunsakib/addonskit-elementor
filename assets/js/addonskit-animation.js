(function($) {
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/addonskit-animated-heading.default', function($scope, $) {
            const fadeAnimateHeading    = $scope.find(".ake-simple-fade");
            const burnInAnimateHeading  = $scope.find(".ake-lbl-fade");
            const glowReveal            = $scope.find(".ake-glow-reveal");
            const liftFade              = $scope.find(".ake-lift-fade");
            const slideFade              = $scope.find(".ake-slide-fade");


            // Function to wrap each letter in a span
            const wrapLetters = (element) => {
                if (!element) {
                    return;
                }
            
                element.innerHTML = element.textContent.replace(/\S/g, "<span class='ake-letter'>$&</span>");
            };
            
            if( fadeAnimateHeading.length > 0 ){
                for( let heading of fadeAnimateHeading ){
                    const timeline = gsap.timeline();
                    timeline.to(heading, {
                        duration: 1.5,
                        autoAlpha: 0,
                        y: -50,
                        scale: 1.05,
                        ease: "power1.in",
                    })
                    .to(heading, {
                        duration: 1.5,
                        autoAlpha: 1,
                        y: 0,
                        scale: 1,
                        delay: 1.0,
                        ease: "power1.out",
                    });
                }
            }

            if( burnInAnimateHeading.length > 0 ){
                for( let heading of burnInAnimateHeading ){

                    wrapLetters(heading);
                    
                    anime.timeline({loop: true})
                      .add({
                        targets: '.ake-lbl-fade .ake-letter',
                        scale: [4,1],
                        opacity: [0,1],
                        translateZ: 0,
                        easing: "easeOutExpo",
                        duration: 950,
                        delay: (el, i) => 70*i
                      }).add({
                        targets: '.ake-lbl-fade',
                        opacity: 0,
                        duration: 1000,
                        easing: "easeOutExpo",
                        delay: 1000
                      });
                }
            }

            if( glowReveal.length > 0 ){
                for( let heading of glowReveal ){
                    wrapLetters(heading);

                    anime.timeline({loop: true})
                    .add({
                        targets: '.ake-glow-reveal .ake-letter',
                        opacity: [0,1],
                        easing: "easeInOutQuad",
                        duration: 2250,
                        delay: (el, i) => 150 * (i+1)
                    }).add({
                        targets: '.ake-glow-reveal',
                        opacity: 0,
                        duration: 1000,
                        easing: "easeOutExpo",
                        delay: 1000
                    });
                }
            }

            if( liftFade.length > 0 ){
                for( let heading of liftFade ){
                    wrapLetters(heading);

                    anime.timeline({loop: true})
                    .add({
                      targets: '.ake-lift-fade .ake-letter',
                      translateY: ["1.1em", 0],
                      translateZ: 0,
                      duration: 750,
                      delay: (el, i) => 50 * i
                    }).add({
                      targets: '.ake-lift-fade',
                      opacity: 0,
                      duration: 1000,
                      easing: "easeOutExpo",
                      delay: 1000
                    });
                }
            }

            if( slideFade.length > 0 ){
                for( let heading of slideFade ){

                    wrapLetters(heading);

                    anime.timeline({loop: true})
                    .add({
                        targets: '.ake-slide-fade .ake-letter',
                        translateX: [40,0],
                        translateZ: 0,
                        opacity: [0,1],
                        easing: "easeOutExpo",
                        duration: 1200,
                        delay: (el, i) => 500 + 30 * i
                    }).add({
                        targets: '.ake-slide-fade .ake-letter',
                        translateX: [0,-30],
                        opacity: [1,0],
                        easing: "easeInExpo",
                        duration: 1100,
                        delay: (el, i) => 100 + 30 * i
                    });
                }
            }
        
        });
    });
})(jQuery);