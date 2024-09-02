$(document).ready(function() {
    $('#BM').on('change', function(){
        var distributorid=$(this).val();
        if(distributorid=='' || distributorid =='undefind')
        {
            alert('Please Select Business Manager.');
        }
        else{
            $.ajax({
                type:'POST',
                url: 'api/distributor-details',
                dataType: "json",
                data: {
                    distributor_id: distributorid
                },
                cache:false, 
                timeout:5000, 
                async: false,
                success: (data) => {
                    //let bmdistinfo = document.querySelector(".bmdistinfo");
                    //console.log(data.data.bm_mobile);
                    if(data.status==200)
                    {
                        
                        //bmdistinfo.classList.remove('bmdistinfo');
                        document.getElementById("distributor_name").value = data.data.bm_name;
                        document.getElementById("distributor_mobile").value = data.data.bm_mobile;
                        document.getElementById("distributor_email").value = data.data.bm_email;
                        // bmdistinfo
                        // distributor_name
                    }
                    else{
                        //bmdistinfo.classList.add('bmdistinfo');
                        alert(data.response);
                    }
                    
                    //alert(data.response);
                    //location.reload();
                },
                error: function(error){
                    //console.log(error);
                    alert('Unexpected');
                }
           });
        }
    });

    $('#leadallselect').on('click', function(){
        var checkbox=document.getElementById('leadallselect');
        let checkboxes = document.querySelectorAll('.leadcheckbox');
        var ischecked=checkbox.checked;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != ischecked)
                checkboxes[i].checked = ischecked;
        }
        let val = [];
        $('.leadcheckbox:checked').each(function(i){
          val[i] = $(this).val();
        });
        if(ischecked)
        {
            document.getElementById("selectedid").value = val;
            actiondiv();
        }
        else{
            document.getElementById("selectedid").value = '';
            const leadaction = document.querySelector(".leadaction");
            leadaction.classList.add('hidden');
        } 
        //console.log(ischecked);
    });
    let actiondiv=()=>{
        const leadaction = document.querySelector(".leadaction");
        leadaction.classList.remove('hidden');
    }
    $('#asign').on('click', function(){
        const leadids=document.getElementById("selectedid").value;
        const centerids=document.getElementById("centerid").value;
        if(centerids=='' || centerids=='undefind')
        {
            alert("Please Select Call Center.");
        }
        else if(leadids=='' || leadids=='undefind')
        {
            alert("Please Select Lead Info.");
        }
        else{
            
            $.ajax({
                type:'POST',
                url: 'api/lead-assign-center',
                dataType: "json",
                data: {
                    leadid: leadids,
                    centerid: centerids
                },
                cache:false, 
                timeout:5000, 
                async: false,
                success: (data) => {
                    //console.log(data);
                    alert(data.response);
                    location.reload();
                },
                error: function(error){
                    //console.log(error);
                    alert('Unexpected');
                }
           });
            // $.ajax({
            //     type: 'POST',
            //     url: 'delet-lead', // Replace with your Laravel route URL
            //     data: {
            //       id: id,
            //     },
            //     success: function (response) {
            //     }
            // });
        }
        
    });

    $('.leadcheckbox').on('click', function(){
        var val = [];
        let valuecheched=false;
        $('.leadcheckbox:checked').each(function(i){
          val[i] = $(this).val();
          valuecheched=true;
        });
        if(valuecheched)
        {
            document.getElementById("selectedid").value = val;
            actiondiv();
        }
        else{
            const leadaction = document.querySelector(".leadaction");
            document.getElementById("selectedid").value = '';
            leadaction.classList.add('hidden');
        }
        
    });
});