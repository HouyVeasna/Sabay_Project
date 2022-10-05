 <div class="frm">
     <div class="header">
         <span>
             Menu
         </span>
         <div class="btn-close">
             <i class="fas fa-times"></i>
         </div>
     </div>
     <form class="upl" enctype="multipart/form-data">
         <div class="body">
             <input type="hidden" name="txt_edit_id" value="0" id="txt_edit_id">
             <label for="" class="lable">ID:</label>
             <input type="text" name="txt_id" id="txt_id" class="frm-control" readonly>
             <label for="" class="lable">Name:</label>
             <input type="text" name="txt_name" id="txt_name" class="frm-control">
             <label for="" class="lable">Od</label>
             <input type="text" name="txt_od" id="txt_od" class="frm-control">
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
         <div class="footer">
             <div class="btn btn-2" id="save_data">
                 <i class="fas fa-save"></i> Save
             </div>
         </div>
     </form>
 </div>