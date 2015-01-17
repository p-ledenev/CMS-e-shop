<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 29.05.13
 * Time: 15:29
 * To change this template use File | Settings | File Templates.
 */
class RequestLogger
{
    protected $_logs = array();
    protected $_maxFileSize = 1024;
    protected $_maxLogFiles = 10;
    protected $_logPath = '/logs/';
    protected $_logFile;

    public $request;

    function __construct()
    {
        $this->request = file_get_contents("php://input");
        $this->_logFile = 'portal_' . date('Y-m-d') . '.log';
    }


    public function formatXml($xml)
    {
        try {
            $dom = new DOMDocument;
            $dom->preserveWhiteSpace = FALSE;
            $dom->loadXML($xml);
            $dom->formatOutput = TRUE;
            return $dom->saveXml();
        } catch (Exception $e) {
            return '';
        }
    }

    public function getLogPath()
    {
        return $_SERVER["DOCUMENT_ROOT"] . $this->_logPath;
    }

    public function getLogFile()
    {
        return $this->_logFile;
    }

    public function getMaxFileSize()
    {
        return $this->_maxFileSize;
    }

    public function getMaxLogFiles()
    {
        return $this->_maxLogFiles;
    }

    /**
     * @param $message
     * @param $level
     * @param $category
     * @param $time
     * @return string
     */
    protected function formatLogMessage($message, $userName, $time)
    {
        $usec = explode(".", $time - floor($time));
        return @date('Y-m-d H:i:s.', $time) . substr($usec[1], 0, 4) . " [$userName]:\n$message\n\n";
    }

    /**
     * @param $message
     * @param string $level
     * @param string $category
     */
    public function log($message, $userName)
    {
        $this->_logs[] = array(
            $message,
            $userName,
            microtime(true)
        );
        $this->processLogs($this->_logs);
        $this->_logs = array();
    }

    protected function processLogs($logs)
    {
        $logFile = $this->getLogPath() . $this->getLogFile();
        if (@filesize($logFile) > $this->getMaxFileSize() * 1024) {
            $this->rotateFiles();
        }
        $fp = fopen($logFile, 'a');
        flock($fp, LOCK_EX);

        foreach ($logs as $log) {
            $logMessage = $this->formatLogMessage($log[0], $log[1], $log[2]);

            //echo $logMessage;
            fwrite($fp, $logMessage);
        }

        flock($fp, LOCK_UN);
        fclose($fp);
    }

    protected function rotateFiles()
    {
        $file = $this->getLogPath() . $this->getLogFile();
        $max = $this->getMaxLogFiles();
        for ($i = $max; $i > 0; --$i) {
            $rotateFile = $file . '.' . $i;
            if (is_file($rotateFile)) {
                if ($i === $max) {
                    @unlink($rotateFile);
                } else {
                    @rename($rotateFile, $file . '.' . ($i + 1));
                }
            }
        }
        if (is_file($file)) {
            @rename($file, $file . '.1');
        }
    }

    function createZip($files = array(), $destination = '', $overwrite = false)
    {
        if (file_exists($destination) && !$overwrite) {
            return false;
        }
        $valid_files = array();
        if (is_array($files)) {
            foreach ($files as $file) {
                if (file_exists($file)) {
                    $valid_files[] = $file;
                }
            }
        }
        if (count($valid_files)) {
            $zip = new ZipArchive();
            if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
                return false;
            }
            foreach ($valid_files as $file) {
                $zip->addFile($file, $file);
            }
            $zip->close();
            return file_exists($destination);
        } else {
            return false;
        }
    }
}
