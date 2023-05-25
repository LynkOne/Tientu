<?php


class ModeloPublicaciones {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPublicaciones() {
        $sql = "SELECT * FROM publicaciones WHERE tipo = 1 ORDER BY fecha_creacion DESC";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPublicacionesUsuario($id_usuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_usuario = ?  AND tipo = 1 ORDER BY fecha_creacion DESC";
        $resultado = $this->conexion->prepare($sql);
        $resultado->bind_param("i", $id_usuario);
        $resultado->execute();
        $resultados = $resultado->get_result();
        return $resultados->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerNovedades($id_usuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_usuario = ? AND fecha_creacion >= (SELECT MAX(DATE(fecha_creacion)) FROM publicaciones WHERE id_usuario = ?) ORDER BY fecha_creacion DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ii", $id_usuario, $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $novedades = array();
        while ($fila = $resultado->fetch_assoc()) {
            $novedades[] = (Object)$fila;
        }
        $stmt->close();

        return $novedades;
    }

    //obtenerEntradasUsuario
    public function obtenerEntradasUsuario($id_usuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_usuario = ?  AND tipo = 5 ORDER BY fecha_creacion DESC";
        $resultado = $this->conexion->prepare($sql);
        $resultado->bind_param("i", $id_usuario);
        $resultado->execute();
        $resultados = $resultado->get_result();

        $entradas = array();
        while ($fila = $resultados->fetch_assoc()) {
            $entradas[] = (Object)$fila;
        }
        $resultado->close();

        return $entradas;
    }

    public function datatablesEntradasUsuario($id_usuario){
        $params = $columns = $totalRecords = $data = array();
 
        $params = $_REQUEST;
        
        $columns = array(
        0 => 'titulo',
        1 => 'fecha_creacion', 
        2 => 'contenido'
        );
        
        $where_condition = $sqlTot = $sqlRec = "";
        /*
        if( !empty($params['search']['value']) ) {
        $where_condition .= " WHERE ";
        $where_condition .= " ( post_title LIKE '%".$params['search']['value']."%' ";    
        $where_condition .= " OR post_desc LIKE '%".$params['search']['value']."%' )";
        }*/
        
        $sql_query = " SELECT titulo, contenido, fecha_creacion FROM publicaciones ";
        $sqlTot .= $sql_query;
        $sqlRec .= $sql_query;
        
        $where_condition .= "WHERE id_usuario = $id_usuario  AND tipo = 5";

        if(isset($where_condition) && $where_condition != '') {
        
        $sqlTot .= $where_condition;
        $sqlRec .= $where_condition;
        }
        
        $sqlRec .=  " ORDER BY fecha_creacion DESC  LIMIT ".$params['start']." ,".$params['length']." ";
        
        $queryTot = mysqli_query($this->conexion, $sqlTot) or die("Database Error:". mysqli_error($this->conexion));
        
        $totalRecords = mysqli_num_rows($queryTot);
        
        $queryRecords = mysqli_query($this->conexion, $sqlRec) or die("Error to Get the Post details.");
        
        while( $row = mysqli_fetch_row($queryRecords) ) { 
        $data[] = $row;
        } 
        
        $json_data = array(
        "draw"            => intval( $params['draw'] ),   
        "recordsTotal"    => intval( $totalRecords ),  
        "recordsFiltered" => intval($totalRecords),
        "data"            => $data
        );
        
        echo json_encode($json_data);
    }

    public function obtenerUltimoEstadoUsuario($usuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_usuario = $usuario AND tipo = 1 ORDER BY fecha_creacion DESC LIMIT 1";
        $resultado = $this->conexion->query($sql);
        $publicacion = $resultado->fetch_assoc();
        if(!empty($publicacion)){
            return (Object) $publicacion;
            //return $resultado->fetch_all(MYSQLI_ASSOC)[0];
        }else{
            return (Object) array("contenido" => "");
        }
        
    }

    public function crearPublicacion($id_usuario, $contenido) {
        $sql = "INSERT INTO publicaciones (id_usuario, contenido, fecha_creacion, tipo) VALUES (?, ?, NOW(), 1)";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->bind_param("is", $id_usuario, $contenido);
        $sentencia->execute();
    }

}

?>
