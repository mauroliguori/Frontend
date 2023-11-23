<h1>Tareas </h1>


<a href="/tareas">Crear Tareas</a> <br><br>

@if(session("fruta"))
    Fruta <b>"{{ session("fruta")['nombre'] }}"</b> creada. <br>
@endif
@if(session("eliminado"))
    Fruta {{ session("eliminado") }} eliminada. <br><br>
@endif

<table>
    <tr>
        <th>
            ID de Tarea
        </th>
        <th>
            Titulo
        </th>
        <th>
            ID de Autor
        </th>
        <th>
            ID de Usuario Seleccionado
        </th>
        <th>
            Descripcion
        </th>
        <th>
            Fecha Limite
        </th>
    </tr>
@foreach($tareas as $t)
    <tr>
        <td>
            <a href="/tareas/{{ $t['id'] }}">{{ $t['id'] }}</a> 
        </td>
        <td>
            {{ $t['titulo']}}
        </td>
        <td>
            {{ $t['id_de_autor']}}
        </td>
        <td>
            {{ $t['id_de_usuario_seleccionado']}}
        </td>
        <td>
            {{ $t['descripcion']}}
        </td>
        <td>
            {{ $t['fecha_limite']}}
        </td>
        <td>
            <a href="/eliminarTareas/{{ $t['id'] }}">Eliminar</a>
        </td>
    </tr>
@endforeach
</table>