// Validar el cuadro de búsqueda
function validarBusqueda() {
    // Obtener el valor del cuadro de texto
    var texto = document.querySelector(".search input[type='text']").value;
    // Si el texto está vacío o es muy corto, mostrar un mensaje de alerta y cancelar el envío del formulario
    if (texto == "" || texto.length < 3) {
        alert("Por favor, ingrese un texto válido para buscar productos.");
        return false;
    }
    // Si el texto es válido, enviar el formulario
    return true;
}
// Mostrar un mensaje de bienvenida al iniciar sesión
function mostrarBienvenida() {
    // Obtener el nombre del usuario que inició sesión
   var nombre = localStorage.getItem("nombre");
    // Si el nombre existe, mostrar un mensaje de bienvenida en la sección de iniciar sesión
    if (nombre) {
    var login = document.querySelector(".login");
        login.innerHTML = "Bienvenido, " + nombre;
    }
}
function showLoginOptions() {
    var loginOptions = document.getElementById("login-options");
    if (loginOptions.style.display == "none") {
      loginOptions.style.display = "block";
    } else {
      loginOptions.style.display = "none";
    }
  }
// Actualizar el número de productos en el carrito de compras
function actualizarCarrito() {
    // Obtener el número de productos que hay en el carrito de compras
    var numero = localStorage.getItem("numero");
    // Si el número existe y es mayor que cero, mostrarlo en la sección del carrito de compras
    if (numero && numero > 0) {
        var cart = document.querySelector(".cart");
        cart.innerHTML = "<img src='cart.png' alt='Carrito de compras'> (" + numero + ")";
    }
}

// Evento al formulario de búsqueda para validar el cuadro de texto antes de enviarlo
document.querySelector(".search form").addEventListener("submit", validarBusqueda);

// Segunda sección productos //
// Función para agregar los productos al carrito de compras
function agregarProducto(event) {
    // Obtener el nombre y el precio del producto que se quiere agregar
    var producto = event.target.parentElement;
    var nombre = producto.querySelector("h3").textContent;
    var precio = producto.querySelector("p").textContent;
    // Obtener el número de productos que hay en el carrito de compras
    var numero = localStorage.getItem("numero");
    // Si el número no existe, inicializarlo a cero
    if (!numero) {
        numero = 0;
    }
    // Incrementar el número de productos en el carrito de compras
    numero++;
    // Guardar el número de productos en el almacenamiento local
    localStorage.setItem("numero", numero);
    // Obtener el total de dinero que hay en el carrito de compras
    var total = localStorage.getItem("total");
    // Inicializar a 0, si el total no existe
    if (!total) {
        total = 0;
    }
    // Sumar los precios de los productos del carrito en total
    total = parseFloat(total) + parseFloat(precio);
    // Guardar el total de dinero en el almacenamiento local
    localStorage.setItem("total", total);
    // Confirmación al cliente o usuario
    alert("Has agregado el producto " + nombre + " al carrito de compras. Ahora tienes " + numero + " productos en el carrito, y el total a pagar es $" + total + ".");
}
// Evento al agregar un producto al carrito de compras
var botones = document.querySelectorAll(".product button");
for (var i = 0; i < botones.length; i++) {
    botones[i].addEventListener("click", agregarProducto);
}
