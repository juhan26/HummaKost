var swiper = new Swiper(".courseSwipper", {
    cssMode: true,
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    loopFillGroupWithBlank: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        clickable: true,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 16,
        },
        991: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1200: {
            slidesPerView: 3,
            spaceBetween: 24,
        },
    },
    mousewheel: true,
    keyboard: true,
});
var swiper2 = new Swiper(".instructorSwipper", {
    cssMode: true,
    slidesPerView: 1,
    spaceBetween: 16,
    loop: true,
    loopFillGroupWithBlank: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        clickable: true,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 16,
        },
        991: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1200: {
            slidesPerView: 3,
            spaceBetween: 24,
        },
        1500: {
            slidesPerView: 4,
            spaceBetween: 24,
        },
    },
    mousewheel: true,
    keyboard: true,
});

var swiper3 = new Swiper(".testimonialSwipper", {
    cssMode: true,
    slidesPerView: 1,
    spaceBetween: 24,
    loop: true,
    loopFillGroupWithBlank: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        clickable: true,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        1024: {
            slidesPerView: 2,
            spaceBetween: 24,
        },
    },
    mousewheel: true,
    keyboard: true,
});

$('.counter').counterUp({
    delay: 10,
    time: 1000
});


AOS.init();

var menuBtn = document.getElementById('hamburger-btn');
var menuBtnClose = document.getElementById('hamburger-btn-close');
var navMenu = document.getElementById('nav-menu')
var overlay = document.getElementById('overlay')

menuBtn.addEventListener('click', () => {
    navMenu.classList.add('open')
    overlay.classList.add('open')
})
menuBtnClose.addEventListener('click', () => {
    navMenu.classList.remove('open')
    overlay.classList.remove('open')
})
overlay.addEventListener('click', () => {
    navMenu.classList.remove('open')
    overlay.classList.remove('open')
})

$(window).on('scroll', function() {
    var scroll = $(window).scrollTop();
    if (scroll < 100) {
        $("#header-sticky").removeClass("header-sticky");
    } else {
        $("#header-sticky").addClass("header-sticky");
    }
});