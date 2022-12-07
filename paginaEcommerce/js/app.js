//Recuperar info producto del DOM
const botonAgregar = document.getElementsByClassName("botonAgregar");

//Contador de clicks
let contador = 0;

let totalProducto = 0;
let total = 0;
let cantidadTotal = 0;
let arrMonto = [];

let selecCantidades = {
    1:0,
    2:0,
    3:0,
    4:0,
};



for (const boton of botonAgregar) {
       //Acceder info productos
       let a = boton.id;
       let selecProducto = selecCantidades[a];
 //      console.log(a);
       
       const descripcion = document.querySelector("#producto"+a).innerHTML;
       const precio = document.querySelector("#precio"+a).innerHTML;
       const precioSumable = Number(precio.replace(/[^\d,]/g,""));
       const footerTotal = document.getElementById("totalCarrito");

       boton.addEventListener('click', () => {
   //Número producto en lista
  // console.log(boton);

           contador++;
           selecCantidades[a] += 1; //aquí ya almacenó +1
   // Nueva fila 
           const cuerpoCarrito = document.getElementById("cuerpoCarrito"); 
           const filaNuevoProducto = document.createElement("tr");
           cuerpoCarrito.appendChild(filaNuevoProducto);

   //Agrega producto
           if (selecCantidades[a] === 1) { //aquí veo si tengo que agregarlo a la lista o no
             //  console.log(selecCantidades[a]);
               filaNuevoProducto.innerHTML += ` 
               <td>${contador}</td>
               <td>${descripcion}</td>
               <td class="cantidades p-auto" id="cantidadProducto${a}">${selecCantidades[a]}</td>
               <td><button type="button" class="btn btn-danger botonQuitar p-1" id="Q${a}">-</button>
               <button type="button" class="btn btn-info p-1 botonAgregar" id="A${a}" value="1">+</button></td>
               <td id="totalProducto${a}">${totalProducto}</td>
               `;   
                
                boton.disabled = true;
            }


    //Botón quitar offcanvas
document.getElementById("Q"+a).addEventListener('click', () => {
    selecCantidades[a]--;
    document.getElementById("cantidadProducto"+a).innerHTML = selecCantidades[a]; 
        if (selecCantidades[a] === 0) {
            
        }
         //  console.log(selecCantidades[a]);
          // console.log(contador);
     //  if (cantidadProducto < 1) {
      //     console.log(true);
             //  filaNuevoProducto.remove();
          //     footerTotal.innerHTML = `                    
          //     <td colspan="5">Tu carrito está vacío.</td>
          //     `;
          //     contador = 0;
          //     cantidadProducto = 0;
         //  }
   
//       }
})
       
// Boton agregar offcanvas

        document.getElementById("A"+a).addEventListener('click', () => {
            console.log(document.getElementById("A"+a));
            console.log(botonAgregar);
            selecCantidades[a]++;
    
            console.log(selecCantidades);
            document.getElementById("cantidadProducto"+a).innerHTML = selecCantidades[a]; 
 })  
 ;
        
       //Boton quitar
       //const botonQuitar = document.querySelector(".botonQuitar");
       //console.log(botonQuitar);
       //for (const quitar of botonQuitar) {
       //    quitar.addEventListener('click', () => {
       //        console.log(quitar);
           
   // })
   
    });



};
   //Boton Quitar
       //  console.log(document.getElementsByClassName("botonQuitar"));
     //  const botonQuitar = document.querySelector("#1");
     //  for(const botQuitar of botonQuitar) {
    //       botonQuitar.addEventListener('click', () => {
    //           console.log(selecCantidades);
    //           a = btn-danger.id;
    //           selecCantidades[a]--;
   //            contador--;
    //           document.getElementById("cantidadProducto"+a).innerHTML = selecCantidades[a];
              // cantidadProducto--;
              // contador--;
             //  console.log(selecCantidades[a]);
              // console.log(contador);
         //  if (cantidadProducto < 1) {
          //     console.log(true);
             //      filaNuevoProducto.remove();
             //      footerTotal.innerHTML = `                    
             //      <td colspan="5">Tu carrito está vacío.</td>
             //      `;
           //        contador = 0;
            //       cantidadProducto = 0;
           //    }
       
   //  }
    //})
   //}
    
   /*
   //Suma monto final
           arrMonto.push(precioSumable);
           let montoFinal = arrMonto.reduce((a,b) => a+b, 0);
   
   //Suma cantidad de productos total
           for (const i of document.getElementsByClassName("cantidades")) {
               let conteoProductos =+ i.innerHTML;
               arr.push(conteoProductos);
               let cantidadTotal = arr.reduce((a,b) => a+b, 0);
               footerTotal.innerHTML = `
               <td colspan="2"></td>
               <td">${cantidadTotal}</td>
               <td></td>
               <td>${montoFinal}</td>
               `;
           }
   
   
      
       })
   
   //Medalla carrito
   
       
   
   };*/