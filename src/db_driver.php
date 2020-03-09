<?php 
    class DbDriver {
        private $driver = 'pgsql';
        private $host = 'localhost';
        private $port = '5432';
        private $db_name = 'portfolio';
        private $db_user = 'postgres';
        private $db_password = 'qwertyAhuel';
        private $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        function execute($sql) {
            $dsn = "$this->driver:host=$this->host;port=$this->port;dbname=$this->db_name;";
            $pdo = new PDO($dsn, $this->db_user, $this->db_password, $this->options);

            return $pdo->query($sql);
        }
    }
?>
