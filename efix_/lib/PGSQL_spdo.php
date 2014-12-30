<?php
class PGSQL_spdo extends PDO
{
    private static $instance = null;
    protected $host='localhost';
    protected $port='5432';
    protected $dbname='efix2';
    protected $user='postgres';
    protected $password='123456';
    protected static $exec = "call";

    public function __construct()
    {
       
        $dns='pgsql:dbname='.$this->dbname.';host='.$this->host.';port='.$this->port;
        $user = $this->user;
        $pass = $this->password;
        parent::__construct($dns,$user,$pass);
    }
    public static function getExec()
    {
        return self::$exec;
    }
    public static function singleton()
	{
             if( self::$instance == null )
                {
                    self::$instance = new self();
                }
             return self::$instance;
	}
	public  function db()
	{
		return $this->dbname;
	}
}
?>
