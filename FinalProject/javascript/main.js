$("#seniors_id").hover(function () {
        // over
        $(this).addClass('show');
        $(this).attr('aria-expanded', false);
        $("#list_id").addClass('show');
        //$(this).css("background-color", "yellow");


        
    }, function () {
        // out
        $(this).removeClass('show');
        $(this).attr('aria-expanded', false);
        $("#list_id").removeClass('show');

    }
);

$("#list_id").hover(function () {
        // over
        $("#list_id").addClass('show');
        
    }, function () {
        // out
        $(this).removeClass('show');

    }
);

$(".nav-link").hover(function () {
        // over
        $(this).addClass('activated');
        
    }, function () {
        // out
        $(this).removeClass('activated');

    }
);
$(document).ready(function () {
    let path=document.location.href.match(/[^\/]+$/)[0].slice(0,-4).toUpperCase();
    path=="INDEX" ? path="HOME": path=path;
    path=="TOURIST" ? path="TOURISTS": path=path;
    path=="CONTACTUS" ? path="CONTACT": path=path;

    document.title=path;
    let links = $("#navbarTogglerDemo01").find("a");

    for(var i=0;i<links.length;i++){
        
        if(links[i].text.toUpperCase()==path){
            links[i].classList.add("active");

        }

    }
        
    


});
$('#inquiryType').on('change', function() {
    if(this.value=='1'){
        $('#addField2').hide();
        $('#investAmount').removeAttr('required');
        $('#addField1').show();
        $('#rentAmount').prop('required',true);


    }else if(this.value=='2'){
        $('#addField1').hide();
        $('#rentAmount').removeAttr('required');
        $('#addField2').show();
        $('#investAmount').prop('required',true);
        

    }else{
        $('#addField1').hide();
        $('#investAmount').removeAttr('required');
        $('#rentAmount').removeAttr('required');


        $('#addField2').hide();
    }

  });


    
