//Tooltip for every where
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
console.log('Hi');

// var options = {
//     animation: true,
// };
// var element = document.getElementById('fav');
// var tooltip = new bootstrap.Tooltip(element, options);
