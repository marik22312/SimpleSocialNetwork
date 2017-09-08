$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i>');
            }
        }
        init();
    });
});
// chat javascript
$(function(){
$("#addClass").click(function () {
        $('#qnimate').addClass('popup-box-on');
          });

          $("#removeClass").click(function () {
        $('#qnimate').removeClass('popup-box-on');
          });
})
$(document).ready(function(){

	$('.chat_head').click(function(){
		$('.chat_body').slideToggle('nomral');
	});
	$('.msg_head').click(function(){
		$('.msg_wrap').slideToggle('normal');
    $('.msg_input').slideToggle('normal');
	});

	$('.close').click(function(){
		$('.msg_box').hide('fast');
    $('.msg_input').hide('fast');
	});

	$('.user').click(function(){
		$('.msg_wrap').show('fast');
		$('.msg_box').show('fast');
	});

	$('textarea#chat').keypress(
    function(e){
        if (e.keyCode == 13) {
            e.preventDefault();
            var msg = $(this).val();
			$(this).val('');
			if(msg!='')
			$('<div class="msg_b">'+msg+'</div>').insertBefore('.msg_push');
			$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
        }
    });
});
function update()
{
    $.post("server.php", {}, function(data){ $("#screen").val(data);});

    setTimeout('update()', 1000);
}

$(document).ready(

function()
    {
     update();

     $("#button").click(
      function()
      {
       $.post("server.php",
    { message: $("#message").val()},
    function(data){
    $("#screen").val(data);
    $("#message").val("");
    }
    );
      }
     );
    });
$('.dropdown-toggle').dropdown()
/* Registration fomr */
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
