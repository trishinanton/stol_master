var arrayOfGallerys = $('.gallery'); 
console.log(arrayOfGallerys);




for(i=0; arrayOfGallerys.length-1; i++ ){
    if(i=0){
        arrayOfGallerys[i].addClass('active');
        arrayOfGallerys[i].find('slider').slick();
    }
    arrayOfGallerys[i].addClass('hide')
}


$('.tunnel-slider').click(function(){
    $('.gallery.active').removeClass('active').addClass('hide');
    var target = $(this).attr('data-target'); //1
    var object = '[data-name="' + target + '"]'; //[data-name="1"]
    $(object).removeClass('hide').addClass('active');
    $(object).find('slider').slick();
}


