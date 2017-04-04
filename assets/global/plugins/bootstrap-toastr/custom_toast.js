var NotifikasiToast = function (data) {
    if(!data)
      return;
    var type,msg,title, positionClass;
    if(!data.type){type = 'success';}else{type = data.type;}
    if(!data.msg){msg = '';}else{msg = data.msg;}
    if(!data.title){title = '';}else{title = data.title;}
    if(!data.positionClass){positionClass = 'toast-top-right';}else{positionClass = data.positionClass;}

    toastr.options = {
      closeButton: true,
      debug: false,
      positionClass: positionClass,
      onclick: null,
      showDuration: "1000",
      hideDuration: "1000",
      timeOut: "5000",
      extendedTimeOut: "1000",
      showEasing: "swing",
      hideEasing: "linear",
      showMethod: "fadeIn",
      hideMethod: "fadeOut"
    }
    var $toast = toastr[type](msg, title);
}
