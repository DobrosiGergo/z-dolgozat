
$(document).ready(function () {

  $('.alert').addClass('show');
  $('.alert').click(function () {
    $('.alert').remove();
    $('.flash-container').remove();
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
    let newActiveTab = '#' + $(this).attr('data-tab');

    $('.sheet-items .active').removeClass('active');
    $(this).addClass('active');
    $(newActiveTab).addClass('active');
  });

  let isopened = true;
  toggleSidebar = function () {
    if (isopened) {
      $('.sidebar').removeClass('isOpened');
    }
    else {
      $('.sidebar').addClass('isOpened');
    }
    isopened = !isopened;
  };

  setTimeout(toggleSidebar, 1000);

  $('.sidebar .toggle').click(toggleSidebar);

});




