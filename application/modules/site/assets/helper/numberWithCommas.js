function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function setTwoNumberDecimal(el) {
	let two = '.00';
    let per = el.value;

	if(per.slice(per.length - 1) == "."  ){
    el.value = parseFloat(el.value) + two;
	}
    };

//USE THIS oninput="setTwoNumberDecimal(this)" step="0.01" 


// var placeSearch, Address;

// var componentForm = {
 // // autocomplete: 'short_name',
  // Address: 'long_name',
 // // locality: 'long_name',
  // administrative_area_level_1: 'long_name',
 // // country: 'long_name',
  // postal_code: 'short_name'
// };

// document.getElementById("Address").addEventListener("focus", function() {
// var add = document.getElementById("Address").value;	
// });

// function initAutocomplete() {
  // // Create the autocomplete object, restricting the search predictions to
  // // geographical location types.
  // Address = new google.maps.places.Autocomplete(
      // document.getElementById('Address'), {types: ['geocode']});

  // // Avoid paying for data that you don't need by restricting the set of
  // // place fields that are returned to just the address components.
  // Address.setFields(['address_component']);

  // // When the user selects an address from the drop-down, populate the
  // // address fields in the form.
  // Address.addListener('place_changed', fillInAddress);
// }

// function fillInAddress() {
  // // Get the place details from the autocomplete object.

  // var place = Address.getPlace();

  // for (var component in componentForm) {
    // //document.getElementById(component).value = '';
    // //document.getElementById(component).disabled = false;
  // }

  // // Get each component of the address from the place details,
  // // and then fill-in the corresponding field on the form.
  // for (var i = 0; i < place.address_components.length; i++) {
    // var addressType = place.address_components[i].types[0];
    // if (componentForm[addressType]) {
      // var val = place.address_components[i][componentForm[addressType]];
    // //  document.getElementById(addressType).value = val;
    // }
  // }

  
// }