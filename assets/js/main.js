
$(function () {
  //スマホボタン
  $(".l-header__hamburger").click(function () {
    $(this).toggleClass('active');
    $(".l-header__nav").toggleClass('panelactive');
  });

  $(".l-header__nav .menu-item a").click(function () {
    $(".l-header__hamburger").removeClass('active');
    $(".l-header__nav").removeClass('panelactive');
  });

  //トップスクロール挙動
  $('.l-footer__topscroll').click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 500);
    return false;
  });

  //メニューにカレント追加
  $(".l-header__nav .menu-item a").each(function () {
    if (this.href == location.href) {
      $(this).parents("li").addClass("current");
    }
  });
});

//画像のフェードインアニメ
function imageanime() {
  $('.js-fadeintrigger').each(function () {
    var elemPos2 = $(this).offset().top - 50;
    var userscroll = $(window).scrollTop();
    var windowHeight2 = $(window).height();
    if (userscroll >= elemPos2 - windowHeight2) {
      $(this).addClass('js-fadein');
    }
  });
}

//スクロールボタンの表示・非表示
function PageTopAnime() {
  var scroll = $(window).scrollTop();
  if (scroll >= 200) {
    $('.l-footer__topscroll').removeClass('js-downmove');
    $('.l-footer__topscroll').addClass('js-upmove');
  } else {
    if ($('.l-footer__topscroll').hasClass('js-upmove')) {
      $('.l-footer__topscroll').removeClass('js-upmove');
      $('.l-footer__topscroll').addClass('js-downmove');
    }
  }
}

//header背景
function HeaderFixAnime() {
  var scroll = $(window).scrollTop();
  if (scroll >= 200) {
    $('.l-header').removeClass('nofixed');
    $('.l-header').addClass('fixed');
  } else {
    if ($('.l-header').hasClass('fixed')) {
      $('.l-header').removeClass('fixed');
      $('.l-header').addClass('nofixed');
    }
  }
}

$(window).on('load', function () {
  $('body').addClass('appear');
});

$(window).scroll(function () {
  imageanime();
  PageTopAnime();
  HeaderFixAnime();
});