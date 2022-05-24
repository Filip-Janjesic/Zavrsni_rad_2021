<?php
class Categories extends Model
{
    protected static $db_parameters = (['id','name','where']);
    protected static $db_table ='categories';
    public $id;
    public $name;
    public $where;
    
    public static function selectAllCategories()
    {
        $connection= DB::getInstance();
        $sql = 
        '
            select 
            a.id,a.name, count(b.id) as products 
            from categories a 
            left join  products b on a.id = b.category
            group by a.name; 
        ';
        $result = $connection -> prepare($sql);
        $result -> execute();
        return $result -> fetchAll();
    }
}