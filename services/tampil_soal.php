
<?php
//header('Content-Type: application/pdf');
error_reporting(0);
?>  
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">



    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

       <link rel="stylesheet" type="text/css" href="sweetalert-master/src/sweetalert.css">
<script type="text/javascript" src="sweetalert-master/src/sweetalert.js"></script>
  </head>

  <body>

            <?php
           include "../include/koneksi.php";
            include "notice.php";
            ?>
                            
 <table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
              <thead class="flip-content">
                <tr>
        <th width="20px">No</th>
        <th>Soal</th>
        <th>A</th>
        <th>B</th>
        <th>C</th>
        <th>D</th>
        <th>Jawaban</th>
       </tr>
            </thead>
      <tbody>
            <?php
            $start = 0;
       $query="SELECT * FROM soal order by `id` asc ";
    $result= $mysqli->query($query);
    while($soal=$result->fetch_assoc())
     {
                ?>
                <tr>
        <td><?php echo ++$start ?></td>
        <td><?php echo $soal["soal"]; ?></td>
        <td><?php echo $soal["a"]; ?></td>
        <td><?php echo $soal["b"]; ?></td>
        <td><?php echo $soal["c"]; ?></td>
        <td><?php echo $soal["d"]; ?></td>
        <td><?php echo $soal["jwaban"]; ?></td>
        
        
          </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    

     
 </body>
</html>
<script src="js/jquery.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
 
