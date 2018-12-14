<?php

    error_reporting(0);session_start();

    include '../../config/koneksi.php';

    $prd = $_GET['prd'];

    $notrans = $_GET['notrans'];

    $kode = $_GET['kode'];

    $q = '%'.trim($_REQUEST['term']).'%';

        $sql = "select   concat(a.kode,' - ',a.barang) as barang

                ,   a.id_barang

                ,   a.id_jenis_barang as jenis_barang

                ,   a.id_unit_barang as unit_barang

                ,   m.id_merk

            from barang a inner join jenis_barang b

            on a.id_jenis_barang = b.id_jenis_barang

            inner join unit_barang c

            on a.id_unit_barang = c.id_unit_barang

            left join merk m

            on a.id_merk = m.id_merk

            WHERE a.barang like '$q'

            and a.id_barang not in 

                (select id_barang from permintaan_barang_detail where prd = '$prd' and notrans = '$notrans' and kode = '$kode' and status !='4')

            ORDER BY a.barang asc

            limit 0,10

            ";

        $tampil = mysql_query($sql);

        $data = [];

        while ($r = mysql_fetch_array($tampil)) {
            $data[] = [

                    'value' => $r['barang'],

                    'id_barang' => $r['id_barang'],

                    'merk' => $r['id_merk'],

                    'jenis_barang' => $r['jenis_barang'],

                    'unit_barang' => $r['unit_barang'],

                ];
        }

    echo json_encode($data);

    flush();
