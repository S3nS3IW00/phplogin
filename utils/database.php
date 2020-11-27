<?php

class DB {

    public static function Query($sql, $params) {
        require_once 'config.php';
        if ($stmt = $pdo->prepare($sql)) {
            
            foreach ($params as $key => &$value) {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }

            try {
                if ($stmt->execute()) {
                    return $stmt->fetchAll();
                } else {
                    echo "Ismeretlen hiba történt.";
                    return NULL;
                }
            } catch (PDOException $e) {
                return NULL;
            }

            unset($stmt);
        }
        unset($pdo);
    }

    public static function Update($sql, $params) {
        require_once 'config.php';
        if ($stmt = $pdo->prepare($sql)) {

            foreach ($params as $key => &$value) {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }

            try {
                if ($stmt->execute()) {
                    return true;
                } else {
                    echo "Ismeretlen hiba történt.";
                    return false;
                }
            } catch (PDOException $e) {
                return false;
            }

            unset($stmt);
        }
        unset($pdo);
    }

}

?>