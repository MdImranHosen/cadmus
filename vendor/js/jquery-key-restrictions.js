jQuery.fn.lettersOnly = function() {
  $(this).keydown(function(e) {
    var key = e.which || e.keyCode;

    if(!e.altKey && !e.ctrlKey && key >=48 && key<=57 || key>=96 && key<=105 ||key==188||key==109||key==110||key==13||key==35|| key==36|| key==46||key==45||key==107||key==219||key==221||key==220||key==186||key==222|| key==191||key==187||key==192) {
        return false;
    }
    else {
      return true;  
    }
  });
}
jQuery.fn.numbersOnly = function() {
  $(this).keydown(function(e) {
    var key = e.which || e.keyCode;
    if(key >= 65 && key <= 90 || key >= 186 && key <= 188|| key >=191 && key <= 222) {
        return false;
    }
    else {
      if(!e.shiftKey) {
        return true;
      }
      else {
        return false;
      }
    }
  });
}
jQuery.fn.alphaNumericOnly = function() {
  $(this).keydown(function(e) {
    var key = e.which || e.keyCode;
    if(e.shiftKey && key >= 48 && key <= 57) {
      return false;
    }
    else {
       if(key >= 186 && key <= 187 || key >= 191 && key <= 222) {
        return false;
      }
      else {
        return true; 
      }
    }
  });
}