  
  <?php
    include('components/header.php');
  ?>
  <main>
  
    <section class="container">
      <div class="row">
      <div class="col-100">  
          <h1>Registrácia</h1>
          <form action="inc/register/insert.php" method="post">
            <input type="text" name="user_name" placeholder="Vaše meno"><br>
            <input type="email" name="user_email" placeholder="Váš email"><br>
            <input type="password" name="user_password" placeholder="Vaše heslo"><br>
            <input type="submit" value="Zaregistrovať sa" name="add_user">
          </form>
          <br>
          <p>Máte účet? <a href="login.php">Prihláste sa</a></p>
        </div>
      </div>
    </section>
  </main>
  <?php
    include('components/footer.php');
  ?>