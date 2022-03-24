
          <div class="row"> 
                    <section class="col-lg-12">
                     
                         <div class="panel panel-default">   
                        <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Admin </h3> 
                        </div>
                        <div class="panel-body">
<?php
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        // baca ID dari parameter ID  yang akan dihapus
		$id = $_GET['id'];
        // proses hapus data berdasarkan ID
        $sql=$mysqli->query("DELETE FROM tb_admin WHERE `id_admin`= '$id'");
		echo "<script>document.location='?page=tb_admin';</script>";

	 } elseif ($_GET['aksi'] == 'tambah' || $_GET['aksi'] == 'edit') {
		 $id = $_GET['id'];
		if($id==''){$button="Save";}else{$button='Update';}
		 $query="SELECT * FROM tb_admin WHERE `id_admin`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <form action="?page=tb_admin&aksi=prosesSubmit" method="post" class="form-horizontal">
		 <div class="form-body">
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Nama </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $data["nama"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Alamat </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $data["alamat"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">No Hp </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $data["no_hp"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">User Name </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" value="<?php echo $data["user_name"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password </label>
           <div class="col-sm-4">
		    <textarea class="form-control" rows="3" name="password" id="password" placeholder="Password"><?php echo $data["password"]; ?></textarea>
        </div> 
		</div>
	    <div class="form-group">
            <label for="status" class="col-sm-3 control-label">Status </label>
           <div class="col-sm-4">
		   <?php
		  $arrket	= array();
$arrket[] = "admin";
?>
 <select class="form-control" name="status" id="status">
           <option>~~ PILIH ~~</option>
            <?php
			 foreach ($arrket as $nilai) {
            if ($data["status"] == $nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }?>
           </select>
        </div>
		</div>
	   </div>
        			<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
	    <input type="hidden" name="id_admin" value="<?php echo $data["id_admin"]; ?>" /> 
	    <input type="hidden" name="statusTombol" value="<?php echo $button ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> <?php echo $button ?></button> 
	    <a class='btn btn-danger' onclick=self.history.back() ><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
	</div>
				</div>
              </div>
			  </form>
   
   <?php } elseif ($_GET['aksi'] == 'detail') {
	    $id = $_GET['id'];
		 	
		 $query="SELECT * FROM tb_admin WHERE `id_admin`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <table class="table table-bordered table-striped table-condensed flip-content">
	    <tr><td>Nama</td><td><?php echo $data["nama"]; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $data["alamat"]; ?></td></tr>
	    <tr><td>No Hp</td><td><?php echo $data["no_hp"]; ?></td></tr>
	    <tr><td>User Name</td><td><?php echo $data["user_name"]; ?></td></tr>
	    <tr><td>Password</td><td><?php echo $data["password"]; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $data["status"]; ?></td></tr>
	    <tr><td></td><td><a href="?page=tb_admin" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a></td></tr>
	</table>
       
<?php } elseif ($_GET['aksi'] == 'prosesSubmit') {
	   
	  $id_admin = $_POST['id_admin'];
	  $nama = $_POST['nama'];
	  $alamat = $_POST['alamat'];
	  $no_hp = $_POST['no_hp'];
	  $user_name = $_POST['user_name'];
	  $password = $_POST['password'];
	  $status = $_POST['status'];
	switch($_POST['statusTombol']) {
	case 'Save':
			$query=$mysqli->query("INSERT INTO tb_admin (`id_admin`,`nama`,`alamat`,`no_hp`,`user_name`,`password`,`status`) VALUES ('$id_admin','$nama','$alamat','$no_hp','$user_name','$password','$status')");
	break;
	case 'Update':
			$query=$mysqli->query("UPDATE tb_admin set `id_admin` = '$id_admin',`nama` = '$nama',`alamat` = '$alamat',`no_hp` = '$no_hp',`user_name` = '$user_name',`password` = '$password',`status` = '$status' WHERE id_admin='$id_admin'");
	break;
	}
 echo "<script>document.location='?page=tb_admin';</script>";
    }
}else {// end aksi?>
	
							<a href="?page=tb_admin&aksi=tambah" class="btn btn-primary "><i class="fa fa-plus"></i> <span class="hidden-480">
								Tambah Data </span></a> 
<br>
                           
								
							
							<table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		    <th>Nama</th>
		    <th>Alamat</th>
		    <th>No Hp</th>
		    <th>User Name</th>
		    <th>Password</th>
		    <th>Status</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
			 $query="SELECT * FROM tb_admin order by `id_admin` asc ";
		$result= $mysqli->query($query);
		while($tb_admin=$result->fetch_assoc())
		 {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $tb_admin["nama"]; ?></td>
		    <td><?php echo $tb_admin["alamat"]; ?></td>
		    <td><?php echo $tb_admin["no_hp"]; ?></td>
		    <td><?php echo $tb_admin["user_name"]; ?></td>
		    <td><?php echo $tb_admin["password"]; ?></td>
		    <td><?php echo $tb_admin["status"]; ?></td>
		    <td style="text-align:center" width="200px">
<a href="?page=tb_admin&aksi=detail&id=<?php echo $tb_admin["id_admin"];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> 
<a href="?page=tb_admin&aksi=edit&id=<?php echo $tb_admin["id_admin"];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a> 
<a href="?page=tb_admin&aksi=hapus&id=<?php echo $tb_admin["id_admin"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
              
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