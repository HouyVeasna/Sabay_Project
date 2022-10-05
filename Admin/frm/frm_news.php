 <?php
    include_once("../action/db/db.php");
    $db = new Db;
    ?>
 <div class="frm" style="width: 75%;">
     <div class="header">
         <span>
             News
         </span>
         <div class="btn-close">
             <i class="fas fa-times"></i>
         </div>
     </div>
     <form class="upl" enctype="multipart/form-data">
         <div class="body">
             <div style="width: 31%; float: left;">
                 <input type="hidden" name="txt_edit_id" value="0" id="txt_edit_id">
                 <label for="" class="lable">ID:</label>
                 <input type="text" name="txt_id" id="txt_id" class="frm-control" readonly>
                 <select name="txt_menu" id="txt_menu" class="frm-control">
                     <option value="0">-----Select-----</option>
                     <?php
                        $post_data = $db->selectData("tbl_menu","id,name","status=1","id>0",0,2000000000);
                          if($post_data != '0'){
                            foreach($post_data as $row){
                            ?>
                                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                            <?php
                            }
                        }
                    ?>
                 </select>
                 <label for="" class="lable">Od</label>
                 <input type="text" name="txt_od" id="txt_od" class="frm-control">
                 <label for="" class="lable">Location</label>
                 <select name="txt_location" id="txt_location" class="frm-control">
                     <option value="1">1</option>
                     <option value="1">2</option>
                 </select>
                 <label for="" class="lable">Status(1=active & 2=delete)</label>
                 <select name="txt_status" id="txt_status" class="frm-control">
                     <option value="1">1</option>
                     <option value="2">2</option>
                 </select>
                 <label for="" class="lable">Image</label>
                 <div class="img-box">
                     <input type="file" name="txt_file" id="txt_file">
                 </div>
                 <input type="hidden" name="txt_photo" id="txt_photo">
             </div>
            <div style="width: 66%; float: left; margin-left: 3%;" >
                <label for="" class="lable">Title:</label>
                <input type="text" name="txt_title" id="txt_title" class="frm-control">
                <label for="" class="lable">Description:</label><br><br><br><br><br>
                <textarea name="txt_des" id="txt_des" rows="17" class="frm-control"></textarea>
            </div>
         </div>
         <div class="footer">
             <div class="btn btn-2" id="save_data">
                 <i class="fas fa-save"></i> Save
             </div>
         </div>
     </form>
 </div>