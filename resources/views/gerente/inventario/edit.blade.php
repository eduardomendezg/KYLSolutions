<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creando</title>
</head>
<body>
    <h1>Creando Producto</h1>
    <form action="{{ route('gerente.inventario.update', $producto->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{$producto->nombre}}">
        <br><br>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="{{$producto->stock}}">
        <br><br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" value="{{$producto->precio}}">
        <br><br>
        <button type="submit">Actualizar Producto</button>
    </form>
</body>
</html>
