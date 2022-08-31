<?php
namespace DB;
final class MySQLi {
    private $connection;

    public function __construct($hostname, $username, $password, $database) {
        $this->connection = new \mysqli($hostname, $username, $password, $database);

        if ($this->connection->connect_error) {
            throw new \Exception('Error: ' . $this->connection->error . '<br />Error No: ' . $this->connection->errno);
        }

        $this->connection->set_charset("utf8");
    }

    public function query($sql) {
        $query = $this->connection->query($sql);

        if (!$this->connection->errno) {
            if ($query instanceof \mysqli_result) {
                $data = array();

                while ($row = $query->fetch_assoc()) {
                    $data[] = $row;
                }

                $result = new \stdClass();
                $result->num_rows = $query->num_rows;
                $result->row = isset($data[0]) ? $data[0] : array();
                $result->rows = $data;

                $query->close();

                return $result;
            } else {
                return true;
            }
        } else {
            throw new \Exception('Error: ' . $this->connection->error  . '<br />Error No: ' . $this->connection->errno . '<br />' . $sql);
        }
    }

    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }

    public function countAffected() {
        return $this->connection->affected_rows;
    }

    public function getLastId() {
        return $this->connection->insert_id;
    }

    public function connected() {
        return $this->connection->ping();
    }

    public function __destruct() {
        $this->connection->close();
    }

    public  function Test() {
        $query = $this->connection->query("SELECT * FROM `users`");
        $query = $query->fetch_array(MYSQLI_ASSOC);
        return $query;
    }
}


$sql = new MySQLi('localhost', 'root', '', 'tokenmonitor');
echo $sql->Test();