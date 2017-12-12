       //Heres the javascript for Cart
            var cart = [];
            //name price quantity
           function Item(name, price, quantity){
               this.name = name;
               this.price = price;
               this.quantity = quantity;

           }
 //          var money = 0.00;
           function addItemToCart(name,price,quantity){

               for(var i in cart ){
                   if(cart[i].name === name){
                       cart[i].quantity += quantity;

                   saveCart();




                   return;
               }
           }
               var item = new Item(name,price,quantity);
               cart.push(item);
               saveCart();



           }

           function callCart(name,price,quantity){

              totalCost();

           }


          function removeItemFromCart(name){
              for(var i in cart){


                  if(cart[i].name === name){
                    cart[i].quantity --;
                    if(cart[i].quantity === 0){

                        cart.splice(i,1);
                   }
                   break;
                  }


          }
            saveCart();
        }

          function removeItemFromCartAll(name){
              for(var i in cart){

                  if(cart[i].name === name){
                      cart.splice(i,1);
                  }


              } saveCart();
          }
          function editCart(name,newVar){

                       for(var i in cart){


                            if(cart[i].name === name){
                              cart[i].quantity == newVar;
                              if(cart[i].quantity === 0){

                                  cart.splice(i,1);
                             }
                             break;
                            }


                    }
                      saveCart();
                  }

          function clearCart(){
              cart = [];
              saveCart();
          }

          function countCart(){
              var  totQuant = 0;
              for(var i in cart){
                  totQuant += cart[i].count;
              }
              return totQuant;
          }

          function totalCost(){// need to implement quantity of that item. its only spitting out 1 of each
              var totalCost = 0;

              for(var i in cart){
                  totalCost += cart[i].price * cart[i].quantity;

              }
              alert("Total Cost is $ " +totalCost.toFixed(2));

              return totalCost;
          }



          function listCart(){

             for (var i in cart){
                 var item = cart[i];

          }
              var totalPrice = 0;

              for(var i in cart){
                  totalPrice += cart[i].price * cart[i].quantity;

              }





          str = JSON.stringify(cart);







                    document.write("<br/> Item"," Quantity ","Price <br/>");
                    document.write("------------------------");

             for(var i in cart){


                  //  document.write("<br/>" +cart[i].name,"  $", +cart[i].price, "  ", +cart[i].quantity);
                    document.write("<table>");
                    document.write("<tr><td>" +cart[i].name," ", +cart[i].quantity,  "  ","  $", +cart[i].price, "</td></tr>");
                  //document.write('<button onclick="removeItemFromCart("cart[i].name"),window.location.reload()">Remove Item</button>');

                    document.write("</table>");

         }
         document.write("------------------------");
         document.write("<br/>Total Cost: $ ",+totalPrice.toFixed(2));
        // document.write("<br/>List of Cart in JSON- : " +str,"</br>");



          }


        



           function saveCart(){

               localStorage.setItem("shoppingCart",JSON.stringify(cart));

           }



          function loadCart(){
              cart = JSON.parse(localStorage.getItem("shoppingCart"));
              if (cart === null){

                  cart = [];
              }

          }





          //  var array = listCart();
          //  console.log(array);
          loadCart();
  //        alert("Total Price: " + totalCost());

          console.log(cart);
