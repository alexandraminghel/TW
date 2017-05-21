<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once ('connection.php');
require_once ('userobject.php');
require_once ('functions.php');

$email = $_SESSION['email'];
$user = new User($email, $conn);
$nr_programari = getTotalProgs($user->id, $conn);
$ultima_viz = getLastVisit($user->id, $conn);

echo "<div class = \"nav1\">
      <div class = \"userimg\">
        <img src=\"admin.png\" class=\"imagine\">
      </div>
      <a href = \"newvisit.php\" class = \"linknume\"><div id = \"nume\">".$user->nume."</div></a>
      <div class = \"infotable\">
        <table class = \"info\">
          <tr>
            <td>Numar vizite programate</td>
            <td id = \"datalog\">".$nr_programari."</td>
          </tr>
          <tr id = \"ultimul\">
            <td>Ultima vizita </td>
            <td id = \"dataviz\">".$ultima_viz."</td>
          </tr>
        </table>
      </div>
    </div>";
?>
