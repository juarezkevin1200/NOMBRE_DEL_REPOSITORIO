pasos para correr el proyecto:
<p>1.Descargar el servicio de mysql e importar la bd que está en la carpeta sql</p>
<p>2.crear el archivo .env con las variables de entorno </p>
<p>3.Instalar composer, node js, php.</p>
<p>4.En la carpeta principal del proyecto ejecutar los siguientes comandos:
"npm install" "composer install"</p>
<p>5.Una vez instalados los modulos ejecutar el siguiente comando:
"npm run dev", crea una carpeta build que está en la carpeta public:
esto hace que sea más eficiente el proyecto al momento de ejecutarse en un servidor.</p>
<p>6. ejecutar "cd public"</p>
<p>7. ejecutar "php -S localhost:3000" esto para ejecutarlo en forma de prueba, si lo quieres ejecutar 
en producción se necesita de agregar toda la ruta del proyecto en el servidor web como xammp o nginx, etc.</p>

