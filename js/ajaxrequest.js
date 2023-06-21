//  $(document).ready(function() {
// //is email already exist
// $("#stuemail").on("Keypress blur", function() {
// var reg =/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
// var stuemail = $("#stuemial").val();
// $.ajax({
//     url:"student/addStudent.php",
//     method: "POST",
//     data: {
//         checkemail: "checkemail",
//         stuemail: stuemail,
//     },
//     success: function (data) {
//     //   console.log(data);
//         if(data != 0){
//             $("#statusMsg2").html('<small style="color:red;"> Emial ID Alread Used !</small>');
//             $("#signup").attr("disabled",true);
//         }else if(data == 0 && reg.test(stuemail)){
//             $("#statusMsg2").html('<small style="color:red;"> There are You Go  !</small>');
//             $("#signup").attr("disabled",false);
//         } else if(!reg.test(stuemail)){
//             $("#statusMsg2").html('<small style="color:red;">Please Enter Valid Emial e.g. example@mail.com !</small>');
//             $("#signup").attr("disabled",false);
//         }
//         if(stuemail == ""){
//             $("#statusMsg2").html('<small style="color:red;"> Please Enter Email  !</small>');
//         }
//     },  
// });
// });
//  });
 
 
//  function addStu() {
//     var reg =/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
//     var stuname = $("#stuname").val();
//     var stuemail = $("#stuemail").val();
//     var stupass = $("#stupass").val();
  

//     //form vaildation
//     if(stuname.trim() == " "){
//      $("#statusMsg1").html('<small style="color:red;"> Please Enter Name !</small>');
//      $("#stuname").focus();
//      return false;
//     } 

//     else if (stuemail.trim() == " "){
//         $("#statusMsg2").html('<small style="color:red;"> Please Enter Emial !</small>'
//         );
//         $("#stuemail").focus();
//         return false;
//         } 
//         else if(stuemail.trim() != "" && !reg.test(stuemail)){
//             $("#statusMsg2").html('<small style="color:red;"> Please Enter Valid Emial e.g. example@mail.com !</small>'
//             );
//             $("#stuemail").focus();
//             return false;

//         }

//         else if (stupass.trim() == " "){
//             $("#statusMsg3").html('<small style="color:red;"> Please Enter password !</small>'
//             );
//             $("#stupass").focus();
//             return false;
//             } 
            
//             else{
//                 $.ajax({
//                     url:"student/addStudent.php",
//                     method: "POST",
//                     dataType:"json",
//                     data: {
//                         stusignup: "stusignup",
//                         stuname: stuname,
//                         stuemail: stuemail,
//                         stupass: stupass,
//                     },
//                     success: function (data) {
//                         console.log(data);
//                         if (data == "OK"){
//                             $("#successMsg").html("<span class='alert alert-success'>Registration Successful !</span>");
//                             clearStuRegField();
//                         }
//                         else if (data == "Failed"){
//                             $("#successMsg").html("<span class='alert alert-danger'> Unable to Register !</span>");
//                         }
//                     },
//                 });
//             }

//  } 

//  //Empty All filled
//   function clearStuRegField(){
//         $("#stuRegForm").trigger("reset");
//         $("#statusMsg1").html(" ");
//         $("#statusMsg2").html(" ");
//         $("#statusMsg3").html(" ");
//   }

$(document).ready(function () {
    // Check if email already exists
    $("#stuemail").on("keypress blur", function () {
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var stuemail = $("#stuemail").val();
        $.ajax({
            url: "student/addStudent.php",
            method: "POST",
            data: {
                checkemail: "checkemail",
                stuemail: stuemail,
            },
            success: function (data) {
                if (data != 0) {
                    showError("#stuemail", "Email ID already used!");
                    $("#signup").attr("disabled", true);
                } else if (data == 0 && reg.test(stuemail)) {
                    removeError("#stuemail");
                    $("#signup").attr("disabled", false);
                } else if (!reg.test(stuemail)) {
                    showError("#stuemail", "Please enter a valid email, e.g., example@mail.com!");
                }
                if (stuemail == "") {
                    removeError("#stuemail");
                }
            },
        });
    });

    function showError(field, message) {
        $(field).addClass("is-invalid");
        $(field).next("small").addClass("text-danger").text(message);
    }

    function removeError(field) {
        $(field).removeClass("is-invalid");
        $(field).next("small").removeClass("text-danger").text("");
    }
});




  // Ajax Call for Student Login verification
// function checkStuLogin() {
//     var stuLogEmail = $("#stuLogemail").val();
//     var stuLogPass = $("#stuLogpass").val();

//     $.ajax({
//     url: "student/addStudent.php",
//     method: "POST",
//     data: {
//         checkLogemail: "checklogmail",
//         stuLogEmail: stuLogEmail,
//         stuLogPass: stuLogPass,
//     },
//     success: function (data) {
//         // console.log(data);
//         if (data == 0){
//             $("#statusLogMsg").html('<small class="alert alert-danger">Invalid Email ID or Password !</small>');
//         }else if (data == 1) {
//             $("#statusLogMsg").html('<div class="spinner-border text-success" role="status"></div>');
            
//             setTimeout(()=>{
//                 window.location.href = "index.php";},1000);
            
//     }
// },
//     });
// }


