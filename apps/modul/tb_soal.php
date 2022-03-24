
          <div class="row"> 
                    <section class="col-lg-12">
                     
                         <div class="panel panel-default">   
                        <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Soal </h3> 
                        </div>
                        <div class="panel-body">
<?php
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        // baca ID dari parameter ID  yang akan dihapus
		$id = $_GET['id'];
        // proses hapus data berdasarkan ID
        $sql=$mysqli->query("DELETE FROM tb_soal WHERE `id`= '$id'");
		echo "<script>document.location='?page=tb_soal';</script>";

	 } elseif ($_GET['aksi'] == 'tambah' || $_GET['aksi'] == 'edit') {
		 $id = $_GET['id'];
		if($id==''){$button="Save";}else{$button='Update';}
		 $query="SELECT * FROM tb_soal WHERE `id`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <form action="?page=tb_soal&aksi=prosesSubmit" method="post" class="form-horizontal" enctype="multipart/form-data">
		 <div class="form-body">
	    <div class="form-group">
            <label for="soal" class="col-sm-3 control-label">Soal </label>
           <div class="col-sm-8">
		    <textarea class="form-control" rows="3" name="soal" id="soal" placeholder="Soal"><?php echo $data["soal"]; ?></textarea>
        </div>
		</div>
	    <div class="form-group">
            <label for="a" class="col-sm-3 control-label">A </label>
           <div class="col-sm-8">
		    <textarea class="form-control" rows="3" name="a" id="a" placeholder="A"><?php echo $data["a"]; ?></textarea>
        </div>
		</div>
	    <div class="form-group">
            <label for="b" class="col-sm-3 control-label">B </label>
           <div class="col-sm-8">
		    <textarea class="form-control" rows="3" name="b" id="b" placeholder="B"><?php echo $data["b"]; ?></textarea>
        </div>
		</div>
	    <div class="form-group">
            <label for="c" class="col-sm-3 control-label">C </label>
           <div class="col-sm-8">
		    <textarea class="form-control" rows="3" name="c" id="c" placeholder="C"><?php echo $data["c"]; ?></textarea>
        </div>
		</div>
	    <!-- <div class="form-group">
            <label for="d" class="col-sm-3 control-label">D </label>
           <div class="col-sm-8">
		    <textarea class="form-control" rows="3" name="d" id="d" placeholder="D"><?php echo $data["d"]; ?></textarea>
        </div>
		</div> -->
	    <div class="form-group">
            <label for="int" class="col-sm-3 control-label">Jwaban </label>
          <div class="col-sm-8"> 
		   <input type="text" class="form-control" name="jwaban" id="jwaban" placeholder="Jwaban" value="<?php echo $data["jwaban"]; ?>" />
        </div>
		</div>
	   
	   </div>
        			<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
	    <input type="hidden" name="id" value="<?php echo $data["id"]; ?>" /> 
	    <input type="hidden" name="statusTombol" value="<?php echo $button ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> <?php echo $button ?></button> 
	    <a class='btn btn-danger' onclick=self.history.back() ><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
	</div>
				</div>
              </div>
			  </form>
   
   <?php } elseif ($_GET['aksi'] == 'detail') {
	    $id = $_GET['id'];
		 	
		 $query="SELECT * FROM tb_soal WHERE `id`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <table class="table table-bordered table-striped table-condensed flip-content">
	    <tr><td width="49">Soal</td><td width="51"><?php echo $data["soal"]; ?></td>
	      <td width="166" rowspan="6" align="center" valign="middle"></td>
	    </tr>
	    <tr><td>A</td><td><?php echo $data["a"]; ?></td>
	      </tr>
	    <tr><td>B</td><td><?php echo $data["b"]; ?></td>
	      </tr>
	    <tr><td>C</td><td><?php echo $data["c"]; ?></td>
	      </tr>
	   
	    <tr><td>Jawaban</td><td><?php echo $data["jwaban"]; ?></td>
	      </tr>
	    
	    <tr><td></td><td><a href="?page=tb_soal" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a></td>
	      <td>&nbsp;</td>
	    </tr>
	</table>
       
<?php } elseif ($_GET['aksi'] == 'prosesSubmit') {
	   
	  $id = $_POST['id'];
	  $soal = $_POST['soal'];
	  $a = $_POST['a'];
	  $b = $_POST['b'];
	  $c = $_POST['c'];
	  $jwaban = $_POST['jwaban'];
	switch($_POST['statusTombol']) {
	case 'Save':
			$query=$mysqli->query("INSERT INTO tb_soal (`id`,`soal`,`a`,`b`,`c`,`jwaban`) VALUES ('$id','$soal','$a','$b','$c','$jwaban')");
	break;
	case 'Update':
			$query=$mysqli->query("UPDATE tb_soal set `id` = '$id',`soal` = '$soal',`a` = '$a',`b` = '$b',`c` = '$c',`jwaban` = '$jwaban' WHERE id='$id'");
	break;
	}
 echo "<script>document.location='?page=tb_soal';</script>";
    }
}else {// end aksi?>
	
							<a href="?page=tb_soal&aksi=tambah" class="btn btn-primary "><i class="fa fa-plus"></i> <span class="hidden-480">
								Tambah Data </span></a> 
<br>
                           
								
							
							<table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		    <th>Soal</th>
		    <th>A</th>
		    <th>B</th>
		    <th>C</th>
		    <th>Jwaban</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
			 $query="SELECT * FROM tb_soal order by `id` asc ";
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
		    <td><?php echo $soal["jwaban"]; ?></td>
		   
		    <td style="text-align:center" width="200px">
<a href="?page=tb_soal&aksi=detail&id=<?php echo $soal["id"];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> 
<a href="?page=tb_soal&aksi=edit&id=<?php echo $soal["id"];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a> 
<a href="?page=tb_soal&aksi=hapus&id=<?php echo $soal["id"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
              
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