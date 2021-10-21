function purchasedItem() {
  // set div to be displayed
  var mydiv = "";

  // price total
  var total = 0;

  // get quantity of product
  var quantity = sessionStorage.getItem(sessionStorage.key(0));

  // go through each element and display
  var splitCategories = sessionStorage.key(0).split(",");
  mydiv += "<img src=\"" + splitCategories[1] + "\" style=\"display: block; height: 100%\" />";
  mydiv += "<h1>" + splitCategories[2] + "</h1>";
  mydiv += "<h4>Quantity: " + quantity + "</h4>";
  mydiv += "<h4>Price: " + splitCategories[3] + "</h4>";

  // calculate total price
  total += parseInt(splitCategories[3]) * quantity;

  mydiv += "<h4>Total: " + total + "</h4>";

  // make changes to div that has id cart
  document.getElementById("cart").innerHTML = mydiv;
}

var req;

function process() {
  // create request 
  req = new XMLHttpRequest();

  // set data to be sent to processBuy.php
  var element;
  var product;
  var data = "";

  // get quantity of product
  var quantity = sessionStorage.getItem(sessionStorage.key(0));

  // get item_no of product
  var splitCategories = sessionStorage.key(0).split(",");

  // get product data
  product = splitCategories[0] + "," + quantity;

  // set the key/value pairs for the post
  data += "product=" + product;

  // get customer data
  for (var i = 0; i < document.forms.length; i++) {
    for (var j = 0; j < document.forms[i].elements.length; j++) {
      element = document.forms[i].elements[j];

      // ignore reset, radio button
      if (!(element.type == "radio") && !(element.type == "button") && !(element.type == "reset")) {
        if (element.type == "checkbox")
          data += ("&" + element.name + "=" + element.checked)
        else
          data += ("&" + element.name + "=" + element.value);
      }
    }
  }

  // Set the Post Request
  req.open('POST', 'http://localhost/processBuy.php?XDEBUG_SESSION_START=test', true);

  //Set the header for POST
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.setRequestHeader("Content-length", data.length);


  req.onreadystatechange = success;

  //Send the request    
  req.send(data); // send the request

}

function success() {
  if (req.readyState == 4) // Checks the equality checks the datatype
  {
    if (req.status == 200) {
      sessionStorage.removeItem(sessionStorage.key(0));


      alert(req.responseText);
    }
  }
}