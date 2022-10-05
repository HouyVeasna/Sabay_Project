$(document).ready(function(){ 
   // var start = $('#txt_start').val();
   // var end = $('#txt_end');
    var totalData = $('#txt_total_data').val();
    var con = $('#txt_con');
    var baseURL = $('#txt_base_url').val(); 
    // $('.btn-more').click(function(){
    //     var eThis = $(this); 
    //     // alert(start.val() +" "+ end.val());
    //     $.ajax({
    //         url:baseURL+'Home/action/get_news_json.php',
    //         type:'POST',
    //         data:{ st:start.val(), en:end.val(),con:con.val() , baseurl:baseURL },
    //         // contentType:false,
    //         cache:false,
    //         // processData:false,
    //         dataType:"json",
    //         beforeSend:function(){
    //             eThis.html('<i class="fa fa-spinner fa-spin" style="font-size: 18px;"></i> Wait...');
    //             eThis.css({"pointer-events":"none"});
    //         },
    //         success:function(data){
    //             // eThis.before(data);
    //             var txt = "";
    //             for(i=0;i<data.length;i++){
    //                 txt+= "<a class='box' href='"+baseURL+""+data[i]['mid']+"/"+data[i]['id']+"'>"+
    //                   " <div class='img-box bg-img' style='background-image:url(Admin/images/"+data[i]['img']+")'></div>"+
    //                    " <div class='txt-box'> "+
    //                      "<h1>"+data[i]['title']+"-"+data[i]['id']+"</h1>"+
    //                      "<h2>"+data[i]['date']+"</h2>"+
    //                      "<hr>"+
    //                      "<p>"+data[i]['des']+"</p>"+
    //                      "</div>"+
    //                      " </a> ";
    //             }
    //             eThis.before(txt);
    //             start.val( parseInt(start.val()) + parseInt(end.val()) );
    //             totalData.val( totalData.val() - end.val() );
    //             if(totalData.val() <=0 ){
    //                 eThis.hide();
    //             }
    //             eThis.html('View More...');
    //             eThis.css({"pointer-events":"auto"});
    //             // $('.news-content').append(data);
    //         },
    //     });

    // });
    var start = $('#txt_start').val();
    var limit = $('#txt_end').val();
    var action = 'inactive';
    function load_country_data(limit, start)
    {
        $.ajax({
            url:baseURL+'Home/action/get_news.php',
            method:"POST",
            data:{st:start, en:limit,con:con.val() , baseurl:baseURL},
            cache:false,
            beforeSend:function(){
                $('.btn-more').show();
                $('.btn-more').html('<i class="fa fa-spinner fa-spin" style="font-size: 40px;"></i>');  
                $('.btn-more').css({"pointer-events":"none"});
            },
            success:function(data)
            {
                $('.more').before(data);
                if(data == '')
                {
                    action = 'active';
                }
                else
                {
                    action = 'inactive';
                }
                $('.btn-more').hide();
                $('.btn-more').css({"pointer-events":"auto"});
            }
        });
    }
    if(action == 'inactive')
    {
        action = 'active';
        load_country_data(limit, start);
    }
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $(".more").height() && action == 'inactive')
        {
            action = 'active';
            start = parseInt(start) + parseInt(limit);
            totalData = parseInt(totalData) - parseInt(limit);
            if(totalData <=0 ){
                $(".more").hide();
                return;
            }
            setTimeout(function(){
                load_country_data(limit, start);
            },500);
        }
    });

    //menu-fixed
    // window.addEventListener("scroll",function(){
    //     var menuBox = this.document.querySelector(".menu-box");
    //     if(this.window.pageYOffset>=101){

    //         menuBox.style.position = "fixed";
    //         menuBox.style.top = "0px";
    //         menuBox.style.zIndex = "10000";
    //     }else{
    //         menuBox.style.position = "";
    //         menuBox.style.top = "";
    //         menuBox.style.zIndex = "";
    //     }
    // });
    $(window).scroll(function(){
        //console.log($(this).scrollTop());
        if($(this).scrollTop() > 104){
            $(".menu-box").css({"position":"fixed","top":"0px","z-index":"10000","transition":"0.2s linear"});
        }else{
            $(".menu-box").css({"position":"","top":"","z-index":"","transition":"0.2s linear"});
        }
    });

    //slide-box
    $(".box").mouseleave(function(){
        // alert(0);
        var eThis = $(this);
        eThis.find("main-box").css({"bottom":"0px"});
        eThis.find("box-des").fadeOut();
    });
    
    //btn-scroll-top
    var scrollTop = '';
    $(window).scroll(function(){
        var scrollTop = $(this).scrollTop();
        // console.log(scrollTop);
        if(scrollTop >= 40){
            $(".btn-scroll-top").fadeIn();
        }else{
            $(".btn-scroll-top").fadeOut();
        }
    })
    $(".btn-scroll-top").click(function(){
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
});