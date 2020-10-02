// firstviewのスライド
const img1 = document.getElementById('fv-img1')
const img2 = document.getElementById('fv-img2')
const img3 = document.getElementById('fv-img3')

const imgSlide = () => {
  if (img1.classList.contains('active')) {
    img1.classList.remove('active')
    img2.classList.add('active')
  } else if (img2.classList.contains('active')) {
    img2.classList.remove('active')
    img3.classList.add('active')
  } else if (img3.classList.contains('active')) {
    img3.classList.remove('active')
    img1.classList.add('active')
  }
}
setInterval(imgSlide, 6000)


//firstviewの文字
$(function() {
    var $allMsg = $('#fv-title');
    var $wordList = $('#fv-title').html().split("");
    $('#fv-title').html("");
    $.each($wordList, function(idx, elem) {
        var newEL = $("<span/>").text(elem).css({ opacity: 0 });
        newEL.appendTo($allMsg);
        newEL.delay(idx * 70);
        newEL.animate({ opacity: 1 }, 6000);
    });
});


// titleのフェードイン
$(function(){
    $(window).scroll(function (){
        $('.title').each(function(){
            var elemPos = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > elemPos - windowHeight + 150){
                $(this).addClass('scrollin');
            }
        });
    });
});


// point titleのイン
$(function(){
    $(window).scroll(function (){
        $('.point-title').each(function(){
            var elemPos = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > elemPos - windowHeight + 150){
                $(this).addClass('fadein');
            }
        });
    });
});


// menu
setTimeout(() => {
$(function(){
    $(window).scroll(function (){
        $('.menu-item1').each(function(){
            var elemPos = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > elemPos - windowHeight + 100){
                $(this).addClass('show');
            }
        });
    });
});
},0)

setTimeout(() => {
    $(function(){
        $(window).scroll(function (){
            $('.menu-item2').each(function(){
                var elemPos = $(this).offset().top;
                var scroll = $(window).scrollTop();
                var windowHeight = $(window).height();
                if (scroll > elemPos - windowHeight + 100){
                    $(this).addClass('show');
                }
            });
        });
    });
},0)

setTimeout(() => {
    $(function(){
        $(window).scroll(function (){
            $('.menu-item3').each(function(){
                var elemPos = $(this).offset().top;
                var scroll = $(window).scrollTop();
                var windowHeight = $(window).height();
                if (scroll > elemPos - windowHeight + 100){
                    $(this).addClass('show');
                }
            });
        });
    });
},0)

// takeoutのカルーセル

$(function() {
    $('.takeout-items').slick({
        infinite: true,
        arrows: false,
        dots:false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        responsive: [{
            breakpoint: 769,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                }
        },{
        breakpoint: 700,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
        },{
        breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
        }
        ]
    });
});


// photoのカルーセル
var mySwiper = new Swiper('.swiper-container', {
    loop: true,
    autoplay: {
		delay: 3500,
		stopOnLastSlide: false,
		disableOnInteraction: false,
		reverseDirection: false
    },
    spaceBetween: 10,
    slidesPerView: 3,
    slidesPerGroup: 3,
    pagination: {
		el: '.swiper-pagination',
		type: 'bullets',
		clickable: true
    },
    breakpoints: {
        991: {
			slidesPerView: 3,
			slidesPerGroup: 1,
			spaceBetween: 10
		},
		768: {
			slidesPerView: 2,
			slidesPerGroup: 1,
			spaceBetween: 10
		},
		375: {
			slidesPerView: 1,
			slidesPerGroup: 1,
			spaceBetween: 10
		}
	},
});


// map
$(function(){
    $(window).scroll(function (){
        $('.access-map iframe').each(function(){
            var elemPos = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > elemPos - windowHeight + 150){
                $(this).addClass('active');
            }
        });
    });
});




