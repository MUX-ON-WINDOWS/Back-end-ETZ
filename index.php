<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json');

require_once(__DIR__ . '/php/connection.php');

if ($conn === null) {
    die("Database connection failed.");
}

class ETZ {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // patient
    public function login($email, $password) {
        $stmt = $this->db->prepare('SELECT * FROM `account` WHERE email = ?');
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $this->db->error);
        }

        $stmt->bind_param('s', $email);
        if ($stmt->execute() === false) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            throw new Exception('Get result failed: ' . $stmt->error);
        }

        $user = $result->fetch_assoc();
        if ($user && $password === $user['password']) {
            return $user;
        } else {
            return false;
        }
    }

    public function history($user_id) {
        $query = 'SELECT history.*, relative.name 
        FROM history INNER JOIN relative ON history.user_id = relative.user_id 
        WHERE relative.patient_id = ? 
        ORDER BY history.timestamp 
        DESC LIMIT 25 OFFSET 0';
    
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $this->db->error);
        }
    
        $stmt->bind_param('i', $user_id);
        if ($stmt->execute() === false) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }
    
        $result = $stmt->get_result();
        if ($result === false) {
            throw new Exception('Get result failed: ' . $stmt->error);
        }
    
        $history = [];
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
    
        return $history;
    }

    public function getPatientSetting($user_id) {
        $query = 'SELECT status, brightness, volume  FROM `patient` WHERE user_id = ?';
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $this->db->error);
        }
        
        $stmt->bind_param('i', $user_id);
        if ($stmt->execute() === false) {
            $stmt->close();
            throw new Exception('Execute failed: ' . $stmt->error);
        }
    
        $result = $stmt->get_result();
        if ($result === false) {
            $stmt->close();
            throw new Exception('Get result failed: ' . $stmt->error);
        }
    
        $settings = [];
        while ($row = $result->fetch_assoc()) {
            $settings[] = [
                'status' => $row['status'],
                'brightness' => (int)$row['brightness'],
                'volume' => (int)$row['volume']
            ];
        }
        $result->free();
        $stmt->close();
    
        return $settings;
    }

    public function updateSetting($user_id, $brightness, $volume) {
        $query = 'UPDATE `patient` SET volume = ?, brightness = ? WHERE user_id = ?';
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $this->db->error);
        }
        
        $stmt->bind_param('iii', $volume, $brightness, $user_id);
        if ($stmt->execute() === false) {
            $stmt->close();
            throw new Exception('Execute failed: ' . $stmt->error);
        }
        
        $stmt->close();
    
        return true; // Return true to indicate success
    }
    
    // verwant
    public function getVerwantSettings($user_id) {
        $query = 'SELECT sound, color FROM `relative` WHERE user_id = ?';
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $this->db->error);
        }

        $stmt->bind_param('i', $user_id);
        if ($stmt->execute() === false) {
            $stmt->close();
            throw new Exception('Execute failed: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            $stmt->close();
            throw new Exception('Get result failed: ' . $stmt->error);
        }

        $settings = [];
        while ($row = $result->fetch_assoc()) {
            $settings[] = [
                'sound' => $row['sound'],
                'color' => $row['color']
            ];
        }

        $result->free();
        $stmt->close();

        return $settings;        
    }

    public function updateVerwantSettings($sound, $color, $user_id) {
        $query = 'UPDATE `relative` SET sound = ?, color = ? WHERE user_id = ?';
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $this->db->error);
        }
    
        $stmt->bind_param('sss', $sound, $color, $user_id);
        if ($stmt->execute() === false) {
            $stmt->close();
            throw new Exception('Execute failed: ' . $stmt->error);
        }
    
        $stmt->close();
    
        return true; // Return true to indicate success
    }
}
?>
