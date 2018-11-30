<?php

	function tgl_indo($tgl){

			$tanggal = substr($tgl,8,2);

			$bulan = getBulan(substr($tgl,5,2));

			$tahun = substr($tgl,0,4);

			return $tanggal.'/'.$bulan.'/'.$tahun;		 

	}	



	function getBulan($bln){

				switch ($bln){

					case 1: 

						return "01";

						break;

					case 2:

						return "02";

						break;

					case 3:

						return "03";

						break;

					case 4:

						return "04";

						break;

					case 5:

						return "05";

						break;

					case 6:

						return "06";

						break;

					case 7:

						return "07";

						break;

					case 8:

						return "08";

						break;

					case 9:

						return "09";

						break;

					case 10:

						return "10";

						break;

					case 11:

						return "11";

						break;

					case 12:

						return "12";

						break;

				}

			} 

			

			function tgl_indo1($tgl1){

			$tanggal1 = substr($tgl1,8,2);

			$bulan1 = getBulan1(substr($tgl1,5,2));

			$tahun1 = substr($tgl1,0,4);

			return $tanggal1.' '.$bulan1.' '.$tahun1;		 

	}	



	function getBulan1($bln1){

				switch ($bln1){

					case 1: 

						return "Januari";

						break;

					case 2:

						return "Februari";

						break;

					case 3:

						return "Maret";

						break;

					case 4:

						return "April";

						break;

					case 5:

						return "Mei";

						break;

					case 6:

						return "Juni";

						break;

					case 7:

						return "Juli";

						break;

					case 8:

						return "Agustus";

						break;

					case 9:

						return "September";

						break;

					case 10:

						return "Oktober";

						break;

					case 11:

						return "November";

						break;

					case 12:

						return "Desember";

						break;

				}

			} 

?>

