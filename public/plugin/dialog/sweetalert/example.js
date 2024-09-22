 jQuery(function() {
        swal("Hello world!");
 });


 swal("Here's the title!", "...and here's the text!");

 swal("Good job!", "You clicked the button!", "success"); //success, warning, error, info

//Confirm Box Example

 swal({
     title: "Are you sure?",
     text: "Once deleted, you will not be able to recover this record!",
     icon: "warning",
     buttons: true,
     dangerMode: true,
 })
 .then((willDelete) => {
     if (willDelete) {
         swal("Poof! Your record has been deleted!", {
             icon: "success",
         });
     } else {
         swal("Your imaginary file is safe!");
     }
 });

/*
    Sometimes, we need to send AJAX request with the confirm dialog box. In that case, we process to AJAX request after clicking the confirm button.
*/
 swal({
     title: "Are you sure?",
     text: "Once deleted, you will not be able to recover this record!",
     icon: "warning",
     buttons: true,
     dangerMode: true,
 })
 .then((willDelete) => {
     if (willDelete) {
         $.get('ajax.php', function (response) {
             if (response == true) {
                 swal("Poof! Your record has been deleted!", {
                     icon: "success",
                 });
             }
         });
     } else {
         swal("Your imaginary file is safe!");
     }
 });


/*
Prompt Box Example

A prompt dialog box is very rarely used on the website. However, if someone wishes to show it by SwetAlert then below is the code for the prompt box.
*/
 swal("Write something here:", {
     content: "input",
 })
 .then((value) => {
     swal(`You typed: ${value}`);
 });