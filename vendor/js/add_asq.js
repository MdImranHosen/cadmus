   $(document).ready(function(){
    $('#asq_question_form').on('submit',function(e){
       var user_id     = $('#user_id').val();
       var cat_id      = $('#cat_id').val();
       var sub_cat     = $('#sub_cat').val();
       var asq_title   = $('#asq_title').val();
       var description = $('#description').val();
       /*var des         = textboxio.get('#description');
       var desc        = des[0];
       var description = desc.content.get();*/

       if (user_id == "" || cat_id == "" || sub_cat == "" || asq_title == "") {
        $('#output_message').html('<div class="alert alert-danger">Field is Required!</div>');
        return false;
       } else{
         var form_data = new FormData();
         form_data.append("user_id", user_id);
         form_data.append("cat_id", cat_id);
         form_data.append("sub_cat", sub_cat);
         form_data.append("asq_title", asq_title);
         form_data.append("description", description);
         form_data.append("asq_save", 77);
           
         e.preventDefault();
         $.ajax({
               type: "post",
               url: "../ajax/add_asq_question.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(getdata){
                var strFirstTwo = getdata.substring(0,2);
                if (strFirstTwo == 77) {
                  var successdata = getdata.substring(2);
                  $('#output_message').html(successdata);                 
                  setTimeout(function(){
                   location.reload();
                  },3000);
                } else{
                  $('#output_message').html(getdata);
                }
                
               }
         });
         return false;
       }
    });
  });
   
function getCatBysubcat(){
var cat_id = $('#cat_id').val();
$.ajax({url: "../ajax/cat_by_subcat.php?cat_id="+cat_id+"&sub=1",success:function(subcat){
  $('#sub_cat').html(subcat);
}});
}