<?php

//require_once "modelos/SolicitudAmistad.php";
//require_once "models/Usuario.php";

class ControladorSolicitudAmistad {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function contarSolicitudesPendientes() {
        $modeloSolicitud = new ModeloSolicitudAmistad($this->conexion);
        $idUsuario = $_SESSION["id_usuario"];

        $contador = $modeloSolicitud->contarSolicitudesPendientes($idUsuario);
        
        return $contador;
    }

    public function enviarSolicitud($idUsuarioEmisor, $idUsuarioReceptor) {
        $solicitud = new SolicitudAmistad();
        $solicitud->setIdUsuarioEmisor($idUsuarioEmisor);
        $solicitud->setIdUsuarioReceptor($idUsuarioReceptor);
        $solicitud->setEstado("enviada");
        $solicitud->guardar();
    }

    public function aceptarSolicitud($idSolicitud) {
        $solicitud = SolicitudAmistad::obtenerPorId($idSolicitud);
        $solicitud->setEstado("aceptada");
        $solicitud->guardar();

        $idUsuarioEmisor = $solicitud->getIdUsuarioEmisor();
        $idUsuarioReceptor = $solicitud->getIdUsuarioReceptor();

        $usuarioEmisor = Usuario::obtenerPorId($idUsuarioEmisor);
        $usuarioReceptor = Usuario::obtenerPorId($idUsuarioReceptor);

        $usuarioEmisor->agregarAmigo($idUsuarioReceptor);
        $usuarioReceptor->agregarAmigo($idUsuarioEmisor);
    }

    public function rechazarSolicitud($idSolicitud) {
        $solicitud = SolicitudAmistad::obtenerPorId($idSolicitud);
        $solicitud->setEstado("rechazada");
        $solicitud->guardar();
    }

    public function obtenerSolicitudesRecibidas($idUsuario) {
        $solicitudes = SolicitudAmistad::obtenerPorIdUsuarioReceptor($idUsuario);
        return $solicitudes;
    }

    public function obtenerSolicitudesEnviadas($idUsuario) {
        $solicitudes = SolicitudAmistad::obtenerPorIdUsuarioEmisor($idUsuario);
        return $solicitudes;
    }

}
