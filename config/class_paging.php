<?php

class paging
{
    // Fungsi untuk mencek halaman dan posisi data

    public function cariPosisi($batas)
    {
        if (empty($_GET[halaman])) {
            $posisi = 0;

            $_GET[halaman] = 1;
        } else {
            $posisi = ($_GET[halaman] - 1) * $batas;
        }

        return $posisi;
    }

    // Fungsi untuk menghitung total halaman

    public function jumlahHalaman($jmldata, $batas)
    {
        $jmlhalaman = ceil($jmldata / $batas);

        return $jmlhalaman;
    }

    // Fungsi untuk link halaman 1,2,3 ... Next, Prev, First, Last

    public function navHalaman($halaman_aktif, $jmlhalaman)
    {
        $link_halaman = '';

        if (($halaman_aktif - 1) > 0) {
            $previous = $halaman_aktif - 1;

            $link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$previous title=Previous><<</a>&nbsp;";
        }

        // Link halaman 1,2,3, ...

        //for ($i=1; $i<=$jmlhalaman; $i++)
//
        //{
//
        //if ($i == $halaman_aktif)
//
        //{
//
        //$link_halaman .= "<b class='currenthalaman'>$i</b>";
//
        //}
//
        //else
//
        //{
//
        //$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a>";
//
        //}
//
        //$link_halaman .= " ";
//
        //}

        ///

        $angka = ($halaman > 3 ? ' ... ' : ' ');
        for ($i = $halaman - 2; $i < $halaman; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href=$_SERVER[PHP_SELF]?halaman=$i>$i</A> ";
        }

        $angka .= " <b>$halaman</b> ";
        for ($i = $halaman + 1; $i < ($halaman + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</A> ";
        }

        $angka .= ($halaman + 2 < $jmlhalaman ? " ...  
          <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman>$jmlhalaman</A> " : ' ');

        echo "$angka";

        // Link Next dan Last

        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;

            $link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next title=Next>>></a> ";
        }

        return $link_halaman;
    }
}

?>





<?php /*?><?php

class Paging

{

// Fungsi untuk mencek halaman dan posisi data

function cariPosisi($batas)

{

if(empty($_GET[halaman])){

    $posisi=0;

    $_GET[halaman]=1;

}

else{

    $posisi = ($_GET[halaman]-1) * $batas;

}

return $posisi;

}



// Fungsi untuk menghitung total halaman

function jumlahHalaman($jmldata, $batas)

{

$jmlhalaman = ceil($jmldata/$batas);

return $jmlhalaman;

}



// Fungsi untuk link halaman 1,2,3 ... Next, Prev, First, Last

function navHalaman($halaman_aktif, $jmlhalaman)

{

$link_halaman = "";





if (($halaman_aktif-1) > 0)

{

$previous = $halaman_aktif-1;

$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$previous&act=cari_$_GET[module] title=Previous><<</a>&nbsp;";

}



// Link halaman 1,2,3, ...

for ($i=1; $i<=$jmlhalaman; $i++)

{

if ($i == $halaman_aktif)

{

$link_halaman .= "<b class='currenthalaman'>$i</b>";

}

else

{

$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i&act=cari_$_GET[module]>$i</a>";

}

$link_halaman .= " ";

}



// Link Next dan Last

if ($halaman_aktif < $jmlhalaman)

{

$next=$halaman_aktif+1;

$link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next&act=cari_$_GET[module]	 title=Next>>></a> ";

}



return $link_halaman;

}

}

?>

<?php */?>