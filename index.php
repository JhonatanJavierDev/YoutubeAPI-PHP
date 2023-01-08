<!-- Coding by Jhon -->
<form method="post">
  <label for="titulo">Escribe un título:</label><br>
  <input type="text" id="titulo" name="titulo"><br>
  <input type="submit" value="Buscar en YouTube">
</form>

<?php
// Chequeamos el envio del formulario
if (isset($_POST["titulo"])) {
  // En esta variable almacenamos el titulo del video
  $titulo = $_POST["titulo"];

  // Realizamos la busqueda usando nuestra API de Youtube
  $api_key = "TU_API";
  $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=" . urlencode($titulo) . "&type=video&key=" . $api_key;
  $data = json_decode(file_get_contents($url), true);

  // Mostramos solo los primeros 6 resultados
  $resultados = array_slice($data["items"], 0, 6);

  // Hacemos un chequeo de resultados y mostramos un enlace para cada uno
  foreach ($resultados as $resultado) {
    $titulo = $resultado["snippet"]["title"];
    $video_id = $resultado["id"]["videoId"];
    echo "<a href='#' onclick='reproducirAudio(\"$video_id\")'>$titulo</a><br>";
  }

  // Hacemos la inclusión del javascript, para reproducir como audio
  echo "<script>
    function reproducirAudio(videoId) {
      var audio = new Audio('https://www.youtube.com/watch?v=' + videoId);
      audio.play();
    }
  </script>";
}
?>
