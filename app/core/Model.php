<?php
class Model
{
    public function getParameters(){
        $parameters =  [];
        foreach (static::$db_parameters as $key){
                if(property_exists($this, $key) && !empty($this->$key)){
                $parameters[$key] = $this -> $key;
                }
            }
            return $parameters;
    }

    public function create()
    {
        unset($this -> where);
        $parameters = $this -> getParameters();
        $keys ='';$values='';
        foreach($parameters as $key => $value)
    {
        $keys =$key .','. $keys;
        $values=':'.$key.','.$values;
    }
        $connection = DB::getInstance();
        $sql = " INSERT INTO " . static::$db_table ." (" . rtrim($keys, ',') .") 
        VALUES (".rtrim($values, ',').")";
        $connection->prepare($sql) -> execute($parameters);
    }

    public function delete (string $where)
    {
        $whereparam = ['where' => $this -> where];
        $connection = DB::getInstance();
        $result =$connection -> prepare("DELETE FROM ".static::$db_table." WHERE ". $where . "=:where");
        $result -> execute($whereparam);
    }

    public function select (string $whereName)
    {
        $where = ['where' => $this -> where];
        $connection = DB::getInstance();
        $sql = "SELECT * FROM " .static::$db_table. " WHERE ".$whereName." = :where";
        $result = $connection -> prepare($sql);
        $result -> execute($where);
        return $result -> fetchALL();
    } 

    public function selectLimit (string $whereName, int $limit, int $offset)
    {
        $where = ['where' => $this -> where];
        $connection = DB::getInstance();
        $sql = "SELECT * FROM " .static::$db_table. " WHERE ".$whereName." = :where 
        LIMIT " . $limit . " OFFSET ". $offset;
        $result = $connection -> prepare($sql);
        $result -> execute($where);
        return $result -> fetchALL();
    } 
    
    public function selectAll()
    {
        $connection = DB::getInstance();
        $sql = "SELECT * FROM " .static::$db_table;
        $result = $connection -> prepare($sql);
        $result -> execute();
        return $result -> fetchALL();
    }

    public function selectAllLimit(int $limit, int $offset)
    {
        $connection = DB::getInstance();
        $sql = "SELECT * FROM " .static::$db_table .
          " LIMIT ". $limit . " OFFSET ". $offset;
        $result = $connection -> prepare($sql);
        $result -> execute();
        return $result -> fetchALL();
    }

    public function selectAllLike(string $Like, string $where)
   {
       $connection = DB::getInstance();
       $sql = "SELECT * FROM " .static::$db_table." WHERE ".$where." LIKE ?";
       $result = $connection -> prepare($sql);
       $result -> bindParam(1,$Like);
       $result -> execute();
       return $result -> fetchALL();
   }

   public function selectAllLikeLimit(string $Like, string $where, int $limit, int $offset)
   {
       $connection = DB::getInstance();
       $sql = "SELECT * FROM " .static::$db_table." WHERE ".$where." LIKE ?
       LIMIT ". $limit . " OFFSET " . $offset;
       ;
       $result = $connection -> prepare($sql);
       $result -> bindParam(1,$Like);
       $result -> execute();
       return $result -> fetchALL();
   }
   public static function innerSelectLimit(array $select, string $from, array $tabels, array $where, int $limit , int $offset)
   {
        $innerJoin = [
            'categories-products' => 'inner join products on products.id = categories.id',
            'products-bought' => 'inner join bought on products.id = bought.product',
            'products-comments' => 'inner join comments on products.id = comments.product',
            'products-rating' => 'inner join rating on products.id = rating.product',
            'rating-users' => 'inner join users on rating.user = users.id',
            'comments-users'=> 'inner join users on comments.user = users.id',
            'bought-orders'=> 'inner join orders on bought.orders = orders.id',
            'users-orders'=> 'inner join orders on orders.user = users.id',
            'orders-users'=> 'inner join users on users.id = orders.user',
            'orders-bought'=> 'inner join bought on bought.orders = orders.id',
            'bought-products' => 'inner join products on products.id = bought.product'
        ];
        $selectResult='';
        $innerResult='';
        $whereKey='';
        $whereParm='';
        foreach($select as $key => $value)
   {
    if (preg_match('~[0-9]+~', $key)) {
        $key = substr($key, 0, -1);
    }
    $selectResult = $selectResult . $key.'.'. $value.',';  
   }

   foreach($tabels as $key)
   {
       foreach($innerJoin as $innerKey => $innerValue)
       {
           if($innerKey === $key){
               $innerResult = $innerResult .' '. $innerValue.' ' ;
           }
       }
   }

    foreach($where as $key => $value)
    {
       $whereKey = $key;
       $whereParm=$value;
    }


    $connection = DB::getInstance();
    $sql = "SELECT ". rtrim($selectResult, ' ,').
    " FROM ". $from . " " .  $innerResult . 
    " WHERE " . $whereKey . "= ? ORDER BY id DESC
    LIMIT ". $limit . " OFFSET ". $offset;
    $result = $connection-> prepare($sql);
    $result -> bindParam(1,$whereParm);
    $result -> execute();
    return $result -> fetchALL();
    }
}
