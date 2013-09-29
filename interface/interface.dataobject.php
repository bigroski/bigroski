<?php 
    interface Database_Result_Object{
        /*Conunt the database result*/
        public function total_data();
        /*Fetch the each row and return that row as object(ArrayToObject)*/
        public function fetch_data();
    }
