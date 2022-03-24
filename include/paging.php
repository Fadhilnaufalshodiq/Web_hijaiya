<?php
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
echo "<div class=paging>";
$jumhal = ceil($jmldata/$dataPerhal);

// menampilkan link previous

if ($nohal > 1) echo  "<span class=prevnext><a href='".$link."&hal=".($nohal-1)."'>&lt;&lt; Prev</a></span>";

// memunculkan nomor halaman dan linknya

for($hal = 1; $hal <= $jumhal; $hal++)
{
         if ((($hal >= $nohal - 3) && ($hal <= $nohal + 3)) || ($hal == 1) || ($hal == $jumhal))
         {
            if (($showhal == 1) && ($hal != 2))  echo "...";
            if (($showhal != ($jumhal - 1)) && ($hal == $jumhal))  echo "...";
            if ($hal == $nohal) echo " <span class=current>".$hal."</span> ";
            else echo " <a href='".$link."&hal=".$hal."'>".$hal."</a> ";
            $showhal = $hal;
         }
}

// menampilkan link next

if ($nohal < $jumhal) echo "<span class=prevnext><a href='".$link."&hal=".($nohal+1)."'>Next &gt;&gt;</a></span>";
echo "</div>";

?>