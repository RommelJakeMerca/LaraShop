$(document).ready(function(){

    $('#menu').click(function(){
        $(this).toggleClass('fa-times');
        $('.navbar').toggleClass('nav-toggle');
    });

    $(window).on('scroll load',function(){

        $('#menu').removeClass('fa-times');
        $('.navbar').removeClass('nav-toggle');

        $('section').each(function(){

            let top = $(window).scrollTop();
            let height = $(this).height();
            let offset = $(this).offset().top - 200;
            let id = $(this).attr('id');

            if(top >= offset && top < offset + height){
                $('.navbar ul li a').removeClass('active');
                $('.navbar').find(`[href="#${id}"]`).addClass('active');
            }

        });

    });

    $('.accordion-heading').click(function(){

        $('.accordion .accordion-content').slideUp();

        $(this).next('.accordion-content').slideDown();

    });

    // gsap animation
    gsap.from('.home_img', {opacity: 0, duration: 2, delay: .5, x:60})
    gsap.from('.home_data', {opacity: 0, duration: 2, delay: .8, y:25})
    gsap.from('.home_greeting, .home_name, .home_profession, .home_button', {opacity: 0, duration: 2, delay: 1, y:25, ease: 'expo.out', stagger: .2})
    gsap.from('.nav_logo, .nav_toggle', {opacity: 0, duration: 2, delay: 1.5, y:25, ease: 'expo.out', stagger: .2})
    gsap.from('.nav_item', {opacity: 0, duration: 2, delay: 1.8, y:25, ease: 'expo.out', stagger: .2})
    gsap.from('.faq', {opacity: 0, duration: 2, delay: 1.8, y:25, ease: 'expo.out', stagger: .2})
    gsap.from('.home_social-icon', {opacity: 0, duration: 2, delay: 2.3, y:25, ease: 'expo.out', stagger: .2})

});