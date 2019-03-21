function validate_user_info() {

  var email_match = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
// 
  $(".err_msg").html("");
  $(".err_msg").hide();

  if ($.trim($("#username").val()) == "") {
    $("#err_msg_username").show();
    $("#err_msg_username").html("Enter User Name.");
    $("#username").focus();
    return false;
  }

  if ($.trim($("#email").val()) == "") {
    $("#err_msg_email").show();
    $("#err_msg_email").html("Enter Email.");
    $("#email").focus();
    return false;
  }

  if(!$.trim($("#email").val()).match(email_match)){
    $("#err_msg_email").show();
    $("#err_msg_email").html('Invalid Email Id.');
    $("#email").focus();
    return false;
  }

  if ($.trim($("#password").val()) == "") {
    $("#err_msg_password").show();
    $("#err_msg_password").html("Enter Password.");
    $("#password").focus();
    return false;
  }

  //$('input:submit').attr("disabled", true);
  $('#submit').hide();
  $(".succes_msg").html("Please Wait...");
  return true;
}


// Delete dealer

function delete_dealer_info(val) {
  var action = "delete_dealer_info";
  if (confirm("Are you sure want to delete this record")) {
    $.ajax({
      url: "ajax_function.php",
      type: "POST",
      data: { id: val, action: action },
      success: function(result) {
        $("#row_" + val + "").remove();
        alert(result);
      }
    });
  } else {
    return false;
  }
}