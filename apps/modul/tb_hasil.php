
          <div class="row"> 
                    <section class="col-lg-12">
                     
                         <div class="panel panel-default">   
                        <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Hasil </h3> 
                        </div>
                        <div class="panel-body">
<?php
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        // baca ID dari parameter ID  yang akan dihapus
		$id = $_GET['id'];
        // proses hapus data berdasarkan ID
        $sql=$mysqli->query("DELETE FROM tb_hasil WHERE `id_hasil`= '$id'");
		echo "<script>document.location='?page=tb_hasil';</script>";

	 } elseif ($_GET['aksi'] == 'tambah' || $_GET['aksi'] == 'edit') {
		 $id = $_GET['id'];
		if($id==''){$button="Save";}else{$button='Update';}
		 $query="SELECT * FROM tb_hasil WHERE `id_hasil`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <form action="?page=tb_hasil&aksi=prosesSubmit" method="post" class="form-horizontal">
		 <div class="form-body">
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">email </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $data["email"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Score </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="score" id="score" placeholder="Score" value="<?php echo $data["score"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Level </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $data["level"]; ?>" />
        </div>
		</div>
	   </div>
        			<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
	    <input type="hidden" name="id_hasil" value="<?php echo $data["id_hasil"]; ?>" /> 
	    <input type="hidden" name="statusTombol" value="<?php echo $button ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> <?php echo $button ?></button> 
	    <a class='btn btn-danger' onclick=self.history.back() ><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
	</div>
				</div>
              </div>
			  </form>
   
   <?php } elseif ($_GET['aksi'] == 'detail') {
	    $id = $_GET['id'];
		 	
		 $query="SELECT * FROM tb_hasil WHERE `id_hasil`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <table class="table table-bordered table-striped table-condensed flip-content">
        <tr><td>Pelamar</td><td><?php echo getname("tb_pelamar","email",$data["email"],"nama_pelamar"); ?></td></tr>
	    <tr><td>Score</td><td><?php echo $data["score"]; ?></td></tr>
	    <tr><td>Level</td><td><?php echo $data["level"]; ?></td></tr>
	    <tr><td></td><td><a href="?page=tb_hasil" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a></td></tr>
	</table>
       
<?php } elseif ($_GET['aksi'] == 'prosesSubmit') {
	   
	  $email = $_POST['email'];
	  $id_hasil = $_POST['id_hasil'];
	  $score = $_POST['score'];
	  $level = $_POST['level'];
	switch($_POST['statusTombol']) {
	case 'Save':
			$query=$mysqli->query("INSERT INTO tb_hasil (`email`,`id_hasil`,`score`,`level`) VALUES ('$email','$id_hasil','$score','$level')");
	break;
	case 'Update':
			$query=$mysqli->query("UPDATE tb_hasil set `email` = '$email',`id_hasil` = '$id_hasil',`score` = '$score',`level` = '$level' WHERE id_hasil='$id_hasil'");
	break;
	}
 echo "<script>document.location='?page=tb_hasil';</script>";
    }
}else {// end aksi?>
	
							<!-- <a href="?page=tb_hasil&aksi=tambah" class="btn btn-primary "><i class="fa fa-plus"></i> <span class="hidden-480">
								Tambah Data </span></a>  -->
<br>
                           
								
							
							<table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		    <th>Pelamar</th>
		    <th>Score</th>
		    <th>Soal</th>
		    <th>Tanggal Megerjakan</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
			 $query="SELECT * FROM tb_hasil order by `id_hasil` asc ";
		$result= $mysqli->query($query);
		while($hasil=$result->fetch_assoc())
		 {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		   <td><?php echo getname("tb_pelamar","email",$hasil["email"],"nama_pelamar"); ?></td>
		    <td><?php echo $hasil["score"]; ?></td>
		    <td><?php echo $hasil["level"]; ?></td>
		     <td><?php echo $hasil["tgl_mengerjakan"]; ?></td>
		    <td style="text-align:center" width="200px"><!-- 
<a href="?page=tb_hasil&aksi=detail&id=<?php echo $hasil["id_hasil"];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> 
<a href="?page=tb_hasil&aksi=edit&id=<?php echo $hasil["id_hasil"];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a>  -->
<a href="?page=tb_hasil&aksi=hapus&id=<?php echo $hasil["id_hasil"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
              
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
		

      <?php }?> 
	  </div>
		</div>
      </section>
      </div> 