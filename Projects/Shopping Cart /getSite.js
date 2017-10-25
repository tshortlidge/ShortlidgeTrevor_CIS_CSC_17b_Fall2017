/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


       //Heres the javascript for Cart!
            

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
                   totalCost();
                   
             
                   
                   return;
               }
           }
               var item = new Item(name,price,quantity);
               cart.push(item);
               saveCart();
               totalCost();
              
               
           }


          function removeItemFromCart(name){
              for(var i in cart){
                  if(cart[i].name === name){
                      cart[i].quantity --;
                      if(cart[i].count === 0){
                          cart.splice(i,1);
                      }
                      break;
                  }
              } saveCart();
              totalCost();
          }
          
          function removeItemFromCartAll(name){
              for(var i in cart){
                  
                  if(cart[i].name === name){
                      cart.splice(i,1);
                  }
                  
                  
              } saveCart();
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
              alert("You have entered a new item into your cart. Total Cost is $ " +totalCost.toFixed(2));

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
          
          
          document.write("List of Cart in JSON- : " +str,"</br>","Total Cost: $ ",+totalPrice.toFixed(2));


            
      //        var cartCopy = [];
      //        for(var i in cart){
                  
 //                 var item = cart[i];
  //                var itemCopy = {};
  //                for (var p in item){
  //                    itemCopy[p] = item[p];
  //                }
  //                cartCopy.push(itemCopy);
   //           }
    //          for (var c in item){
                  
              
     //         document.write("Item: " +cart[c]);
     //     }
     //         return cartCopy;
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
          
          
        
 