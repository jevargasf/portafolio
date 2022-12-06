//Recuperar info producto del DOM
const botonAgregar = document.getElementsByClassName("botonAgregar");

//Contador de clicks
let contador = 0;
let arrBoton = [];
let cantidadProducto = 0;
let total = 0;
let cantidadTotal = 0;
let arr = [];
let arrMonto = [];

for (const boton of botonAgregar) {
    boton.addEventListener('click', () => {
//Número producto en lista
        contador ++;
// Nueva fila producto
        const cuerpoCarrito = document.getElementById("cuerpoCarrito"); 
        const filaNuevoProducto = document.createElement("tr");
        cuerpoCarrito.appendChild(filaNuevoProducto);
//Acceder info productos
        let a = boton.id;
        const descripcion = document.querySelector("#producto"+a).innerHTML;
        const precio = document.querySelector("#precio"+a).innerHTML;
        const precioSumable = Number(precio.replace(/[^\d,]/g,""));
        let cantidadProducto = boton.value++;
        const footerTotal = document.getElementById("totalCarrito");
//Agrega producto
        if (cuerpoCarrito.innerHTML.includes(descripcion)) {
            document.getElementById("cantidadProducto"+a).innerHTML = cantidadProducto;
            let totalProducto = precioSumable*cantidadProducto;
            document.getElementById("totalProducto"+a).innerHTML = totalProducto;
          /*  console.log(totalProducto);
            footerTotal.innerHTML =`
            <td colspan="2"></td>
            <td>${cantidadProducto}</td>
            <td>${totalProducto}</td>
            ` */
        } else {
            let totalProducto = precioSumable*cantidadProducto;
            filaNuevoProducto.innerHTML += `
            <td>${contador}</td>
            <td>${descripcion}</td>
            <td class="cantidades" id="cantidadProducto${a}">${cantidadProducto}</td>
            <td id="totalProducto${a}">${totalProducto}</td>
            `;
        }
        let arr = []; 
//Suma monto final
        arrMonto.push(precioSumable);
        let montoFinal = arrMonto.reduce((a,b) => a+b, 0);

//Suma cantidad de productos total
        for (const i of document.getElementsByClassName("cantidades")) {
            let conteoProductos =+ i.innerHTML;
            arr.push(conteoProductos);
            let total = arr.reduce((a,b) => a+b, 0);
            footerTotal.innerHTML =`
            <td colspan="2"></td>
            <td>${total}</td>
            <td>${montoFinal}</td>
            `;
        }
//Suma de monto total


  /*      function total (a) {
            if ()
            Number(document.getElementById("cantidadProducto"+a).innerHTML);
        }
        let producto1 = Number(document.getElementById("cantidadProducto1").innerHTML);
        let producto2 = Number(document.getElementById("cantidadProducto2").innerHTML);
        let producto3 = Number(document.getElementById("cantidadProducto3").innerHTML);
        let producto4 = Number(document.getElementById("cantidadProducto4").innerHTML);
        
        let total = producto1 + producto2 + producto3 + producto4;
        if (producto1 === null || producto2 === null || producto3 === null || producto4 === null) {
            true;
         //   producto1 || producto2 || producto3 || producto4 = 0;
        } else {
            console.log(total);
        }*/
     //   console.log(total);
  //      if (arr.includes(boton)) {
  //         console.log(cantidadProducto);
//
  //      } else {
  //          arr.push(boton);
  //          console.log(true);
    //    }
 //  console.log(document.getElementById("cantidadProducto"+a).innerHTML);
  // if ()
 /* console.log(Number(document.getElementById("cantidadProducto1").innerHTML));
  console.log(Number(document.getElementById("cantidadProducto2").innerHTML));
  console.log(Number(document.getElementById("cantidadProducto3").innerHTML));
  console.log(Number(document.getElementById("cantidadProducto4").innerHTML));*/
    });



//Total productos
/*const cantidades = console.log(document.getElementsByClassName("cantidades"));
for (const cant of cantidades) {
    btn.addEventListener('click', () => {
    console.log(cantidades)})
};*/
/*
for (const boton of botonAgregar) {
boton.addEventListener('click', () => {

        cantidadTotal += cantidadProducto;
    console.log(cantidadTotal);
/*
        let a = boton.id;
    total = Number($(precioSumable));
    cantidadTotal = Number($(cantidadProducto));
        console.log(total);
        console.log(cantidadTotal);
    const totalCarrito = document.getElementById("totalCarrito");
    if (cantidadTotal !== 0) {
        totalCarrito.innerHTML = `
        <td colspan="2"></td>
        <td>${cantidadTotal}</td>
        <td>${total}</td>
        `
    }

})} */
    
};
/*
botonAgregar.addEventListener('click', () => {
    console.log(Number(document.getElementById("cantidadProducto"));
//    cantidadTotal += Number(document.getElementById("cantidadProducto"+boton.id).innerHTML);

    });
/*  
// Intento 2. Añadir escuchadores de evento para cada proceso

/*
// Contador de lista de productos
for (const boton of botonAgregar) {
    boton.addEventListener('click', () => {

    });
}
  
// Desplegar nombre en carrito
for (const boton of botonAgregar) {
    boton.addEventListener('click', () => {
        let a = boton.id;
        const descripcion = document.querySelector("#producto"+a).innerHTML;
        const celdaNombre = filaNuevoProducto.appendChild(document.createElement("td"));
        celdaNombre.textContent = descripcion;
    });
}

// Contador para cantidad de productos 
// Desplegar precio en carrito como número sumable
const producto = Number(document.getElementById("precio2").innerHTML.replace(/[^\d,]/g,""));


// Intento 1. Función arreglo productos / pre-agregar carrito. 
     function agregarCarrito(a) {
        //let producto = [];
        const descripcion = document.querySelector("#producto"+a).innerHTML;
        const precioString = document.querySelector("#precio"+a).innerHTML.replace("/($)|(.)/","");
        console.log(precioString);
       /* for (let i of precioString) {
            console.log(precioString[i]);
            precioString.replace("/($)|(.)/","");
        }
        console.log(precioString);
        /*
        const cuerpoCarrito = document.getElementById("cuerpoCarrito"); 
        const filaNuevoProducto = cuerpoCarrito.appendChild(document.createElement("tr"));
        console.log(precio);
        const celdaPosicion = filaNuevoProducto.appendChild(document.createElement("td"));
        celdaPosicion.textContent = undefined;
        const celdaNombre = filaNuevoProducto.appendChild(document.createElement("td"));
        celdaNombre.textContent = descripcion;
        const celdaCantidad = filaNuevoProducto.appendChild(document.createElement("td"));
        celdaCantidad.textContent = undefined;
        const celdaPrecio = filaNuevoProducto.appendChild(document.createElement("td"));
        celdaPrecio.textContent = precio;

        //producto.push(descripcion,precio);

    }*/
 //   console.log(producto);

    //agregar al carrito
/*
    function carrito (productos) {
        let productosAcumulados = [];
        productosAcumulados.push(productos);
        console.log(productosAcumulados);
        return productosAcumulados;
    }
    /*const botonAgregar = document.getElementById("#botonAgregar");
    console.log(botonAgregar.innerHTML+"recibido");
    function agregarCarrito() {
        botonAgregar.addEventListener("click");
        return console.log("recibí el click");
    }*/

    //funcionalidad botón "Agregar al carrito"--> agrega +1 al carrito
    

    //agregar datos a tabla offcanvas

// Offcanvas boton agregar +1 (hasta stock máximo)

// Función quitar

// Medalla carrito (contador de productos en carro)

// Aplicar descuentos

// Sumar totales