<?php

class URE_Task_Queue {
    
    private static $instance = null; // object exemplar reference  according to singleton patern
    const OPTION_NAME = 'ure_tasks_queue';        
    private $queue = null;
    
    
    public static function get_instance() {
                
        if (self::$instance===null) {        
            self::$instance = new URE_Task_Queue();
        }
        
        return self::$instance;
        
    }
    // end of get_instance()
    
    
    protected function __construct() {
        
        $this->init();
        
    }
    // end of __construct()
    
    
    private function init() {
        
        $this->queue = get_option(self::OPTION_NAME, array());
        
    }
    // end of init()
            
    
    public function reinit() {
        
        $this->init();
        
    }
    // end of reinit()


    /**
     * 
     * @param string $task_id
     * @param array $args=array('action'=>'action_name', 'routine'=>'routine_name', 'priority'=>99)
     */
    public function add($task_id, $args=array()) {
        
        $this->queue[$task_id] = $args;
        update_option(self::OPTION_NAME, $this->queue);
        
    }
    // end of add_task()
    
        
    public function remove($task_id) {
        
        if (isset($this->queue[$task_id])) {
            unset($this->queue[$task_id]);
            update_option(self::OPTION_NAME, $this->queue);
        }
    }
    // end of remove_task()
    
    
    /**
     * Returns true in case a queue is empty
     * 
     * @return boolean
     */
    public function is_empty() {
        
        return count($this->queue)==0;
    }
    // end of is_empty()
    
    
    /** 
     * Consumers should add there tasks with add_method and add 'ure_fulfil_task' action routine to work on it.
     * Do not forget remove task after it was fulfilled.
     * 
     * @return void
     */
    
    public function process() {
        
        if ($this->is_empty()) {
            return;
        }
        
        foreach($this->queue as $task_id=>$task) {
            if ($task_id=='on_activation') {
                do_action('ure_on_activation');        
                $this->remove('on_activation'); // remove this task after execution if it was defined
            } elseif (!empty($task['action'])) {
                    $priority =  empty($task['priority']) ? 10: $task['priority'];
                    add_action($task['action'], $task['routine'], $priority);
            } else {
                add_action('init', $task['routine']);
            }            
        }
    }
    // end of process();
    
    /**
     * Prevent cloning of the instance of the *Singleton* instance.
     *
     * @return void
     */
    public function __clone() {
        throw new \Exception('Do not clone a singleton instance.');
    }
    // end of __clone()
    
    /**
     * Prevent unserializing of the *Singleton* instance.
     *
     * @return void
     */
    public function __wakeup() {
        throw new \Exception('Do not unserialize a singleton instance.');
    }
    // end of __wakeup()

}
// end of class URE_On_Activation