$(function () {
  $('.activeProgramm').click(function(){
    var id = this.id;
    if ($(this).is(':checked')){
      var url = '/adm/programms/ajax/?activate=1&id=' + id;
      $.ajax({
        url: url,
        success: function (data) {
          location.reload();
        }
      });
    } else {
      var url = '/adm/programms/ajax/?activate=0&id=' + id;
      $.ajax({
        url: url,
        success: function (data) {
          location.reload();
        }
      });
    }
  });

  $('.compliteBtn').click(function() {
    var id = this.id;
    var url = '/adm/programms/ajax/?complite=1&id=' + id;
    $.ajax({
      url: url,
      success: function (data) {
	location.reload();
      }
    });
  });

  $('.deleteChildren').click(function() {
    var id = this.id;
    var url = '/adm/programms/ajax/?delete=1&id=' + id;
    $.ajax({
      url: url,
      success: function (data) {
        location.reload();
      }
    });
  });

  $('.activeFAQ').click(function(){
    var id = this.id;
    if ($(this).is(':checked')){
      var url = '/adm/question/updateFAQ/?showFAQ=1&id=' + id;
      $.ajax({
        url: url,
        success: function (data) {
          location.reload();
        }
      });
    } else {
      var url = '/adm/question/updateFAQ/?showFAQ=0&id=' + id;
      $.ajax({
        url: url,
        success: function (data) {
          location.reload();
        }
      });
    }
  });
});
