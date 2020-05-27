$(document).ready(function () {
    $("a").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function () {
                window.location.hash = hash;
            });
        }
    });
});

$(window).scroll(function () {

    var navTop = $('#categorie').position();
    if ($(this).scrollTop() > navTop.top) {
        $('.retour').addClass("on");
    } else {
        $('.retour').removeClass("on");
    }
})