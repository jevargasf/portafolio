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
       const medalla = document.getElementById("medalla"); 

       boton.addEventListener('click', () => {
   //Número producto en lista
           contador++;
           selecCantidades[a] += 1;
   // Nueva fila 
           const cuerpoCarrito = document.getElementById("cuerpoCarrito"); 
           const filaNuevoProducto = document.createElement("tr");
           cuerpoCarrito.appendChild(filaNuevoProducto);

   //Agrega producto a offcanvas
           if (selecCantidades[a] === 1) {
            agregaProducto(selecCantidades[a], precioSumable);
               filaNuevoProducto.innerHTML += ` 
               <td>${descripcion}</td>
               <td class="cantidades p-auto" id="cantidadProducto${a}">${selecCantidades[a]}</td>
               <td><button type="button" class="btn btn-danger botonQuitar p-1" id="Q${a}">-</button>
               <button type="button" class="btn btn-info p-1 botonAgregar" id="A${a}" value="1">+</button></td>
               <td id="totalProducto${a}">${precioSumable}</td>
               `;   
                
                boton.disabled = true;

                footerTotal.innerHTML = `
                <tr>
                <td>Total</td>
                <td>${sumaCantidades(arrMonto)}</td>
                <td></td>
                <td>${sumaTotal(arrMonto)}</td>
                </tr>
                `;
                medalla.innerHTML = `
                <span class="material-symbols-outlined">shopping_cart</span>${sumaCantidades(arrMonto)}
                `;
            }

           /* <tr>
            <td colspan="4">
            <label for="formControlInput" class="form-label"></label>
            <input type="email" class="form-control" id="formControlInput" placeholder="Ingresa código descuento">
            </td>
            </tr>*/

//Botón restar cantidad y quitar producto en offcanvas
document.getElementById("Q"+a).addEventListener('click', () => {
    selecCantidades[a]--;
    quitaProducto(selecCantidades[a], precioSumable);
    document.getElementById("cantidadProducto"+a).innerHTML = selecCantidades[a];
    document.getElementById("totalProducto"+a).innerHTML = selecCantidades[a]*precioSumable;
    footerTotal.innerHTML = `
    <td>Total</td>
    <td>${sumaCantidades(arrMonto)}</td>
    <td></td>
    <td>${sumaTotal(arrMonto)}</td>
    `;
    medalla.innerHTML = `
    <span class="material-symbols-outlined">shopping_cart</span>${sumaCantidades(arrMonto)}
    `;

        if (selecCantidades[a] === 0) {
            filaNuevoProducto.remove()
            boton.disabled = false
             }
        if (arrMonto.length === 0) {
                footerTotal.innerHTML = `
                <td colspan="4">Tu carrito está vacío.</td>
                `;
                medalla.innerHTML = `
                <span class="material-symbols-outlined">shopping_cart</span>
                `;
            }

        }
);
       
// Boton sumar +1 cantidad offcanvas

        document.getElementById("A"+a).addEventListener('click', () => {
            selecCantidades[a]++;  
            sumaProducto(selecCantidades[a], precioSumable);
            document.getElementById("cantidadProducto"+a).innerHTML = selecCantidades[a];
            document.getElementById("totalProducto"+a).innerHTML = selecCantidades[a]*precioSumable;
            footerTotal.innerHTML = `
            <td>Total</td>
            <td>${sumaCantidades(arrMonto)}</td>
            <td></td>
            <td>${sumaTotal(arrMonto)}</td>
            `;
            medalla.innerHTML = `
            <span class="material-symbols-outlined">shopping_cart</span>${sumaCantidades(arrMonto)}
            `;
 });
    });

    //Operaciones de manipulación arreglo carrito
    function agregaProducto (cantidad, precio) {
        if (arrMonto.some(fila => fila.includes(precio)) === false) {  
            let arrProducto = [];
            arrProducto.push(cantidad, precio);
            arrMonto.push(arrProducto);
        }
    };
    function quitaProducto (cantidad, precio) {
        for(i=0; i < arrMonto.length; i++) {
            if (arrMonto[i][1] === precio ) {
                arrMonto[i][0] = cantidad;
                if (arrMonto[i][0] === 0) {
                    arrMonto.splice(i, 1);
                }
            }
        }
    }
    function sumaProducto (cantidad, precio) {
        for(i=0; i < arrMonto.length; i++) {
            if (arrMonto[i][1] === precio ) {
                arrMonto[i][0] = cantidad;
            }
        }
    };


//Suma cantidad de productos total
    function sumaCantidades (arr) {
        let cantidades = [];
        for (i=0; i < arr.length; i++) {
            cantidades.push(arr[i][0]);
        }
        let sumaCantidades = cantidades.reduce((a,b) => a+b, 0);
        return sumaCantidades;
    }
    
    function sumaTotal (arr) {
        let sumaParcial = [];
        for (i=0; i < arr.length; i++) {
            let parcialProducto = arr[i][0]*arr[i][1];
            sumaParcial.push(parcialProducto);
        }
        let sumaProductos = sumaParcial.reduce((a,b) => a+b, 0);
        return sumaProductos;
    }
};
