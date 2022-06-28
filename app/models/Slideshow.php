<?php
class Slideshow extends Model
{
    protected static $db_parameters = (['id','photo','visible','where']);
    protected static $db_table ='slideshow';
    public $id;
    public $photo;
    public $visible;
    public $where;
}
