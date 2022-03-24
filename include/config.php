<?php
 $querymember="SELECT * FROM member WHERE `id`= '".$_SESSION['userid']."'";
 $resultmember= $mysqli->query($querymember);
 $datamember=$resultmember->fetch_assoc();
 
?>