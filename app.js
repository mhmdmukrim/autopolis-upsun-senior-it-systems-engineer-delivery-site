document.getElementById("year").textContent=new Date().getFullYear();
var t=document.getElementById("navToggle"),nav=document.querySelector(".site-head nav");
if(t&&nav){t.addEventListener("click",function(){var open=nav.classList.toggle("open");t.setAttribute("aria-expanded",open?"true":"false")})}
var f=document.getElementById("contactForm");
if(f&&(f.getAttribute("action")||"").indexOf("mailto:")===0){f.addEventListener("submit",function(e){
  e.preventDefault();var d=new FormData(f);  window.location.href=f.action+"?subject="+encodeURIComponent("Enquiry from "+(d.get("name")||""))  +"&body="+encodeURIComponent((d.get("message")||"")+"\n\n— "+(d.get("email")||""))})}
else if(f){f.addEventListener("submit",function(e){document.getElementById("formNote").textContent="sending…"})}
