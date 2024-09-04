<?php

class Cache {
    private $cacheDir;
    private $cacheTime;

    public function __construct($cacheDir = 'cache', $cacheTime = 3600) {
        $this->cacheDir = $cacheDir;
        $this->cacheTime = $cacheTime;

        // Create cache directory if it doesn't exist
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    private function getCacheFileName($key) {
        return $this->cacheDir . '/' . md5($key) . '.cache';
    }

    public function set($key, $data) {
        $cacheFile = $this->getCacheFileName($key);
        file_put_contents($cacheFile, serialize($data));
    }

    public function get($key) {
        $cacheFile = $this->getCacheFileName($key);

        if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $this->cacheTime) {
            return unserialize(file_get_contents($cacheFile));
        }

        return false;
    }

    public function delete($key) {
        $cacheFile = $this->getCacheFileName($key);
        if (file_exists($cacheFile)) {
            unlink($cacheFile);
        }
    }
}

?>
