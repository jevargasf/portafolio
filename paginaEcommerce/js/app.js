//Recuperar info producto del DOM
const botonAgregar = document.getElementsByClassName("botonAgregar");

//Contador de lista productos
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
       const descripcion = document.querySelector("#producto"+a).innerHTML;
       const precio = document.querySelector("#precio"+a).innerHTML;
       const precioSumable = Number(precio.replace(/[^\d,]/g,""));
       const footerTotal = document.getElementById("totalCarrito");

       //Suma monto final
       let montoFinal = arrMonto.reduce((a,b) => a+b, 0);

       boton.addEventListener('click', () => {
   //Número producto en lista
           contador++;
           selecCantidades[a] += 1; //aquí ya almacenó +1
   // Nueva fila 
           const cuerpoCarrito = document.getElementById("cuerpoCarrito"); 
           const filaNuevoProducto = document.createElement("tr");
           cuerpoCarrito.appendChild(filaNuevoProducto);

   //Agrega producto a offcanvas
           if (selecCantidades[a] === 1) {
            infoProductos(selecCantidades[a], precioSumable);
            console.log(arrMonto, 'agrega producto');
               filaNuevoProducto.innerHTML += ` 
               <td>${descripcion}</td>
               <td class="cantidades p-auto" id="cantidadProducto${a}">${selecCantidades[a]}</td>
               <td><button type="button" class="btn btn-danger botonQuitar p-1" id="Q${a}">-</button>
               <button type="button" class="btn btn-info p-1 botonAgregar" id="A${a}" value="1">+</button></td>
               <td id="totalProducto${a}">${precioSumable}</td>
               `;   
                
                boton.disabled = true;

                footerTotal.innerHTML = `
                <td>Total</td>
                <td>${selecCantidades[a]}</td>
                <td></td>
                <td>${precioSumable}</td>
                `;
            }


//Botón restar cantidad y quitar producto en offcanvas
document.getElementById("Q"+a).addEventListener('click', () => {
    selecCantidades[a]--;
    infoProductos(selecCantidades[a], precioSumable);
    console.log(arrMonto, 'quita producto');
    document.getElementById("cantidadProducto"+a).innerHTML = selecCantidades[a];
    document.getElementById("totalProducto"+a).innerHTML = selecCantidades[a]*precioSumable;
        if (selecCantidades[a] === 0) {
            filaNuevoProducto.remove()
            boton.disabled = false
            footerTotal.innerHTML = `
            <td colspan="4">Tu carrito está vacío.</td>
            `;
        }
})
       
// Boton sumar +1 cantidad offcanvas

        document.getElementById("A"+a).addEventListener('click', () => {
            selecCantidades[a]++;  
            infoProductos(selecCantidades[a], precioSumable);
            console.log(arrMonto, 'suma producto');
            document.getElementById("cantidadProducto"+a).innerHTML = selecCantidades[a];
            document.getElementById("totalProducto"+a).innerHTML = selecCantidades[a]*precioSumable;
 });
    });

    //Función arreglo productos para suma monto final
    function infoProductos (cantidad, precio) {
        if (arrMonto.some(fila => fila.includes(precio)) === false) {  
            let arrProducto = [];
            arrProducto.push(cantidad, precio);
            arrMonto.push(arrProducto);
        } else {
            for(i=0; i < arrMonto.length; i++) {
                if (cantidad === 0) {
                    arrMonto.splice(i, 1);
                } else if (arrMonto[i][1] === precio ) {
                    arrMonto[i][0] = cantidad;
                }
            }
        }
    }

/*function buscaProducto (arr, precio) {
    if(arr.some(fila => fila.includes(precio)) === true) {
        console.log(arr.indexOf(precio));
    }
    return arr.indexOf(precio);
}*/

//Suma cantidad de productos total
       for (const i of document.getElementsByClassName("cantidades")) {
        console.log(i)
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
};


   
   //Medalla carrito (cantidad total productos)
