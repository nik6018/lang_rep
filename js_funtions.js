function change_dir(path_val){
    $.ajax({
        url :'inter.php',
        type: "POST",
        data : {path_val}
    })
    .done(function (data){
        try{
            if(path_val !== 'softaculous'){
                $("input[name='path']").val('webuzo');
            }

            data = JSON.parse(data);    
            file_dd = $("select[name='file_name']");

            //check if DD empty
            if(file_dd.children().length !== 2){
                $("option:contains('Create a New File')").nextAll('option').remove();
            }

            for(var i = data.length - 1; i >= 0; i--) {
                $("<option />",{value: data[i], text: data[i].split('.')[0]}).appendTo(file_dd);
            }
        }
        catch(e){
            alert('There were some error\'s '+data);
        }
        
    })
    .fail(function( xhr, status, errorThrown ) {
        alert( "Sorry, there was a problem! in the Req" );
        console.log( "Error: " + errorThrown );
        console.log( "Status: " + status );
    });
}

function opt_check(val){
    if(val == 'create_file'){
        $("input[name='nfile_name']").attr('type', 'text');
    }else{
        $("input[name='nfile_name']").attr('type', 'hidden');
    } 
}