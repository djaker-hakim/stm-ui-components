<?php


namespace stm\UIcomponents\Support;

class Config {
    private $file;
    private $basePath;
    private $configPath;

    protected $configs;

    /**
     * setup the config path, config file and configs of the $file
     * @param string $file
     */
    public function __construct(string $file) {
        $this->basePath = dirname(__DIR__);
        $this->configPath = $this->basePath . '/configs';
        $this->file = $file;
        $this->configs = include $this->configPath($this->file);
    }


    /**
     * get the config key
     * @param string $name
     */
    public function __get(string $name){
        return $this->configs[$name];
    }

    /**
     * Returns the absolute path to the base (root) directory
     * @param string $path
     * @return string
     */
    public function basePath(string $path = ''): string {
        return $this->basePath . '/' . $path;
    }

    /**
     * Returns the absolute path to the configuration directory
     * @param string $path
     * @return string
     */
    public function configPath(string $path = ''): string {
        return $this->configPath . '/' . $path;
    }
    /**
     * This method returns configuration data. 
     * If a key is provided, it returns the matching config value as a string. 
     * If no key is given, it returns all configs as an array.
     * @param string|null $key
     * @throws \Exception
     */
    public function getConfigs(string|null $key = null) {
        if(!$key) return $this->configs;
        if(array_key_exists($key, $this->configs)) {
            return $this->configs[$key] ?? null;
        }else{
            throw new \Exception("key {$key} does not exist.");
        }
    }
    /**
     * This method sets configuration values. 
     * It takes an array of key-value pairs and updates the existing configs.
     * @param array $config
     * @throws \Exception
     * @return void
     */
    public function setConfigs(array $config = []): void{
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
    /**
     * saves the current configuration data.
     * @return void
     */
    public function save(): void{
        $content = "<?php\n\nreturn " . var_export($this->configs, true) . ";\n";
        file_put_contents($this->configPath($this->file), $content);
    }
}