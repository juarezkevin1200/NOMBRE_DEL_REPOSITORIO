import Swal from 'sweetalert2'
(function(){
    
    try {
        //Peticion hacia la API
        const url = `${location.origin}/api/citas`;
    
        const respuesta = await fetch(url, {
          method: "POST",
          body: datos,
        });
    
        const resultado = await respuesta.json();
        if (resultado.resultado) {
          Swal.fire({
            icon: "success",
            title: "Cita creada",
            text: "Tu cita fue creada correctamente",
            button: "OK",
          }).then(() => {
            setTimeout(() => {
              window.location.reload();
            }, 3000);
          });
        }
        console.log(resultado.resultado);
        //console.log([...datos]);
      } catch (error) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un error al guardar una cita",
        });
      }
})();
