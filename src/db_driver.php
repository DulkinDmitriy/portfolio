<?php 
    class DbDriver {
        private $dbconn;
        private $env;
        private $driver = 'pgsql';
        private $host = 'localhost';
        private $port = '5432';
        private $db_name = 'portfolio';
        private $db_user = 'postgres';
        private $db_password = 'qwertyAhuel';
        private $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        function __construct($env)
        {
            $this->env = $env;
            $this->dbconn = parse_url(getenv('DATABASE_URL'));
        }

        function execute($sql) {
            if ($this->env == 'dev') {
                $dsn = "$this->driver:host=$this->host;port=$this->port;dbname=$this->db_name;";
                $pdo = new PDO($dsn, $this->db_user, $this->db_password, $this->options);
            }
            else if ($this->env == 'prod') {
                $dsn = "$this->driver:host={$this->dbconn['host']};port={$this->dbconn['port']};dbname={ltrim($this->dbopts['path'],'/')};";
                $pdo = new PDO($dsn, $this->dbconn['user'], $this->dbconn['pass'], $this->options);
            }
            else {
                throw new UnexpectedValueException("Enviroment variable match is wrong.", 1);
            }

            return $pdo->query($sql);
        }
    }
?>
