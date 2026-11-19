
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de tienda</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 30px;
        }

        .contenedor {
            width: 450px;
            margin: 30px auto;
            background-color: white;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
        }

        a {
            display: block;
            margin-bottom: 20px;
            color: #237a42;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        label {
            display: block;
            margin-top: 12px;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 9px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #237a42;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 11px;
            background-color: #237a42;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background-color: #195c31;
        }
    </style>
</head>

<body>

    <div class="contenedor">

        <h1>Alta de tienda Mercadona</h1>

        <a href="index.php">Volver al listado</a>

        <form action="store.php" method="post">

            <label for="direccion">Dirección</label>
            <input type="text"
                   name="direccion"
                   id="direccion"
                   placeholder="Ej.: Calle Recogidas, 45"
                   required
                   maxlength="150">

            <label for="localidad">Localidad</label>
            <input type="text"
                   name="localidad"
                   id="localidad"
                   placeholder="Ej.: Granada"
                   required
                   maxlength="100">

            <label for="fecha_apertura">Fecha de apertura</label>
            <input type="date"
                   name="fecha_apertura"
                   id="fecha_apertura"
                   required>

            <label for="encargado">Encargado</label>
            <input type="text"
                   name="encargado"
                   id="encargado"
                   placeholder="Nombre del encargado"
                   required
                   maxlength="150">

            <label for="telefono">Teléfono</label>
            <input type="text"
                   name="telefono"
                   id="telefono"
                   placeholder="Ej.: 958123456"
                   maxlength="12">

            <label for="ingreso_anual">Ingreso anual</label>
            <input type="number"
                   name="ingreso_anual"
                   id="ingreso_anual"
                   value="0"
                   placeholder="Ej.: 1250000.500"
                   min="0"
                   max="9999999.999"
                   step="0.001">

            <button type="submit">Alta de la tienda</button>

        </form>

    </div>

</body>
</html>
