<h1>Frutas ;) ;) </h1>


<a href="/crearFruta">Crear Fruta</a> <br><br>

@if(session("fruta"))
    Fruta <b>"{{ session("fruta")['nombre'] }}"</b> creada. <br>
@endif
@if(session("eliminado"))
    Fruta {{ session("eliminado") }} eliminada. <br><br>
@endif

<table>
    <tr>
        <th>
            ID
        </th>
        <th>
            Nombre
        </th>
        <th>
            Tipo
        </th>
    </tr>
@foreach($frutas as $f)
    <tr>
        <td>
            <a href="/fruta/{{ $f['id'] }}">{{ $f['id'] }}</a> 
        </td>
        <td>
            {{ Str::title($f['nombre'])}}
        </td>
        <td>
            {{ $f['tipo']}}
        </td>
        <td>
            <a href="/eliminarFruta/{{ $f['id'] }}">Eliminar</a>
        </td>
    </tr>
@endforeach
</table>