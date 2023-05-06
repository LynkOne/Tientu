class VistaUsuarios {
  public function mostrarUsuarios($usuarios) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Correo electrónico</th></tr>";
    foreach ($usuarios as $usuario) {
      echo "<tr>";
      echo "<td>" . $usuario['id_usuario'] . "</td>";
      echo "<td>" . $usuario['nombre_usuario'] . "</td>";
      echo "<td>" . $usuario['correo_electronico'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
}
