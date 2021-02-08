 var arr = $('.gallery');
        for (var i = 0; i< arr.length; ++i){
          if(i==0){
            $(arr[i]).addClass('active');
            $(arr[i]).find('gallery-slider').slick();
          } else{
            $(arr[i]).addClass('hide');
          }
          // console.log($(arr[i]).html());
        }

        $('.tunnel-slider').click(function(){
          // Удаляем класс .active у активной галерии и добавляем .hide
          $('.gallery.active').removeClass('active').addClass('hide');
          /*Извлекаем значение атрибута  [data-target] у сдлайдера по которому кликнули*/
          var target = $(this).attr('data-target'); //1
          /*Помещяем название атрибута со значением в перемнную object*/
          var object = '[data-name="' + target + '"]'; //[data-name="1"]
          $(object).removeClass('hide').addClass('active');

          // $(object).find('slider').slick();
          // $('.prev arrow').click();
        });
  