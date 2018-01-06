<?php 
if($_SERVER ["REQUEST_METHOD"] == "POST"){
$name = trim (filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING));
$email = trim (filter_input(INPUT_POST,"email", FILTER_SANITIZE_STRING));
$comments = trim (filter_input(INPUT_POST,"comments", FILTER_SANITIZE_SPECIAL_CHARS));
  
if($name == "" || $email == "" ||  $comments == "" ){
  $error_message = "Please fill in the required fields: Name,Email and Comments";
   
}
if(!isset($error_message) && $_POST["address"] != ""){
   $error_message = "Bad form input";
   
}
 
  require ("inc/phpmailer/class.phpmailer.php");
  $mail = new PHPMailer;
   
  if(!isset($error_message) &&  !$mail ->ValidateAddress($email)){
    $error_message = "Invalid Email Address";
    
  }
 if (!isset($error_message)){ 


       $email_body = "";
       $email_body .= "Name " . $name . "\n";
       $email_body .= "Email " . $email . "\n";
       $email_body .= "Comments " . $comments . "\n";


      $mail->setFrom($email, $name);
      $mail->addAddress('hadevelopment@hasinaakhter.com', 'Hasina Akhter');     // Add a recipient
      
      $mail->isHTML(false);                                  // Set email format to HTML
      
      $mail->Subject = 'Contact from '. $name;
      $mail->Body    = $email_body;
 
      
      if($mail->send()) {
          header("location:contactform.php?status=thanks");
      }
       $error_message = 'Message could not be sent.';
       $error_message .= 'Mailer Error: ' . $mail->ErrorInfo; 
  
 }  


}

$pageTitle = "CONTACT US";
$section = "Contact";

include("inc/header.php"); ?>

<div class="section page">
     <div class="container">
         <h1>CONTACT US</h1>
		 
       
 <?php if (isset($_GET["status"]) && ($_GET["status"]) == "thanks"){
        
   echo "<p>Thanks for your email. I&rsquo;ll get back to you shortly.</p>";
  
} else {
        if(isset($error_message)){
          echo "<p class='message'>" .$error_message . "</p>";
        } else{
          "<p>Complete the form below:</p>";
     
        
        }
        ?>
       <form method="post" action="contactform.php">
       <table>
       <tr>
         <th><label for="name">Name (required)</label></th>
         <td> <input type="text" id="name" name="name" value="<?php if(isset($name)){echo $name;} ?>"/></td>
       </tr>
       
        <tr>
         <th><label for="email">Email  (required)</label></th>
         <td> <input type="text" id="email" name="email" value="<?php if(isset($email)){echo $email;} ?>"/></td>
       </tr>
         
       <tr>
         <th><label for="comments">Comments</label></th>
           <td> <textarea name="comments" id="comments"><?php if(isset($comments)){ echo htmlspecialchars($_POST["comments"]); } ?></textarea></td>
       </tr>
         <tr style=display:none;>
         <th><label for="address">Address</label></th>
         <td> <input type="text" id="address" name="address"/>
        <p>Please leave this place blank</p></td>
	   </tr>
  
       
   </table>  
       <input type="submit" value="send"/>
         
       </form>
       <?php }?>
     </div>
</div>
</body>
</html>


