$(document).ready(function(){

   $('.btn').click(function(){
      $(this).parent('.item').removeClass('active').addClass('done');
      $(this).removeClass('btn-active').addClass('disabled');
   })

});
