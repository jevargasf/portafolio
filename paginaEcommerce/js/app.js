//Recuperar info producto del DOM
const botonAgregar = document.getElementsByClassName("botonAgregar");

//Contador de clicks
let contador = 0;
let arrBoton = [];
let cantidadProducto = 0;
let total = 0;
let cantidadTotal = 0;
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
        if (cuerpoCarrito.innerHTML.includes(descripcion)) {
            true;
            document.getElementById("cantidadProducto"+a).innerHTML = cantidadProducto;
            let totalProducto = precioSumable*cantidadProducto;
            document.getElementById("totalProducto"+a).innerHTML = totalProducto;
        } else {
            filaNuevoProducto.innerHTML += `
            <td>${contador}</td>
            <td>${descripcion}</td>
            <td id="cantidadProducto${a}">${cantidadProducto}</td>
            <td class="total" id="totalProducto${a}">${precioSumable}</td>
            `;
        }

//Total productos



//Total
/*const totales = document.getElementsByClassName("total");
for (const a of totales) {
    let totalProducto = a.innerHTML;
    let totalFinal = totalProducto
}



   /*     arrBoton.push(boton.id);
        console.log(arrBoton);
        let contar = 0;
        for (let i of arrBoton) {
            if (boton.id === arrBoton[i]) {
                cantidad++;
                }
            }*/
        
   //     if (descripcion == ) {
     //       cantidad++;
       // }

//Producto repetido
 //       arrBoton.push(boton.id);
   //     for (let i of arrBoton) {
   //         if (arrBoton[i] == boton.id) {
   //             cantidad++;
  //          }
  //      }
    })};
    console.log(document.getElementById("producto1").innerHTML);
  /*  total += Number(document.querySelector("#totalProducto"+a).innerHTML);
    cantidadTotal += Number(document.querySelector("#cantidadProducto"+a).innerHTML);
    const totalCarrito = document.getElementById("totalCarrito");
    if (cantidadTotal !== 0) {
        totalCarrito.innerHTML = `
        <td colspan="2"></td>
        <td>${cantidadTotal}</td>
        <td>${total}</td>
        `
    }
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