<?php


namespace stm\UIcomponents\Support;

class Config {
    private $file;
    private $basePath;
    private $configPath;

    protected $configs;

    public function __construct($file) {
        $this->basePath = dirname(__DIR__);
        $this->configPath = $this->basePath . '/configs';
        $this->file = $file;
        $this->configs = include $this->configPath($this->file);
    }


    public function __get($name){
        return $this->configs[$name];
    }

    

    public function basePath(string $path = ''): string {
        return $this->basePath . $path;
    }
    public function configPath(string $path = ''): string {
        return $this->configPath . '/' . $path;
    }
    public function getConfigs($key = null){
        if(!$key) return $this->configs;
        if(array_key_exists($key, $this->configs)) {
            return $this->configs[$key] ?? null;
        }else{
            throw new \Exception("key {$key} does not exist.");
        }
    }
    public function setConfigs($config = []){
        $this->configs = $this->getConfigs();
        foreach($config as $key => $value){
            if (array_key_exists($key, $this->configs)) {
                $this->configs[$key] = $value;
            } else {
                throw new \Exception("key {$key} does not exist.");
            }
        }
        $this->save(); 
    }
    public function save(){
        $content = "<?php\n\nreturn " . var_export($this->configs, true) . ";\n";
        file_put_contents($this->configPath($this->file), $content);
    }
}