$('#send-money-form').submit(function (e){
   e.preventDefault();

   var data = $('#send-money-form').serialize();

   //loading
   $("#send-money").html("<div class='spinner-grow text-info align-self-center loader-sm'>Loading...</div>")
   $("#send-money").prop('disabled', true);

   function resetButton() {
      $('#send-money').html("Send");
      $('#send-money').prop('disabled', false);
   }

   if ($('#amount').val() == "") {
      Snackbar.show({
         text: "Please enter an amount",
         actionTextColor: "#fff",
         backgroundColor: "#e7515a",
      });
      return resetButton();
   }
    else if ($('#acc_num').val() == "") {
      Snackbar.show({
         text: "Please enter an account to send to",
         actionTextColor: "#fff",
         backgroundColor: "#e7515a",
      });
      return resetButton();
   } else {
       $.ajax({
           type: 'post',
           url: 'assets/ajax/send-money-process.php',
           dataType: 'json',
           data: data,
           success: function (e){
               if (e.success) {
                   Snackbar.show({
                       text: "Success!",
                       actionTextColor: "#fff",
                       backgroundColor: "#e7515a",
                   });
                   //reset fields
                   $('#amount').val("");
                   $('#acc_num').val("");
                   return resetButton();
               } else {
                   Snackbar.show({
                       text: e.msg,
                       actionTextColor: '#fff',
                       backgroundColor: "#e7515a"
                   });
                   return resetButton();
               }
           },
           error: function (e){
               console.log(e)
               Snackbar.show({
                   text: "Something went wrong.",
                   actionTextColor: '#fff',
                   backgroundColor: "#e7515a"
               });
               return resetButton();
           }
       });
   }
});
