    <?php
switch ($_GET[act]) {

        default:
          ?>

 <div class="">
                   
                <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><?php echo $nmmodule; ?></h2>
                                      <p class="pull-right"><a href='<?php echo"modul/mod_$module/form_$module.php?width=720&height=560&module=$module&id_module=$id_module&TB_iframe=true"; ?>' title='New <?php echo $nmmodule; ?>' class='thickbox btn btn-sm btn-success'><i class="fa fa-plus"></i> New</a></p>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                   <div id="tablewrapper">

                    <div id="tableheader">

                        <div class="search">  <select id="columns" onchange="sorter.search('query')"></select>
                            <input type="text" id="query" onkeyup="sorter.search('query');" value="Search By ...."  onclick="this.value=''"/>
                        </div>
                        <span class="details">
                           <div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
                            <!--<div><a href="javascript:sorter.reset()">reset</a></div>-->
                        </span>
                    </div> <div>
                        <table cellpadding="0" cellspacing="0" border="0" id="table" class="table table-striped responsive-utilities jambo_table" >
                        <thead>
                            <tr>                               
                                <th><h3 style='font-size:12px;'>Tanggal</h3></th>
                                <th><h3 style='font-size:12px;'>Poliklinik</h3></th>
                                <th><h3 style='font-size:12px;'>No. Antrian</h3></th>
                                <th><h3 style='font-size:12px;'>Nama Pasien</h3></th>
                                <th><h3 style='font-size:12px;'>No. KTP</h3></th>
                                <th><h3 style='font-size:12px;'>Tanggal Lahir</h3></th>
                                <th><h3 style='font-size:12px;'>Kategori</h3></th>                                
                                <th class='nosort' width="100px" style='text-align:center;'>
                                    <h3 style='font-size:12px;'>Aksi</h3>
                                </th>                              
                            </tr>
                        </thead>
                        <tbody>
                            
                         <?php

                    $tampil = mysql_query('SELECT a.*,b.nama,b.tgl_lahir,b.ktp,c.poli,d.kategori 
                                FROM kunjungan_berobat a left join pasien b 
                                 ON a.id_pasien = b.id_pasien
                                 left join poli c 
                                 ON a.id_poli = c.id_poli
                                 left join kategori d
                                 ON b.id_kategori = d.id_kategori
                                 ORDER BY a.tanggal,a.id_poli,a.no_urut ASC');

            $no = 1;

            while ($r = mysql_fetch_array($tampil)) {
                $tgl = date('d/m/Y', strtotime($r[tanggal]));
                $tgl_lahir = date('d/m/Y', strtotime($r[tgl_lahir]));
                $status = $r[status];

                echo'<tr>';
                echo"<td>$tgl</td>";
                echo"<td>$r[poli]</td>";
                echo"<td>$r[no_urut]</td>";
                echo"<td>$r[nama]</td>";
                echo"<td>$r[ktp]</td>";
                echo"<td>$tgl_lahir</td>";
                echo"<td>$r[kategori]</td>";
                echo" <td  style='text-align:center;'>";

                if ($r_edit == 'Y') {
                    //if ($status == '0') {
                    echo"<a class='thickbox' href='modul/mod_$module/form_$module.php?id_kunjungan_berobat=$r[id_kunjungan_berobat]&id_module=$id&width=720&height=560&module=$module&TB_iframe=true' title='Update $nmmodule'><span class='icon'><i class='fa fa-pencil'></i></span></a>";
                    // } else {
                //  echo"<span class='icon'><i class='fa fa-pencil'></i></span>";
                // }
                }

                if ($r_delete == 'Y') {
                    //if ($status == '0') {
                    echo"<a href='modul/mod_$module/aksi_$module.php?module=$module&act=hapus&id=$r[id_kunjungan_berobat]&id_module=$id' onClick=\"return confirm('Delete this record ?')\" title='Delete $nmmodule'><span class='icon'><i class='fa fa-trash'></i></span></a>";

                    // }else {
                //   echo"<span class='icon'><i class='fa fa-trash'></i></span>";

                // }
                }
                echo'</td>';
                echo'</tr>';
                $no++;
            }
                                ?>
                         </tbody>
                    </table>
                  </div>
                    <div id="tablefooter">
                      <div id="tablenav">
                            <div>
                                <span class="glyphicon glyphicon-fast-backward" onclick="sorter.move(-1,true)" /></span>
                                <span class="glyphicon glyphicon-step-backward" onclick="sorter.move(-1)" /></span>
                                <span class="glyphicon glyphicon-step-forward" onclick="sorter.move(1)" /></span>
                                 <span  class="glyphicon glyphicon-fast-forward" onclick="sorter.move(1,true)" /></span>
                            </div>
                            <div>
                                <select id="pagedropdown" style="width:40px;"></select>
                            </div>
                           <!-- <div>
                                <a href="javascript:sorter.showall()">view all</a>
                            </div> -->
                        </div>
                       
                        <div id="tablelocation">
                            <div>
                                <select onchange="sorter.size(this.value)" style="width:50px;">
                                <option value="5">5</option>
                                    <option value="10" selected="selected">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span>Entries Per Page</span> </div> <div>| Page <span id="currentpage"></span> of <span id="totalpages"></span> | &nbsp  </div>
                        </div>  
                    </div>
                </div>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />
               </div>
        </div>

    <?php
}
    ?>
