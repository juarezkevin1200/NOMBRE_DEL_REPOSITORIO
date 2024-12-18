if (window.location.pathname === '/pedidos'){
    document.getElementById('comprar-btn').addEventListener('click', async () => {
        const mensaje = document.getElementById('mensaje');
        mensaje.textContent = 'Creando orden...';
    
        try {
            const response = await fetch(`${location.origin}/pedidos/agregar-orden`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ total: 100 }) // Ejemplo de total a pagar
            });
    
            const data = await response.json();
    
            if (data.success) {
                mensaje.textContent = 'Redirigiendo a PayPal...';
                window.location.href = data.linkPago; // Redirige al enlace de pago
            } else {
                mensaje.textContent = 'Error al crear la orden: ' + data.message;
            }
        } catch (error) {
            mensaje.textContent = 'Error inesperado: ' + error.message;
        }
    });
}