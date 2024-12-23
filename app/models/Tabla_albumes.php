<?php
require_once(__DIR__ . "/../config/Connect.php");

class Tabla_albumes
{
    private $connect;
    private $table = 'albumes';
    private $primary_key = 'id_album';

    public function __construct()
    {
        $db = new Connect();
        $this->connect = $db->connect;
    }

    //---------------------------
    // CRUD: Create | Read | Update | Delete
    //---------------------------

    // Crear un nuevo álbum
    public function createAlbum($data = array())
    {
        // Configurar campos dinámicamente
        $fields = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        // Consulta SQL - INSERT
        $sql = "INSERT INTO " . $this->table . " ($fields) VALUES($values)";

        try {
            // Preparar la consulta
            $stmt = $this->connect->prepare($sql);

            // Vincular valores dinámicamente
            foreach ($data as $key => $value) {
                $stmt->bindValue(":" . $key, $value);
            }

            // Ejecutar consulta
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    // Leer todos los álbumes de un usuario específico
    public function readAllAlbums($id_usuario)
    { {
            $sql = "SELECT * FROM " . $this->table . " p join artistas a ON p.id_artista=a.id_artista WHERE a.id_usuario = :id;";
            try {
                $stmt = $this->connect->prepare($sql);
                $stmt->bindValue(":id", $id_usuario, PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_OBJ);
                $stmt->execute();
                $generos = $stmt->fetchAll();
                return (!empty($generos)) ? $generos : array();
            } catch (PDOException $e) {
                echo "Error en la consulta: " . $e->getMessage();
                return array();
            }
        }
    }

    public function readAllAlbumsGeneral($id_usuario)
    { {
            $sql = "SELECT * FROM " . $this->table . ";";
            try {
                $stmt = $this->connect->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_OBJ);
                $stmt->execute();
                $generos = $stmt->fetchAll();
                return (!empty($generos)) ? $generos : array();
            } catch (PDOException $e) {
                echo "Error en la consulta: " . $e->getMessage();
                return array();
            }
        }
    }


    // Leer un álbum específico por su ID
    public function readGetAlbum($id_album = 0)
    {
        $sql = "SELECT albumes.*, usuarios.nombre_usuario, generos.nombre_genero
                FROM " . $this->table .
            " LEFT JOIN usuarios ON " . $this->table . ".id_artista = usuarios.id_usuario" .
            " LEFT JOIN generos ON " . $this->table . ".id_genero = generos.id_genero" .
            " WHERE " . $this->primary_key . " = :id_album;";
        try {
            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":id_album", $id_album, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            $album = $stmt->fetch();
            return (!empty($album)) ? $album : array();
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }

    // Actualizar información de un álbum
    public function updateAlbum($id_album = 0, $data = array())
    {
        $params = array();
        $fields = array();

        foreach ($data as $key => $value) {
            $params[":" . $key] = $value;
            $fields[] = "$key = :$key";
        }

        try {
            $setParams = implode(", ", $fields);
            $sql = 'UPDATE ' . $this->table . ' SET ' . $setParams . ' WHERE ' . $this->primary_key . ' = :id;';
            $stmt = $this->connect->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->bindValue(":id", $id_album);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    // Eliminar un álbum por su ID
    public function deleteAlbum($id_album = 0)
    {
        try {
            $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $this->primary_key . ' = :id;';
            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":id", $id_album);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }
}
