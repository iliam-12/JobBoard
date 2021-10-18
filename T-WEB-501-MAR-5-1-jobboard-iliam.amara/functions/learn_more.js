// function learn_more(id) {
//   var text = document.getElementById("desc_" + id)
//   var div = document.getElementById("inde_advert_" + id)
//   var appli = document.getElementById("applied_" + id)

//   if (text.style.overflow == "hidden") {
//     appli.style.display = "initial"
//     div.style.height = "fit-content"
//     text.style.overflow = "scroll"
//     text.style.height = "fit-content"
//   } else {
//     appli.style.display = "none"
//     text.style.overflow = 'hidden'
//     div.style.height = "60vh"
//     text.style.height = "15vh"
//   }
// }

function applied(id) {
  var path= "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/addvertising.php?id=" + id
  window.location = path
}