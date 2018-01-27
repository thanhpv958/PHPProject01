$(function(){
 
    // $('.menu li').click(function() {
    //     $('.menu li').children('.sub-menu').slideUp();
    //     $(this).children('.sub-menu').slideDown();
       
    // })

    $('.menu li').click(function() {
        $('.menu li').not(this).find('.sub-menu').slideUp();
        $(this).find('.sub-menu').slideToggle();
     });
    
    
})