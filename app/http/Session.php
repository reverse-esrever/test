<?php

namespace App\Http;

use Configs\SessionConfig;

class Session
{
    private int $lifetime;
    private int $cockieLifetime;
    private $sessionId;
    private $data = [];
    private $lastActivity;
    
    public function __construct(SessionConfig $config) {
        $params = $config->getParams();
        $this->lifetime = $params['gc_maxlifetime'];
        $this->cockieLifetime = $params['cookie_lifetime'];
    }
    
    public function start(){
        session_start();
        $this->sessionId = session_id();
        $this->lastActivity = time();
    }
    private function loadSessionData() {
        if (isset($_SESSION['user_id'])) {
            $this->data['user_id'] = $_SESSION['user_id'];
            $this->updateActivity();
        }
    }
    
    public function updateActivity() {
        $this->lastActivity = time();
        $_SESSION['last_activity'] = $this->lastActivity;
    }
    
    public function isExpired($lifetime = 86400) {
        return (time() - $this->lastActivity) > $lifetime;
    }
    
    public function regenerateId() {
        session_regenerate_id(true);
        $this->sessionId = session_id();
    }
}