<div class="frm">
     <div class="header">
         <span>
             Ads
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

             <label for="" class="lable">User Name:</label>
             <input type="text" name="txt_name" id="txt_name" class="frm-control">
             <label for="" class="lable">User Email</label>
             <input type="email" name="txt_email" id="txt_email" class="frm-control">
             <label for="" class="lable">User Password</label>
             <input type="password" name="txt_password" id="txt_password" class="frm-control">
             <label for="" class="lable">User Type</label>
             <select name="txt_user_type" id="txt_user_type" class="frm-control">
                 <option value="admin">admin</option>
                 <option value="client">client</option>
             </select>
             <label for="" class="lable">Status(1=enable & 2=disable)</label>
             <select name="txt_status" id="txt_status" class="frm-control">
                 <option value="1">1</option>
                 <option value="2">2</option>
             </select>
        </div>
         <div class="footer">
             <div class="btn btn-2" id="save_data">
                 <i class="fas fa-save"></i> Save
             </div>
         </div>
     </form>
 </div>