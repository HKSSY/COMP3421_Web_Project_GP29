 function validate_cvv(cvv){

     var myRe = /^[0-9]{3,4}$/;
     var myArray = myRe.exec(cvv);
     if(cvv!=myArray)
      {
        alert("Invalid cvv number"); //invalid cvv number
        return false;
     }else{
         return true;  //valid cvv number
        }
 }