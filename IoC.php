<?php
class IoC {
  private static $instance;
   /**
    * @var PDO The connection to the database
    */
   protected static $registry = array();
 
   public static function getInstance()
   {
    if(!isset(self::$instance)){
      $c = __CLASS__;
      self::$instance = new $c;
    }

    return self::$instance;
   }

   private function __construct(){
      self::register('CLASS_NAME', function(){
        //Create you class and injected dependencies

        return CLASSNAME;
      });
   }

   /**
    * Add a new resolver to the registry array.
    * @param  string $name The id
    * @param  object $resolve Closure that creates instance
    * @return void
    */
   public static function register($name, Closure $resolve)
   {
      static::$registry[$name] = $resolve;
   }
 
   /**
    * Create the instance
    * @param  string $name The id
    * @return mixed
    */
   public static function resolve($name)
   {
      if ( static::registered($name) )
      {
         $name = static::$registry[$name];
         return $name();
      }
 
      throw new Exception('Nothing registered with that name, fool.');
   }
 
   /**
    * Determine whether the id is registered
    * @param  string $name The id
    * @return bool Whether to id exists or not
    */
   public static function registered($name)
   {
      return array_key_exists($name, static::$registry);
   }
}