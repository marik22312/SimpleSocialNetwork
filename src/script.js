// tooltip
  $('[data-toggle="tooltip"]').tooltip({
    'trigger':'hover',
    });

// form validation
  //passwordC
  function matchPass() {
    if ($('input#signupPassword').val() != $('input#signupPasswordagain').val()) {
      $('div[name="passwordCheck"]').addClass('has-error');
      $('#reg_passHelp').css('display', 'block');

    }else {
      $('div[name="passwordCheck"]').removeClass('has-error');
      $('div[name="passwordCheck"]').addClass('has-success');
      $('#reg_passHelp').css('display', 'none');

    }
  }

  function validatePass(){
    if ($('input[name="reg_pass"]').val().length < 6){
      $('div[name="passwordCheck"]').addClass('has-error');
    }else {
    }
  }

//friend request
