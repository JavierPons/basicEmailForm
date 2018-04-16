<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">

    <title>Hello, world!</title>
  </head>
  <body>

<?php
    if(isset($_POST['email'])) {

        $email_to = "javier.pons@solidomedia.com";
        $email_subject = "Este es email de pagina interfaz";

        function died($error) {
            echo "We find error in your submission";
            echo "This error appear below.<br /> <br />";
            echo $error."<br /><br />";
            echo "Please go back and fix the errors.<br /><br />";
            die();
        }

        if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name'])   ||
        !isset($_POST['email'])     ||
        !isset($_POST['telephone'])   ||
        !isset($_POST['comments']))  {
            died('Problem with form you submitted')
        }

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email_form = $_POST['email'];
        $telephone = $_POST['telephone'];
        $comments = $_POST['commments'];

        $error_message = "";
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

        if(!preg_match($email_exp, $email_form)) {
            $error_message .= 'Email no valid'; 
        }
            $string_exp = "/^[A-Za-z .'-]+$/";

        if(!preg_match($string_exp, $first_name)) {

            $error_message .= 'First name no valid';
        }

        if(!preg_match($string_exp, $last_name)) {

            $error_message .= 'Last name no valid';
        }

        if(strlen($comments) < 2 ) {
            $error_message .= 'Comment no valid';
        }

        if(strlen($error_message) > 0) {
            died($error_message);
        }

        $email_message = "Form details below.\n\n";

        function clean_string($string) {
            $bad =  array("content-type", "bbc:", "to:","cc:","href");
            return str_replace($bad,"",$string);
        }

        $email_message .= "First Name: ".clean_string($first_name)."\n";

        $email_message .= "Last Name: ".clean_string($last_name)."\n";

        $email_message .= "Email: ".clean_string($email_form)."\n";

        $email_message .= "Telephone: ".clean_string($telephone)."\n";

        $email_message .= "Comments: ".clean_string($comments)."\n";


$headers = 'Form: '.$email_form."\r\n".
'Replay-To: '.$email_form."\r\n" .
'X-Mailer: PHP/' .phpversion();
@mail($email_to, $email_subject, $email_message, $headers);



    }

?>

    <div class="container">
        <form name="contactform" method="post" action="send_form_email.php">
            <table width="450px">
            <tr>
             <td valign="top">
              <label for="first_name">First Name *</label>
             </td>
             <td valign="top">
              <input  type="text" name="first_name" maxlength="50" size="30">
             </td>
            </tr>
            <tr>
             <td valign="top">
              <label for="last_name">Last Name *</label>
             </td>
             <td valign="top">
              <input  type="text" name="last_name" maxlength="50" size="30">
             </td>
            </tr>
            <tr>
             <td valign="top">
              <label for="email">Email Address *</label>
             </td>
             <td valign="top">
              <input  type="text" name="email" maxlength="80" size="30">
             </td>
            </tr>
            <tr>
             <td valign="top">
              <label for="telephone">Telephone Number</label>
             </td>
             <td valign="top">
              <input  type="text" name="telephone" maxlength="30" size="30">
             </td>
            </tr>
            <tr>
             <td valign="top">
              <label for="comments">Comments *</label>
             </td>
             <td valign="top">
              <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
             </td>
            </tr>
            <tr>
             <td colspan="2" style="text-align:center">
              <input type="submit" value="Submit">   <a href="http://www.freecontactform.com/email_form.php">Email Form</a>
             </td>
            </tr>
            </table>
            </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>