$(document).ready(function() {
  var modalButton = $("[data-toggle=modal]");
  var modalCloseBtn = $(".modal-close");
  var modalWindow = $(".modal");
  var modalOverlay = $(".overlay");
  var body = $("body");

  // закрыть модальное окно на esc
  $(document).on("keydown", function(e) {
    if (e.keyCode == 27)
    var modalOverlay = $(".overlay");
    var modalWindow = $(".modal");
    modalOverlay.removeClass("overlay--show");
    modalWindow.removeClass("modal--active");
    body.removeClass("overflow");
  })

  // закрыть модальное окно по щелчку вне окна
  $(document).click(function(e) {
    if (!modalButton.is(e.target) && modalWindow.is(e.target) && modalWindow.has(e.target).length === 0) {
      modalOverlay.removeClass("overlay--show");
      modalWindow.removeClass("modal--active");
      body.removeClass("overflow");
    }
  })

  function openModal() {
    modalOverlay.addClass("overlay--show");
    modalWindow.addClass("modal--active");
    body.addClass("overflow");
  }

  function closeModal(event) {
    event.preventDefault();
    modalOverlay.removeClass("overlay--show");
    modalWindow.removeClass("modal--active");
    body.removeClass("overflow");
  }

  modalButton.on("click", openModal);
  modalCloseBtn.on("click", closeModal);

  // кнопка прокрутки в начало страницы
  $(function() {
    // scroll to top
    $(".to-top").click(function() {
      $("html, body").animate({ scrollTop: 0 }, 500);
      return false;
    });

    // show to-top button
    $(document).scroll(function() {
      var y = $(this).scrollTop();
      if (y > 900) {
        $(".to-top").addClass("to-top--visible");
      }
        else {
          $(".to-top").removeClass("to-top--visible");
        }
    })
  })

})