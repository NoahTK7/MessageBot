$(document).ready(function(){
    $("#fieldset").hide();
    $("#submit").prop("disabled", true);
    
    var type, address, number, subject, carrier, eBody, tBody, amount;
    
    $("input[type='radio']").change(function(){
        if($("input[type='radio']:checked").val()=="email"){
            $("#fieldset").show();
            $("#textContainer").hide();
            $("#emailContainer").show();
        } else if($("input[type='radio']:checked").val()=="text"){
            $("#fieldset").show();
            $("#textContainer").show();
            $("#emailContainer").hide();
        } else {
            $("#fieldset").hide();
            $("#textContainer").hide();
            $("#emailContainer").hide();
        }
    });
    
    /*$("#carrier").change(function(){
        alert($("#carrier").val());
    })*/
    
    $("button[type='submit']").click(function(event){
        //event.preventDefault();
        
        $(this).button('loading');
        
        type = $("input[type='radio']:checked").val();
        address = $("#email").val();
        number = $("#phoneNumber").val();
        subject = $("#subject").val();
        carrier = $("#carrier").val();
        eBody = $("#eBody").val();
        tBody = $("#tBody").val();
        amount = $("#amount").val();
        
        console.log(type);
        console.log(address);
        console.log(number);
        console.log(subject);
        console.log(carrier);
        console.log(eBody);
        console.log(tBody);
        console.log(amount);
        
        /*
        $.post("mail.php",{
            type: type,
            address: address,
            number: number,
            subject: subject,
            carrier: carrier,
            eBody: eBody,
            tBody: tBody,
            amount: amount
        });
        
        $(this).prop("disabled",true);
        $(this).attr("disabled","disabled");
        */
        
    });
    
});

function enableButton(){
    $("#submit").prop("disabled", false);
    console.log("enable button");
}
