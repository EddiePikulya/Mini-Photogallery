<?php
require_once('initialize.php');
class Logger {
    public $logfile = SITE_ROOT.DS."logs".DS."logs.txt";
    public function log_action($action, $message="") {
        if($handle = fopen($this->logfile, 'at')) {
            $date = strftime('%m/%d/%Y %H:%M', time());
            $content = "{$date} | {$action}: {$message}\n";
            fwrite($handle, $content);
            fclose($handle);
        } else {
            echo "Could not open the file for writing";
        }
    }

    public function log_read() {
        if($handle = fopen($this->logfile, 'rt')) {
            $content = fread($handle, filesize($this->logfile));
            fclose($handle);
        }
        echo nl2br($content);
    }

    public function log_clean() {
        global $session;
        file_put_contents($this->logfile, '');
        $this->log_action('Logs cleared', "by User ID {$session->user_id}");
    }
}
$logger = new Logger();
?>