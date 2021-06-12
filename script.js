/*
let t1 = document.getElementById("t1");
let d1=document.getElementById("d1");
t1.addEventListener("click", () => {
	if(getComputedStyle(d1).display != "none"){
    d1.style.display = "none ";
    
  } else {
    d1.style.display = "block";
   
  }
});
*/
let Existant=document.getElementById("Existant");
let NonExistant=document.getElementById("NonExistant");
let cache=document.getElementById("DivCache");
Existant.addEventListener("click",function(event)
{
  
  cache.style.display="block";
});
NonExistant.addEventListener("click",function(event)
{
  cache.style.display="none";
});
$(document).ready(function() {
  $('input[type="file"]').change(function(e) {
      var file = e.target.files[0].name;
  const image=document.getElementById("image1");
  l.innerHTML=file;
     
  });
});
$('#inpute'.change(function(){
  number=$('inpute'.val);
  alert(number)
}));