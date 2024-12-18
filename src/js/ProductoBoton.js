import Swal from 'sweetalert2'
document.addEventListener('DOMContentLoaded', () => {
    // Verifica si estás en la página /productos
    if (window.location.pathname === '/productos') {
        const botonesAgregar = document.querySelectorAll('.boton');
        botonesAgregar.forEach(boton => {
            boton.addEventListener('click', (event) => {
                // Prevenir el comportamiento predeterminado del botón
                event.preventDefault();

                // Obtener el ID del producto desde el atributo data-id
                const productoId = boton.dataset.id;

                console.log(`ID del producto: ${productoId}`); // Para testear en consola

                // Enviar datos al servidor con Fetch API apuntando al endpoint
                fetch(`${location.origin}/productos/agregar-carrito`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ producto_id: productoId, cantidad: 1 })
                })
                .then(response => {
                    if (!response.ok) {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Error en la respuesta del servidor",
                          });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Respuesta del servidor:', data); // Log de la respuesta

                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Éxito",
                            text: "Producto añadido al carrito.",
                          });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Error al añadir el producto.",
                          });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Error inesperado.",
                      });
                });
            });
        });
    }
});
