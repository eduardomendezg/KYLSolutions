<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creando</title>
</head>
<body>
    <h1>Creando Producto</h1>
    <form action="/gerente/inventario/inventario" method="post">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        <br><br>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock">
        <br><br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01">
        <br><br>
        <button type="submit">Crear Producto</button>
    </form>
</body>
</html>
