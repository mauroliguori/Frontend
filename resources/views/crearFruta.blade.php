<h1>Crear una fruta ;) ;) </h1>

<form action="/crearFruta" method="post">
    @csrf
    Nombre: <input type="text" name="nombre" id=""> <br>
    Tipo: <input type="text" name="tipo" id=""> <br>
    Gramos: <input type="number" name="gramos" id=""> <br>
    Precio: <input type="number" name="precio" id=""> <br>
    <input type="submit" value="Enviar">
</form>