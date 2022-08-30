
function scrollSmoothTo( id ) {
  var elmnt = document.getElementById( id ); 
  elmnt.scrollIntoView({behavior:'smooth'});
}