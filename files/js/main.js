
$(document).ready(function () {
  
  $('.alert').addClass('show');
  $('.alert').click(function () {
    $('.alert').alert('close');
  });

  $('.left').mouseenter(function () {
    $('.container').addClass('hover-left');
  }).mouseleave(function () {
    $('.container').removeClass('hover-left');
  });
  $('.right').mouseenter(function () {
    $('.container').addClass('hover-right');
  }).mouseleave(function () {
    $('.container').removeClass('hover-right');
  });

  $('.filter_form select').change(function () {
    $('.filter_form').submit();
  });


  $('.nav-tabs .nav-link').click(function () {
    let newActiveTab = $(this).attr('href');
    
    $('.sheet-items .active').removeClass('active');
    $(this).addClass('active');
    $(newActiveTab).addClass('active');
  });

});




