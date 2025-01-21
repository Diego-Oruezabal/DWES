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
if (isset($_GET['country'])) {
    $country = htmlspecialchars($_GET['country']);
    $url = "https://restcountries.com/v3.1/name/" . urlencode($country);

    // Uso de file_get_contents para obtener datos del API
    $response = file_get_contents($url);

    if ($response) {
        $data = json_decode($response, true);

        if (isset($data[0])) {
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
            echo "<p>No se encontró información sobre el país ingresado.</p>";
        }
    } else {
        echo "<p>Error al conectar con el API.</p>";
    }
} else {
    echo "<p>No se proporcionó un nombre de país.</p>";
}
?>


<br><br>
<a href='index.html'>
    <button>Volver al Inicio</button>
</a>
</body>
</html>
