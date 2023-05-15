
<form id="contact" action="inc/contact/int.php" method="post">
  <input type="text" placeholder="Vaše meno" id ="contact_name" name = "contact_name" required><br>
  <input type="email" placeholder="Váš email" id="contact_email" name ="contact_email" required><br>
  <textarea placeholder="Vaša správa" id="contact_message" name="contact_message" ></textarea><br>
  <input type="checkbox" required><label for=""> Súhlasím so spracovaním osobných údajov.</label><br>
  <input type="submit" value="Odoslať" name="contact_us">
</form>
<div id="error" class="text-red">