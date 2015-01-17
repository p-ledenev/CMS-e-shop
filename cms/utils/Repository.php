<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 07.08.13
 * Time: 8:34
 * To change this template use File | Settings | File Templates.
 */

/* @property RequestLogger $logger */
class Repository
{
    private $link;
    private $logger;

    function __construct($host, $user, $password, $db)
    {
        $this->logger = new RequestLogger();

        $this->link = mysql_connect($host, $user, $password);
        mysql_select_db($db);
        mysql_query("SET NAMES cp1251");
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function getLogger()
    {
        return $this->logger;
    }

    public static function newDBConnection($db)
    {
        return new Repository("localhost", "mysql_market", "someymohous9", $db);
    }


    public static function mTime()
    {
        $mtime = microtime();
        $mtime = explode(" ", $mtime);
        $mtime = $mtime[1] + $mtime[0];

        return $mtime;
    }

    public function select($request, $total = false, $quote = true)
    {
        $ts = Repository :: mTime();

        if (!($result = mysql_query($request)))
            throw new Exception("Select exeption<BR>$request<BR>" . mysql_error($this->link));

        $number = mysql_num_rows($result);

        $b = Array();
        for ($i = 0; $i < $number; $i++) {
            $b[$i] = mysql_fetch_assoc($result);
            if ($quote) $b[$i] = $this->htmlDecode($b[$i]);
        }

        if ($total) $b['data']['total'] = $number;

        $te = Repository :: mTime();
        //echo $request."<BR>Sec. ".($te-$ts)."<BR><BR>";

        return $b;
    }

    public function executeSecure($request)
    {
        /* @var Customer $administrator */
        $administrator = unserialize($_SESSION['administrator']);

        if (!$administrator)
            die("You should be authorize");

        $this->logger->log($request, $administrator->toDetailString() . " " . $administrator->getId());

        try {
            $this->execute($request);

        } catch (Exception $e) {

            $this->logger->log($e->getMessage(), $administrator->toDetailString() . " " . $administrator->getId());
            throw $e;
        }

    }

    public function execute($request)
    {
        if (!mysql_query($request))
            throw new Exception("Execute execution<BR>$request<BR>" . mysql_error($this->link));
    }

    protected function htmlEncode($CDATA)
    {
        if (is_array($CDATA)) {

            foreach ($CDATA as $field => $value)
                $CDATA[$field] = htmlspecialchars(rtrim($value), ENT_QUOTES, "cp1251");

        } else {

            $CDATA = htmlspecialchars(rtrim($CDATA), ENT_QUOTES, "cp1251");
        }

        return $CDATA;
    }

    protected function htmlDecode($CDATA)
    {
        foreach ($CDATA as $field => $value)
            $CDATA[$field] = html_entity_decode($value, ENT_QUOTES, "cp1251");

        return $CDATA;
    }

    public function close()
    {
        mysql_close($this->link);
    }
}

;
