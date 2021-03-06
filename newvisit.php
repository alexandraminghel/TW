<?php
require_once('checksession.php');
require_once('checkuser.php');
require_once('infouser.php');
require_once('cvisit.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Programare vizita</title>
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="scheletvisit.css">
</head>
<body>
  <div class = "userheader">

    <div class = "usernav">
      <ul>
        <li><a href="newvisit.php">Acasa</a></li>
        <li><a href="users-contact.php">Contact</a></li>
        <li><a href="arhivausers.php">Arhiva vizite</a></li>
        <li><a href="arhivaprogusers.php">Arhiva programari</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
  <div class = "wrap">
    <main>
      <div class = "wrapmain">
        <p><?php echo $message; ?></p>
        <h2>Programare vizita</h2>
          <form action="newvisit.php" method="post">
            <ul class="flex">
                <li>
                    <label for="lastname">ID detinut</label>
                    <input type="text" id="id" name="id" placeholder="ID-ul detinutului">
                </li>
                <li>
                    <label for="lastname">Nume detinut</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Numele de familie" required="">
                </li>
                <li>
                  <label for="firstname">Prenume detinut</label>
                  <input type="text" id="firstname" name="firstname" placeholder="Prenumele" required="">
                </li>
                <li>
                  <label for="date">Data vizitei</label>
                  <input type="text" name="date" name="date" placeholder="Data (aaa-ll-zz)" required="">
                </li>
                <li>
                  <label for="reasonforvisit">Natura vizitei</label>
                  <textarea rows="3" id="reasonforvisit" name="reasonforvisit" placeholder="Natura vizitei" required=""></textarea>
              </li>
                <li>
                  <label for="talksummary">Rezumatul discutiei</label>
                <textarea rows="3" id="talksummary" name="talksummary" placeholder="Rezumatul discutiei"></textarea>
              </li>
              <li>
                  <label for="objects">Obiecte aduse detinutului </label>
                <textarea rows="6" id="objects" name="objects" placeholder="Obiecte aduse detinutului (maxim 3,separate prin virgula)"></textarea>
              </li>
              <li>
                  <label for="related">Relatia cu detinutul</label>
                <input id="related" name="related" placeholder="Relatia cu detinutul" required=""></input>
              </li>
                <li>
                  <button type="submit" name = "submitbutton">Adauga programare</button>
                </li>
            </ul>
          </form>
        </div>
    </main>
    <div class = "nav1">
      <div class = "userimg">
        <img src=<?php echo "\"".$poza."\"";?> class="imagine">
      </div>
      <a href = "newvisit.php" class = "linknume"><div id = "nume"><?php echo $user->nume; ?></div></a>
      <div class = "infotable">
        <table class = "info">
          <tr>
            <td>Numar vizite programate</td>
            <td id = "datalog"><?php echo $nr_programari; ?></td>
          </tr>
          <tr id = "ultimul">
            <td>Ultima vizita </td>
            <td id = "dataviz"><?php echo $ultima_viz; ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>  
</body>
</html>