$(document).ready(function(){
    var body = $('body');
    var popup = "<div class='popup'></div>";
    var loading = "<div class='loading'></div>";
    var frmID;   //catch value of menu
    var frm = ['frm_user.php','frm_menu.php','frm_news.php','frm_ads.php'];
    var tbl = $('#tblData');  //table
    var btnAction = "<div class='btn-edit'><i class='fas fa-edit'></i></div>";
    var ind; //to catch index of tr to edit
    var start = 0; //start limit
    var end = $('#txt_limit'); //end limit
    var totalData = $('#total_data');
    var totalPage = $('#total_page');
    var currentPage = $('#current_page');
    var find = 0;
    var textSearch = $('#txt_search_text');
    var selectSearch = $('#txt_select_search'); //select search
    var statusCheck = "<i class='fas fa-check-circle status-check'></i>";
    var statusUncheck = "<i class='fas fa-minus-circle status-uncheck'></i>";
    var searchCondition = [
        {
            "id 0":"ID",
            "u_name 1":"Name",
            "status 0":"Status"
        },
        {
            "id":"ID",
            "name":"Name",
            "status":"Status",
        },
        {
            "tbl_news.id 0":"ID",   //0=
            "tbl_menu.name 1":"Menu", //1 like
            "tbl_news.title 1":"Title", //1 like
            "tbl_news.status 1":"Status" //1 like
        },
        {
            "id":"ID",
            "location":"Location",
            "status":"Status",
        },          
    ];
    var btnPermission= "<a class='btn-permission'> <i class='fas fa-user-cog'></i> </a>";
    var uid;
    var role;
    var username = $('#txt_username').val();
    var viewImg ="<div class='popup-img'>"+
                    "<div class='view-img-box'> "+
                        "<div class='header-img'> "+
                            "<div class='header-img-left'> "+
                                "<i class='fas fa-id-card'></i> "+
                                "<span>View Image</span>"+
                            " </div>"+
                            "<div class= 'header-img-right'>"+
                                "<div class='btn-close-img-box'> "+
                                "<i class='fas fa-times'></i>"+
                            " </div>"+
                        " </div>"+
                        "<div class='body-img'>"+
                            "<img src='images/1655571194128467.jpg' alt=''>"+
                        " </div>"+
                    " </div>";
                " </div>";
              //  images/1655571194128467.jpg
    //view image
    tbl.on('click', "tbody tr img", function(){
        var myImg = $(this).attr("src");
        if( $('body').find(".popup-img").length == 0){
            $('body').append(viewImg);
        }
        $('body').find(".view-img-box img").attr("src",myImg);
    });
    //close img
    body.on('click', ".header-img-right", function(){
        $(".popup-img").remove();
    });
    //btn search
    $('#btn_search').click(function(){
        find=1;
        if(frmID ==0){
            get_user();
        }else if(frmID ==1){
            get_menu();   
        }else if(frmID ==2){
            get_news();
        }else if(frmID==3){
            get_ads();
        }
    });
     //left menu click
    
     $('.left-menu').on('click','ul li',function(){
        find=0;
        var eThis = $(this);
        frmID = eThis.data("frm_id");  //catch value form menu
        role = eThis.data("role");  //role
        $('.bar1').find('.title-box').text(eThis.text());  //catch menu to display in title
        $('.content-box').show();    //display bar2

        $('#btn_add').show();
     //   alert(role);
        if(role == 2){
            $('#btn_add').hide();
        }
        start = 0; // avoid next & prevous error
        currentPage.text(1); // avoid next & prevous error
        textSearch.val('');   // clear text box search
        // alert( searchCondition[frmID]);
        //dynamic search 
        var txt = "";
        for(var key in searchCondition[frmID]){
            txt += "<option value='"+key+"'>"+searchCondition[frmID][key]+"</option>";
        }
        //select search
        selectSearch.html(txt);
        if(frmID ==0){
            get_user();
        }else if(frmID ==1){
            get_menu();   //call function
        }else if(frmID ==2){
            get_news();
        }else if(frmID==3){
            get_ads();
        }
        eThis.parents('.left-menu').find('ul li').css({"background-color":"#eee"}); //find mae trov mean s
        eThis.css({"background-color":"#ff3838"});
    });
    //btn add
    $('#btn_add').click(function(){ 
        body.append(popup);
        body.find('.popup').append(loading);   // add loading to popup class
        $(".popup").load("frm/"+frm[frmID], function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
            // alert("External content loaded successfully!");
            get_auto_id();
            if(frmID==2){
                calleditor();  // call tiny function
            }
            $('.loading').remove();
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });
    //close form pop
    body.on('click','.frm .btn-close',function(){
        $(".popup").remove();
    });
    //get last id
    function get_auto_id(){
        var id = body.find('.frm #txt_id');   //alease txt_id is the same we can do dynamic data
        var od = body.find('.frm #txt_od');
        $.ajax({
            url:'action/get_id.php',
            type:'POST',
            data:{'frmId':frmID},
            cache:false,
            dataType:"json",
            // beforeSend:function(){
                // before no need coz has class loading already
            // },
            success:function(data){
                id.val(data.id);
                od.val(data.id);
            },
        });
    }
    //get limit data
    $('#txt_limit').change(function(){
        start = 0; // avoid next & prevous error
        currentPage.text(1); // avoid next & prevous error
        if(frmID ==0){
            get_user();
        }else if(frmID ==1){
            get_menu();   
        }else if(frmID ==2){
            get_news();
        }else if(frmID ==3){
            get_ads();
        }
    });
    //get next data
    $('#btn_next').click(function(){
        if( parseInt(currentPage.text()) == parseInt(totalPage.text()) ){
            return;
        }
        start = start + parseInt(end.val());     //mush be convert if not error
        currentPage.text( parseInt(currentPage.text()) + 1);
        if(frmID == 0){
            get_user();
        }else if(frmID == 1){
            get_menu();   
        }else if(frmID ==2){
            get_news();
        }else if(frmID ==3){
            get_ads();
        }
    });
    //get back data
    $('#btn_back').click(function(){
        if( parseInt(currentPage.text()) == 1 ){
            return;
        }
        start = start - parseInt(end.val());     //mush be convert if not error
        currentPage.text( parseInt(currentPage.text()) - 1);
        if(frmID == 0){
            get_user();
        }else if(frmID == 1){
            get_menu();   
        }else if(frmID ==2){
            get_news();
        }else{
            get_ads();
        }
    });
     //save all table
    body.on('click','.frm #save_data',function(){
        var eThis = $(this);
        if(frmID == 0){
            save_user(eThis);
        }else if(frmID == 1){
            save_menu(eThis);
        }else if(frmID ==2){
            save_new(eThis);
        }else if(frmID==3){
            save_ads(eThis);
        }
    });
     //save user
    function save_user(eThis){
        var Parent = eThis.parents('.frm');
        var id = Parent.find('#txt_id');
        var name = Parent.find("#txt_name");
        var email = Parent.find("#txt_email");
        var pass = Parent.find("#txt_password");
        var utype = Parent.find("#txt_user_type");
        var status = Parent.find("#txt_status"); 
        
        if(name.val()==''){
            alert('Please input name.');
            name.focus();
            return;
        }else if(email.val()==''){
            alert("Please input email.");
            email.focus();
            return;
        }else if(pass.val()==''){
            alert("Please input password.");
            pass.focus();
            return;
        }
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
    
        $.ajax({
            url:'action/save_user.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
              //  eThis.html("<i class='fa fa-spinner fa-spin'></i> Wait...");
                body.append(popup);
                $('.popup').last().append(loading);
               // eThis.css({"pointer-events":"none"});
            },
            success:function(data){
                var statusIcon;
                if(status.val() == 1){
                    statusIcon = statusCheck;
                }else{
                    statusIcon = statusUncheck;
                }
                if(data.dpl == true){   
                    alert('Duplicate name. try again.');
                    $('.popup').last().remove();
                    name.focus();
                }else if(data.edit==true){
                    if(utype.val() != 'admin'){
                        tbl.find('tbody tr:eq('+ind+') td:eq(1) div').text(name.val());
                        tbl.find('tbody tr:eq('+ind+') td:eq(1) span').html(btnPermission);
                    }else{
                        tbl.find('tbody tr:eq('+ind+') td:eq(1) div').text(name.val());
                        tbl.find('tbody tr:eq('+ind+') td:eq(1) span').html('');
                    }
                    tbl.find('tbody tr:eq('+ind+') td:eq(3)').text(utype.val());
                    tbl.find('tbody tr:eq('+ind+') td:eq(6)').html(statusIcon);
                    tbl.find('tbody tr:eq('+ind+') td:eq(6)').append("<span class='hide'></span>");
                    tbl.find('tbody tr:eq('+ind+') td:eq(6) span').text(status.val());
                    tbl.find('tbody tr:eq('+ind+') td').css({"background-color":"yellowgreen"});
                    $('.popup').remove();
                } else{
                    var permission;
                    if(utype.val() == 'admin'){
                        permission = "<div>"+name.val()+"</div><span></span>";
                    }else{
                        permission =  "<div>"+name.val()+"</div><span>"+btnPermission+"</span>";
                    }
                    var tr = "<tr>"+
                                "<td>"+id.val()+"</td>"+    
                                "<td align='left'>"+permission+"</td>"+    
                                "<td align='left'>"+email.val()+"</td>"+  
                            //   "<td>"+pass.val()+"</td>"+   
                                "<td>"+utype.val()+"</td>"+  
                                "<td>000</td>"+  
                                "<td>123</td>"+  
                                "<td><span class='hide'>"+status.val()+"</span>"+statusIcon+"</td>"+
                                "<td>"+btnAction+"</td>"+  
                            "</tr>"
                    tbl.find("tbody tr:eq(0)").before(tr);
                    id.val(data.id);
                    name.val("");
                    email.val("");
                    pass.val("");
                    name.focus();
                    $('.popup').last().remove();
                }
              //  eThis.html(" <i class='fas fa-save'></i> Save" );
               // eThis.css({"pointer-events":"auto"});\
               
            },				
        }); 
    }
    //save menu
    function save_menu(eThis){
        var Parent = eThis.parents('.frm');
        var id = Parent.find('#txt_id');
        var name = Parent.find('#txt_name');
        var od = Parent.find('#txt_od');
        var status = Parent.find('#txt_status');
        var imgBox = Parent.find('.img-box');
        var file = Parent.find('#txt_file');
        var photo = Parent.find('#txt_photo');
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        if(name.val() == ''){
            alert("Please input name");
            name.focus();
            return;
        }else if(photo.val() == ''){
            alert("Please select photo");
            return; 
        }
        $.ajax({
            // url:'action/sava-menu.php',
            url:'action/save_menu.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",   //alease use json encode in php
            beforeSend:function(){
                body.append(popup);
                $('.popup').last().append(loading);  // យកតែអាចុងក្រោយគេកុំអោយជាន់
            },
            success:function(data){
                var statusIcon;
                if(status.val() == 1){
                    statusIcon = statusCheck;
                }else{
                    statusIcon = statusUncheck;
                }
                if(data.dpl==true){
                    alert('Dubplicate data');
                    $('.popup').last().remove();
                    name.focus();                       
                }else if(data.edit==true){
                    tbl.find('tbody tr:eq('+ind+') td:eq(1)').text(name.val());
                    tbl.find('tbody tr:eq('+ind+') td:eq(2)').text(od.val());
                    tbl.find('tbody tr:eq('+ind+') td:eq(3) img').attr("src","images/"+photo.val()+"");
                    tbl.find('tbody tr:eq('+ind+') td:eq(3) img').attr("alt",""+photo.val()+"");
                    tbl.find('tbody tr:eq('+ind+') td:eq(4)').html(statusIcon);
                    tbl.find('tbody tr:eq('+ind+') td:eq(4)').append("<span class='hide'></span>");
                    tbl.find('tbody tr:eq('+ind+') td:eq(4) span').text(status.val());
                     // change background
                    tbl.find('tbody tr:eq('+ind+') td').css({"background-color":"#99CCFF"});
                    $('.popup').remove();  //remove all
                }else{
                    var tr = " <tr>"+
                                "<td>"+data.id+"</td>"+
                                "<td align='left'>"+name.val()+"</td>"+
                                "<td>"+od.val()+"</td>"+
                                "<td><img src='images/"+photo.val()+"' alt='"+photo.val()+"'</td>"+
                                "<td><span class='hide'>"+status.val()+"</span>"+statusIcon+"</td>"+
                                "<td>"+btnAction+"</td>"+
                             " </tr>";
                    // tbl.append(tr);  //insert to last
                    // tbl.find('tbody tr:eq(0)').after(tr).css({"background-color":"yellowgreen"}); //insert to top
                    tbl.find('tbody tr:eq(0)').before(tr);
                    photo.val('');
                    file.val('');
                    name.val('');
                    name.focus();
                    imgBox.css({"background-image":"url(css/bg-img/user1.jpg)"});
                    id.val(data.id+1);
                    od.val(data.id+1);
                    $('.popup').last().remove();
                }                     
               
            },
        });
    }
    //save news
    function save_new(eThis){
        tinymce.triggerSave();
        var Parent = eThis.parents('.frm');
        var id = Parent.find('#txt_id');
        var mid = Parent.find('#txt_menu');
        var mname = Parent.find('#txt_menu option:selected').text();
        var title = Parent.find('#txt_title');
        var des = Parent.find('#txt_des');
        var location = Parent.find('#txt_location');
        var od = Parent.find('#txt_od');
        var status = Parent.find('#txt_status');
        var imgBox = Parent.find('.img-box');
        var file = Parent.find('#txt_file');
        var photo = Parent.find('#txt_photo');
        if(mid.val()==0){
            alert("Please select menu");
            return;
        }else if(title.val()==''){
            alert("Please input title");
            title.focus();
            return;
        }else if(des.val()==''){
            alert("Please input description");
            des.focus();
            return;
        }else if(photo.val()==''){
            alert("Please choose photo");
            photo.focus();
            return;
        }
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            // url:'action/sava-menu.php',
            url:'action/save_news.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",   //alease use json encode in php
            beforeSend:function(){
                body.append(popup);
                $('.popup').last().append(loading);  // យកតែអាចុងក្រោយគេកុំអោយជាន់
            },
            success:function(data){   
                var statusIcon;
                if(status.val() == 1){
                    statusIcon = statusCheck;
                }else{
                    statusIcon = statusUncheck;
                }                         
                if(data.edit==true){
                    // alert("data was edit "+ind);
                    tbl.find('tbody tr:eq('+ind+') td:eq(1)').text(mname);
                    tbl.find('tbody tr:eq('+ind+') td:eq(2)').text(title.val());
                    tbl.find('tbody tr:eq('+ind+') td:eq(3) img').attr("src","images/"+photo.val()+"");
                    tbl.find('tbody tr:eq('+ind+') td:eq(3) img').attr("alt",""+photo.val()+"");
                    tbl.find('tbody tr:eq('+ind+') td:eq(4)').text(location.val());
                    tbl.find('tbody tr:eq('+ind+') td:eq(5)').text(od.val());
                    tbl.find('tbody tr:eq('+ind+') td:eq(8)').html(statusIcon);
                    tbl.find('tbody tr:eq('+ind+') td:eq(8)').append("<span class='hide'></span>");
                    tbl.find('tbody tr:eq('+ind+') td:eq(8) span').text(status.val());
                     // change background
                    tbl.find('tbody tr:eq('+ind+') td').css({"background-color":"yellowgreen"});
                    $('.popup').remove();  //remove all
                }else{
                    var tr = "<tr>"+
                                "<td>"+data.id+"</td>"+
                                "<td>"+mname+"</td>"+
                                "<td align='left'>"+title.val()+"</td>"+
                                "<td><img src='images/"+photo.val()+"' alt='"+photo.val()+"'</td>"+
                                "<td>"+location.val()+"</td>"+
                                "<td>"+od.val()+"</td>"+
                                "<td>0</td>"+
                                "<td>"+username+"</td>"+
                                "<td><span class='hide'>"+status.val()+"</span>"+statusIcon+"</td>"+
                                "<td>"+btnAction+"</td>"+
                             " </tr>";
                    // tbl.append(tr);  //insert to last
                    // tbl.find('tbody tr:eq(0)').after(tr).css({"background-color":"yellowgreen"}); //insert to top
                    tbl.find('tbody tr:eq(0)').before(tr);
                    photo.val('');
                    file.val('');
                    title.val('');
                    title.focus();
                    des.val('');
                    tinyMCE.activeEditor.setContent(''); // clear tinyMCE
                    imgBox.css({"background-image":"url(css/bg-img/user1.jpg)"});
                    id.val(data.id+1);
                    od.val(data.id+1);
                    $('.popup').last().remove();
                }                     
               
            },
        });
    }
    //save ads
    function save_ads(eThis){
        var Parent = eThis.parents('.frm');
        var id = Parent.find('#txt_id');
        var url = Parent.find('#txt_url');
        var location = Parent.find('#txt_location');
        var od = Parent.find('#txt_od');
        var typeAds = Parent.find('#txt_type_ads');
        var status = Parent.find('#txt_status');
        var imgBox = Parent.find('.img-box');
        var file = Parent.find('#txt_file');
        var photo = Parent.find('#txt_photo');
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            // url:'action/sava-menu.php',
            url:'action/save_ads.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",   //alease use json encode in php
            beforeSend:function(){
                body.append(popup);
                $('.popup').last().append(loading);  // យកតែអាចុងក្រោយគេកុំអោយជាន់
            },
            success:function(data){
                var statusIcon;
                if(status.val() == 1){
                    statusIcon = statusCheck;
                }else{
                    statusIcon = statusUncheck;
                }
                if( data.edit==true ){
                    // alert("data was edit "+ind);
                    tbl.find('tbody tr:eq('+ind+') td:eq(1)').text(url.val());
                    tbl.find('tbody tr:eq('+ind+') td:eq(2) img').attr("src","images/"+photo.val()+"");
                    tbl.find('tbody tr:eq('+ind+') td:eq(2) img').attr("alt",""+photo.val()+"");
                    tbl.find('tbody tr:eq('+ind+') td:eq(3)').text(location.val());
                    tbl.find('tbody tr:eq('+ind+') td:eq(4)').text(typeAds.val());
                    tbl.find('tbody tr:eq('+ind+') td:eq(5)').text(od.val());
                    tbl.find('tbody tr:eq('+ind+') td:eq(6)').html(statusIcon);
                    tbl.find('tbody tr:eq('+ind+') td:eq(6)').append("<span class='hide'></span>");
                    tbl.find('tbody tr:eq('+ind+') td:eq(6) span').text(status.val());
                     // change background
                    tbl.find('tbody tr:eq('+ind+') td').css({"background-color":"yellowgreen"});
                    $('.popup').remove();  //remove all
                }else{
                    var tr = "<tr>"+
                                "<td>"+data.id+"</td>"+
                                "<td align='left'>"+url.val()+"</td>"+
                                "<td><img src='images/"+photo.val()+"' alt='"+photo.val()+"'</td>"+
                                "<td>"+location.val()+"</td>"+
                                "<td>"+typeAds.val()+"</td>"+
                                "<td>"+od.val()+"</td>"+
                                "<td><span class='hide'>"+status.val()+"</span>"+statusIcon+"</td>"+
                                "<td>"+btnAction+"</td>"+
                             "</tr>";
                    // tbl.append(tr);  //insert to last
                    // tbl.find('tbody tr:eq(0)').after(tr).css({"background-color":"yellowgreen"}); //insert to top
                    tbl.find('tbody tr:eq(0)').before(tr);
                    photo.val('');
                    file.val('');
                    url.val('');
                    url.focus();
                    imgBox.css({"background-image":"url(css/bg-img/user1.jpg)"});
                    id.val(data.id+1);
                    od.val(data.id+1);
                    $('.popup').last().remove();
                }                       
            },
        });
    }
    //get edit all table
    tbl.on('click','tr td .btn-edit',function(){
        var eThis = $(this);
        if(frmID == 0){
            get_edit_user(eThis);
        }else if(frmID == 1){
            get_edit_menu(eThis);
        }else if(frmID ==2){
            get_edit_news(eThis);
        }else if(frmID ==3){
            get_edit_ads(eThis);
        }
    });
     //get edit user
     function get_edit_user(eThis){
        var Parent = eThis.parents('tr');
        ind = Parent.index();
        var id = Parent.find('td:eq(0)').text().trim();
        var uname = Parent.find('td:eq(1)').text().trim();
        var uemail = "******";
        var upass= "******";
        var utype = Parent.find('td:eq(3)').text().trim();
        var status = Parent.find('td:eq(6) span').text().trim();
        body.append(popup);
        body.find('.popup').append(loading);
        $(".popup").load("frm/"+frm[frmID], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                body.find('.frm #txt_edit_id').val(id);
                body.find('.frm #txt_id').val(id);
                body.find('.frm #txt_name').val(uname);
                body.find('.frm #txt_email').val(uemail);
                body.find('.frm #txt_password').val(upass);
                body.find('.frm #txt_user_type').val(utype);
                body.find('.frm #txt_status').val(status);
                $('.loading').remove();
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    //get edit menu
    function get_edit_menu(eThis){
        var Parent = eThis.parents('tr');
        ind = Parent.index();
        var id = Parent.find('td:eq(0)').text().trim();
        var name = Parent.find('td:eq(1)').text().trim();
        var od = Parent.find('td:eq(2)').text().trim();
        var img = Parent.find('td:eq(3) img').attr('alt');
        var status = Parent.find('td:eq(4) span').text().trim();
        body.append(popup);
        body.find('.popup').append(loading);   // add loading to popup class
        $(".popup").load("frm/"+frm[frmID], function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
            // alert("External content loaded successfully!");
            body.find('.frm #txt_edit_id').val(id);
            body.find('.frm #txt_id').val(id);
            body.find('.frm #txt_name').val(name);
            body.find('.frm #txt_od').val(od);
            body.find('.frm #txt_status').val(status);
            body.find('.frm #txt_photo').val(img);
            body.find('.frm .img-box').css({"background-image":"url(images/"+img+")"});
            $('.loading').remove();
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    //get edit news
    function get_edit_news(eThis){
        var Parent = eThis.parents('tr');
        ind = Parent.index();
        var id = Parent.find('td:eq(0)').text().trim();
        var status = Parent.find('td:eq(8) span').text().trim();
        body.append(popup);
        body.find('.popup').append(loading);   // add loading to popup class
        $(".popup").load("frm/"+frm[frmID], function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
            $('.loading').remove();
            $.ajax({
                url:'action/get_news_edit.php',
                type:'POST',
                data:{ id:id },
                // contentType:false,
                cache:false,
                // processData:false,
                dataType:"json",   //alease use json encode in php
                beforeSend:function(){
                    body.append(popup);
                    $('.popup').last().append(loading);
                },
                success:function(data){
                    body.find('.frm #txt_edit_id').val(id);
                    body.find('.frm #txt_id').val(id);
                    body.find('.frm #txt_menu').val(data.mid);
                    body.find('.frm #txt_title').val(data.title);
                    body.find('.frm #txt_des').val(data.des);
                    body.find('.frm #txt_od').val(data.od);
                    // body.find('.frm #txt_status').val(data.status);
                    body.find('.frm #txt_status').val(status);
                    body.find('.frm #txt_photo').val(data.img);
                    body.find('.frm .img-box').css({"background-image":"url(images/"+data.img+")"});
                    $('.popup').last().remove();
                    calleditor();
                },
            });
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    //get edit ads
    function get_edit_ads(eThis){
        var Parent = eThis.parents('tr');
        ind = Parent.index();
        var id = Parent.find('td:eq(0)').text().trim();
        var url = Parent.find('td:eq(1)').text().trim();
        var img = Parent.find('td:eq(2) img').attr('alt');
        var location = Parent.find('td:eq(3)').text().trim();
        var ads_type = Parent.find('td:eq(4)').text().trim();
        var od = Parent.find('td:eq(5)').text().trim();
        var status = Parent.find('td:eq(6) span').text().trim();
        body.append(popup);
        body.find('.popup').append(loading);   // add loading to popup class
        $(".popup").load("frm/"+frm[frmID], function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
            // alert("External content loaded successfully!");
            body.find('.frm #txt_edit_id').val(id);
            body.find('.frm #txt_id').val(id);
            body.find('.frm #txt_url').val(url);
            body.find('.frm #txt_location').val(location);
            body.find('.frm #txt_type_ads').val(ads_type);
            body.find('.frm #txt_od').val(od);
            body.find('.frm #txt_status').val(status);
            body.find('.frm #txt_photo').val(img);
            body.find('.frm .img-box').css({"background-image":"url(images/"+img+")"});
            $('.loading').remove();
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }

   //table dynamic
    //get user
    function get_user(){
        var th="<thead>"+
                    " <tr>"+
                        "<th width='50'>ID</th>"+
                        "<th width='200'>User Name</th>"+
                        "<th>Email</th>"+
                        "<th width='100'>User Type</th>"+
                        "<th width='150'>IP</th>"+
                        "<th width='100'>Verify Code</th>"+
                        "<th width='50'>Status</th>"+
                        "<th width='50'>Action</th>"+
                    " </tr>"+
            "</thead>";
        $.ajax({
            url:'action/get_user.php',
            type:'POST',
            data:{ s:start,e:end.val(),find:find,txtSearch:textSearch.val(),searchFld:selectSearch.val() },
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                body.append(popup);
                $('.popup').last().append(loading);
            },
            success:function(data){
                var dataNum = data.length;
                var txt='';
                var permission;
                var statusIcon;
                // alert(data[0].total_item);
                if(dataNum > 0){
                    totalData.text(data[0].total_item);
                    totalPage.text( Math.ceil( parseFloat(data[0].total_item / end.val())) );
                    for( i=0; i<dataNum; i++ ){
                        if(data[i].utype == 'admin'){
                            permission = "<div>"+data[i]['uname']+"</div><span></span>";
                        }else{
                            permission =  "<div>"+data[i]['uname']+"</div><span>"+btnPermission+"</span>";
                        }
                        if(data[i].status == 1){
                            statusIcon = statusCheck;
                        }else{
                            statusIcon = statusUncheck;
                        }
                        txt += "<tr>"+
                                    "<td>"+data[i].id+"</td>"+
                                    "<td align='left'>" + permission + "</td>"+           
                                    "<td align='left'>"+data[i].uemail+"</td>"+
                                    "<td>"+data[i].utype+"</td>"+
                                    "<td>"+data[i].ip+"</td>"+
                                    "<td>"+data[i].code+"</td>"+
                                    "<td><span class='hide'>"+data[i].status+"</span>"+statusIcon+"</td>"+
                                    "<td>"+btnAction+"</td>"+
                                "</tr>";
                    }
                }
                tbl.html(th+"<tbody align='center'>"+txt+"</tbody>");
                $('.btn-edit').show();
                if(role == 2){
                    $('.btn-edit').hide();
                }    
                $('.popup').remove();
            },
        });
    
    }
   function get_menu(){
       var th="<thead>"+
       " <tr>"+
            "<th width='50'>#</th>"+
           " <th>Name</th>"+
           " <th width='50'>OD</th>"+
            "<th width='50'>Photo</th>"+
            "<th width='50'>Status</th>"+
            "<th width='50'>Action</th>"+
       " </tr>"+
    "</thead>";
    // txt_search:textSearch.val()
    $.ajax({
        url:'action/get_menu_json.php',
        type:'POST',
        data:{ s:start,e:end.val(),find:find,txtSearch:textSearch.val(),searchFld:selectSearch.val() },
        // contentType:false,
        cache:false,
        // processData:false,
        dataType:"json",   //alease use json encode in php
        beforeSend:function(){
            body.append(popup);
            $('.popup').last().append(loading);
        },
        success:function(data){
            var dataNum = data.length;
            if(dataNum > 0 ){   // use when search no data
                totalData.text(data[0].total_item);
                totalPage.text( Math.ceil( parseFloat(data[0].total_item / end.val())) );
                var txt = '';
                var statusIcon;
                for(i=0;i<dataNum;i++){
                if(data[i].status == 1){
                    statusIcon = statusCheck;
                }else{
                    statusIcon = statusUncheck;
                }
                txt += " <tr>"+
                            "<td>"+data[i].id+"</td>"+
                            "<td align='left'>"+data[i].name+"</td>"+
                            "<td>"+data[i].od+"</td>"+
                            "<td><img src='images/"+data[i].img+"' alt='"+data[i].img+"'</td>"+
                            "<td><span class='hide'>"+data[i].status+"</span>"+statusIcon+"</td>"+
                            "<td>"+btnAction+"</td>"+
                        " </tr>";                 
                }
                tbl.html(th+"<tbody align='center'>"+txt+"</tbody>");    //html it replace
                $('.btn-edit').show();
                if(role == 2){
                    $('.btn-edit').hide();
                }
            }else{
                alert("No Data");
            }
            $('.popup').remove();
        },
    });
    }
   function get_news(){
       var th="<thead>"+
       " <tr>"+
            "<th width='40'>#</th>"+
            "<th width='150'>Menu</th>"+
            "<th>Title</th>"+
            "<th width='50'>Photo</th>"+
            "<th width='40'>Location</th>"+
            "<th width='40'>OD</th>"+
            "<th width='40'>View</th>"+
            "<th width='120'>User</th>"+
            "<th width='40'>Status</th>"+
            "<th width='50'>Action</th>"+
       " </tr>"+
    "</thead>";
    $.ajax({
        url:'action/get_news.php',
        type:'POST',
        data:{ s:start,e:end.val(),find:find,txtSearch:textSearch.val(),searchFld:selectSearch.val() },
        // contentType:false,
        cache:false,
        // processData:false,
        dataType:"json",   //alease use json encode in php
        beforeSend:function(){
            body.append(popup);
            $('.popup').last().append(loading);
        },
        success:function(data){
            
            var dataNum = data.length;
            if(dataNum > 0 ){   // use when search no data
                totalData.text(data[0].total_item);
                totalPage.text( Math.ceil( parseFloat(data[0].total_item / end.val())) );
                var txt = '';
                var statusIcon;
                for(i=0;i<dataNum;i++){
                if(data[i].status == 1){
                    statusIcon = statusCheck;
                }else{
                    statusIcon = statusUncheck;
                }
                txt += " <tr>"+
                            "<td>"+data[i].id+"</td>"+
                            "<td>"+data[i].menu+"</td>"+
                            "<td align='left'>"+data[i].title+"</td>"+
                            "<td><img src='images/"+data[i].img+"' alt='"+data[i].img+"'</td>"+
                            "<td>"+data[i].location+"</td>"+
                            "<td>"+data[i].od+"</td>"+
                            "<td>"+data[i].view+"</td>"+
                            "<td>"+data[i].user+"</td>"+
                            "<td><span class='hide'>"+data[i].status+"</span>"+statusIcon+"</td>"+
                            "<td>"+btnAction+"</td>"+
                        " </tr>";                 
                }
                tbl.html(th+"<tbody align='center'>"+txt+"</tbody>");    //html it replace
                $('.btn-edit').show();
                if(role == 2){
                    $('.btn-edit').hide();
                }
            }else{
                alert("No Data");
            }
            $('.popup').remove();
        },
    });
    tbl.html(th);
    }
   function get_ads(){
       var th="<thead>"+
                " <tr>"+
                        "<th width='50'>#</th>"+
                        "<th>URL</th>"+
                        "<th width='50'>Photo</th>"+
                        "<th width='50'>Location</th>"+
                        "<th width='100'>ADS Type</th>"+
                        "<th width='50'>OD</th>"+
                        "<th width='50'>Status</th>"+
                        "<th width='50'>Action</th>"+
                " </tr>"+
            "</thead>";
        $.ajax({
            url:'action/get_ads.php',
            type:'POST',
            data:{ s:start,e:end.val(),find:find,txtSearch:textSearch.val(),searchFld:selectSearch.val() },
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",   //alease use json encode in php
            beforeSend:function(){
                body.append(popup);
                $('.popup').last().append(loading);
            },
            success:function(data){
                var dataNum = data.length;
                if(dataNum > 0 ){   // use when search no data
                    totalData.text(data[0].total_item);
                    totalPage.text( Math.ceil( parseFloat(data[0].total_item / end.val())) );
                    var txt = '';
                    var statusIcon;
                    for(i=0;i<dataNum;i++){
                    if(data[i].status == 1){
                        statusIcon = statusCheck;
                    }else{
                        statusIcon = statusUncheck;
                    }
                    txt += " <tr>"+
                                "<td>"+data[i].id+"</td>"+
                                "<td align='left'>"+data[i].url+"</td>"+
                                "<td><img src='images/"+data[i].img+"' alt='"+data[i].img+"'</td>"+
                                "<td>"+data[i].location+"</td>"+
                                "<td>"+data[i].type+"</td>"+
                                "<td>"+data[i].od+"</td>"+
                                "<td><span class='hide'>"+data[i].status+"</span>"+statusIcon+"</td>"+
                                "<td>"+btnAction+"</td>"+
                            " </tr>";                 
                    }
                    tbl.html(th+"<tbody align='center'>"+txt+"</tbody>");    //html it replace
                    $('.btn-edit').show();
                    if(role == 2){
                        $('.btn-edit').hide();
                    }
                }else{
                    alert("No Data");
                }
                $('.popup').remove();
            },
        });
    }

    //save image
    body.on('change','.frm #txt_file',function(){
        var eThis = $(this);
        //image-box
        var imgbox = eThis.parent();
        //loading
        var loading_img ="<div class='loading-img'></div>";
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);    
        $.ajax({
            url:'action/upl_img-3.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                imgbox.append(loading_img);
            },
            success:function(data){
                imgbox.css({"background-image":"url(images/"+data.img+")"});
                imgbox.find('.loading-img').remove();
                // imgBox.find('.txt_photo').val(data.img);
                $('#txt_photo').val(data.img);
            }
        });
    });

    //tiny editor for generate this editor
    function calleditor(){
        tinymce.remove();
        tinymce.init({selector:"textarea",theme: "modern",width: "760",height:"300",relative_urls: false, remove_script_host: false,
        file_browser_callback:function(field_name, url, type, win){
        var filebrowser = "Js/filebrowser.php";
        filebrowser += (filebrowser.indexOf("?") < 0) ? "?type=" + type : "&type=" + type;
        tinymce.activeEditor.windowManager.open({
        title : "Insert Photo",
        width : 660,
        height : 500,
        url : filebrowser
        }, {
        window : win,
        input : field_name
        });
        return false;
        },
        plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern imagetools media code",	
        ],
        menubar:true,toolbar1: "undo redo | insert | sizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
        toolbar2:"fontselect | fontsizeselect | forecolor media code",
        });
    }


    //btn-menu
    $('.btn-menu').click(function(){
        $(".left-menu").toggle();
        $(".content-box").toggleClass('content-active');
    });


    //get permission form
    body.on("click",".btn-permission",function(){
    var eThis = $(this);
    uid = eThis.parents("tr").find('td:eq(0)').text(); //1
    body.append(popup);
    $(".popup").load("frm/frm_permission.php", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
            body.find('.frm .title').text("User Permission"); //title
            $.ajax({
                url:'action/get_user_permission.php',
                type:'POST',
                data:{'uid':uid},
                //contentType:false,
                cache:false,
                //processData:false,
                dataType:"json",
                success:function(data){             
                    for( i=0; i<data.length; i++ ){
                    body.find("table#tblPermission tr:eq( "+ ( parseInt(data[i].mid) + 1 ) +" ) td select").val(data[i].aid);
                    }
                }				
            });
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });

     //set permission
     body.on("change",'table#tblPermission tr td select',function(){
        var eThis = $(this);
        var Parent = eThis.parents("tr");
        var mid = Parent.find('td:eq(0) span').text();
        var actionID = eThis.val();
        $.ajax({
            url:'action/set_permission.php',
            type:'POST',
            data:{'uid':uid,'mid':mid,'aid':actionID},
            //contentType:false,
            cache:false,
            //processData:false,
            dataType:"json",
            beforeSend:function(){
           
            body.append(popup);
                $('.popup').last().append(loading);
            },
            success:function(data){   
                $('.popup').last().remove();
            }				
        });  

    });

});