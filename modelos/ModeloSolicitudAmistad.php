<?php

class ModeloSolicitudAmistad
{
    private $id;
    private $usuarioEmisor;
    private $usuarioReceptor;
    private $fechaEnvio;

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    /*public function __construct($id, $usuarioEmisor, $usuarioReceptor, $fechaEnvio)
    {
        $this->id = $id;
        $this->usuarioEmisor = $usuarioEmisor;
        $this->usuarioReceptor = $usuarioReceptor;
        $this->fechaEnvio = $fechaEnvio;
    }*/

    public function contarSolicitudesPendientes($idUsuario) {
        $query = "SELECT COUNT(*) FROM solicitudes_amistad WHERE id_usuario_recibe = $idUsuario";
        $resultado = mysqli_query($this->conexion, $query);
        if ($resultado) {
            $fila = mysqli_fetch_array($resultado);
            return $fila[0];
        } else {
            return 0;
        }
    }
    

    public function getId()
    {
        return $this->id;
    }

    public function getUsuarioEmisor()
    {
        return $this->usuarioEmisor;
    }

    public function getUsuarioReceptor()
    {
        return $this->usuarioReceptor;
    }

    public function getFechaEnvio()
    {
        return $this->fechaEnvio;
    }
}
?>