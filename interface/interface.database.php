<?php
    interface Database_interface{
        public function db_connect();
        public function insert();
        public function update();
        public function select($table, $field = '*',$cond = '',$ord = '', $limit = '', $r_object = false);
        public function exec($sql_query);
    }
?>