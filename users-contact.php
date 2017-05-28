<?php
require_once('checksession.php');
require_once('checkuser.php');
require_once('infouser.php');
require_once('cvisit.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Informatii de contact</title>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="users-contact-style.css">
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
		    <div class = "nav1">
			    <div class = "userimg">
				    <img src=<?php echo "\"".$poza."\"";?>  class="imagine">
			    </div>
			    <a href = "newvisit.html" class = "linknume"><div id = "nume"><?php echo $user->nume; ?></div></a>
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
			<section> 
		        <div class="contents">
		            <div id="content-header">
				        <p>CONTACT</p>
				    </div>
				    <div class = "content-all">
				    	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1355.9172422953534!2d27.557568039097504!3d47.18067712943371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafca7f32bd7c9%3A0xc63c3edf7a29e86!2sPenitenciarul+Iasi%2C+Str.+Fagului%2C+Ia%C8%99i+707410!5e0!3m2!1sen!2sro!4v1495915055549" class = "map" width="600" height="350" frameborder="0"></iframe>
				    	<ul class="coloane-date">
					    	 <li class="col-contact">
					        	<dl>
		                        	<dt id="t1">ADDRESS:</dt>
		                        	<dd>
		                        		<address>Str. Dr. Vicol, 10 <br> IAŞI 707410, ROMANIA</address>
		                        	</dd>
				            	</dl>
					    	</li>
			            	<li id="date-con" class="col-contact">
					        	<dl>
						        	<dt id="t1">CONTACT US</dt>
						        	<dt>E-Mail:</dt>
		                        	<dd><u>piasi@anp.gov.ro</u></dd>
						        	<dt>Phone:</dt>
		                        	<dd>+40 232 216700</dd>
						        	<dt>Fax:</dt>
						        	<dd>+40 332 425865</dd>
						    	</dl>
					    	</li>
				    	</ul>
				    </div>
			    </div>
		    </section>
		</main>
	</div>	
</body>
</html>
