function agregarAlCarrito(nombre, precio) {   //de acuerdo al producto contenga nombre y precio se agregue al carrito
    var datosProducto = {
        nombre: nombre,
        precio: precio
    };

    fetch('cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datosProducto)
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error('Error en la respuesta del servidor');
    })
    .then(data => {
        alert(data.message); // Mensaje del servidor
    })
    .catch(error => {
        console.error('Error al agregar producto al carrito:', error);
    });
}
