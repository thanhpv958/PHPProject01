$(function(){
    
    $('.menu li').click(function() {
        $('.menu li').not(this).find('.sub-menu').slideUp();
        $(this).find('.sub-menu').slideToggle();
    });

    $('.btnSidebar').click(function() {
        $('.sidebar').addClass('showmenu');
    })

    $('.content').click(function() {
        if ( $('.sidebar').hasClass('showmenu') ) {
            $('.sidebar').removeClass('showmenu');
        }
    })
     
})