      
    <?php
switch (isset($_GET['act']) && $_GET['act']) {

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
                                <th><h3 style='font-size:12px;'>Nama Obat</h3></th>
                                <th><h3 style='font-size:12px;'>Satuan</h3></th>
                                <th><h3 style='font-size:12px;text-align: right;'>Jumlah</h3></th>
                                <th><h3 style='font-size:12px;'>Kadaluwarsa</h3></th>
                                <th width="50px;"><h3 style='font-size:12px;'>Aktif</h3></th>   
                                <th class='nosort' width="100px" style='text-align:center;'>
                                    <h3 style='font-size:12px;'>Aksi</h3>
                                </th>                              
                            </tr>
                        </thead>
                        <tbody>
                            
                         <?php

            $tampil = mysql_query('SELECT a.*,b.satuan 
                                FROM obat a left join satuan b 
                                 ON a.id_satuan = b.id_satuan
                                 ORDER BY a.obat ');

            $no = 1;

            while ($r = mysql_fetch_array($tampil)) {
                $jumlah = number_format($r['jumlah'], 0, '', '.');
                $kadaluwarsa = ($r['kadaluwarsa'] != '') ? date('d/m/Y', strtotime($r['kadaluwarsa'])) : '-';

                echo'<tr>';
                echo"<td>$r[obat]</td>";
                echo"<td>$r[satuan]</td>";
                echo"<td style='text-align:right;'>$jumlah</td>";
                echo"<td style='text-align:left;'>$kadaluwarsa</td>";
                echo"<td style='text-align:center;'>$r[aktif]</td>";
                echo" <td  style='text-align:center;'>";

                if ($r_edit == 'Y') {
                    echo"<a class='thickbox' href='modul/mod_$module/form_$module.php?id_obat=$r[id_obat]&id_module=$id&width=720&height=560&module=$module&TB_iframe=true' title='Update $nmmodule'><span class='icon'><i class='fa fa-pencil'></i></span></a>";
                }

                // if($r_delete == 'Y') {
                // echo"<a href='modul/mod_$module/aksi_$module.php?module=$module&act=hapus&id=$r[id_obat]&id_module=$id' onClick=\"return confirm('Delete this record ?')\" title='Delete $nmmodule'><span class='icon'><i class='fa fa-trash'></i></span></a>";
                // }
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