<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paises</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    


<?php
/**
 * Función que procesa el parámetro 'country' proporcionado en la URL.
 *
 * Obtiene información sobre un país desde la API de REST Countries utilizando 
 * el nombre proporcionado como parámetro. Decodifica la respuesta JSON y muestra 
 * información relevante sobre el país, como su capital, región, población, área 
 * y bandera. Si no se encuentra información o ocurre un error, muestra mensajes 
 * descriptivos.
 *
 * @param string $_GET['country'] El nombre del país ingresado como parámetro en la URL.
 * @return void Esta función no devuelve un valor; simplemente genera contenido HTML dinámico.
 */
if (isset($_GET['country'])) {
    $country = htmlspecialchars($_GET['country']);
 
    $url = "https://restcountries.com/v3.1/name/" . urlencode($country);

    /**
     * Realiza la solicitud a la API y obtiene la respuesta en formato JSON.
     * @var false|string $response Respuesta JSON de la API en caso de éxito, o false si ocurre un error.
     */
    $response = file_get_contents($url);

    if ($response) {
        /**
         * Decodifica el JSON obtenido de la API a un array asociativo.
         * @var array $data Array que contiene los datos del país proporcionados por la API.
         */
        $data = json_decode($response, true);

        /**
         * Verifica si la respuesta contiene datos válidos sobre el país.
         */
        if (isset($data[0])) {
            /**
             * Almacena los datos del primer país retornado por la API.
             * @var array $countryData Datos del país obtenidos de la API.
             */
            $countryData = $data[0];
            echo "<h1>Información del País</h1>";
            echo "<div class='result'>";
            echo "<h2>{$countryData['name']['common']}</h2>";
            echo "<p><strong>Capital:</strong> {$countryData['capital'][0]}</p>";
            echo "<p><strong>Región:</strong> {$countryData['region']}</p>";
            echo "<p><strong>Población:</strong> " . number_format($countryData['population']) . "</p>";
            echo "<p><strong>Área:</strong> " . number_format($countryData['area']) . " km<sup>2</sup></p>";
            echo "<img src='{$countryData['flags']['png']}' alt='Bandera de {$countryData['name']['common']}' style='width:200px;'>";
            echo "</div>";
        } else {
            /**
             * Mensaje de error si no se encuentra información sobre el país ingresado.
             */
            echo "<p>No se encontró información sobre el país ingresado.</p>";
        }
    } else {
        /**
         * Mensaje de error si ocurre un problema al conectarse con la API.
         */
        echo "<p>Error al conectar con el API.</p>";
    }
} else {
    /**
     * Mensaje de error si no se proporciona un nombre de país en el parámetro 'country'.
     */
    echo "<p>No se proporcionó un nombre de país.</p>";
}
?>


<br><br>
<a href='index.html'>
    <button>Volver al Inicio</button>
</a>
</body>
</html>
