<?php
    include("cn.php");
    class Db extends Connect{
        private $cn;
        public $lastID;

        //connect
        // public function connect(){
        //     $this->cn = new mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname);
        //     $this->cn->set_charset("utf8");
        // }
        
        //constuct
        public function __construct(){
            $this->cn = new mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname);
            $this->cn->set_charset("utf8");
        }

        //real escape string
        public function realStr($str){
            return $this->cn->real_escape_string($str);
        }
        
        //save data
        public function saveData($tbl,$val){
            $sql = "INSERT INTO $tbl VALUES($val)";
            $this->cn->query($sql);
            $this->lastID = $this->cn->insert_id;
        }

        //update
        public function updateData($tbl,$fld,$con){
            $sql = "UPDATE $tbl SET $fld WHERE $con";
            $this->cn->query($sql);
        }

        //duplicate data
         public function dplData($tbl,$con){
            $sql = "SELECT * FROM $tbl WHERE $con ";
            $res = $this->cn->query($sql);
            $num = $res->num_rows;
            if($num > 0){
                return true;
            }else{
                return false;
            }
        }

        //select data
        public function selectData($tbl,$fld,$con,$od,$s,$e){
            $data = array();
            $sql = "SELECT $fld FROM $tbl WHERE $con ORDER BY $od LIMIT $s,$e";
            $res = $this->cn->query($sql);
            $num = $res->num_rows;
            if($num == 0){
                return 0;
            }else{
                while( $row = $res->fetch_array()){
                    $data[] = $row;
                }
                return $data;
            } 
        }
        //select current data or single data
        public function selectCurrentData($tbl,$fld,$con){
            $sql = "SELECT $fld FROM $tbl WHERE $con";
            $res = $this->cn->query($sql);
            $num = $res->num_rows;
            if($num == 0 ){
                return "0";
            }else{
                return $res->fetch_array();
            }
        }

        //get auto id
        public function getAutoID($tbl,$fld,$od){
            $sql = "SELECT $fld FROM $tbl ORDER BY $od";
            $res = $this->cn->query($sql);
            $num = $res->num_rows;
            if($num == 0){
                return 1;
            }else{
                $row = $res->fetch_array();
                return $row[0] + 1;
            }
        }

        //count data
        public function countData($tbl,$con){
            $sql = "SELECT COUNT(*) as total FROM $tbl WHERE $con";
            $res = $this->cn->query($sql);
            $row = $res->fetch_array();
            return $row[0];
        }

        //read data for inner join table
        public function readData($sql){
            $res = $this->cn->query($sql);
            $num = $res->num_rows;
            if($num > 0){
                return $res;
            }else{
                return 0;
            }
        }

        //get post data
        public function getPostData($time,$date){
            $prevoiusTimeStapm = strtotime($time." ".$date);
            $lastTimeStapm = strtotime(date("Y-m-d h:i:sa"));
            $menos = $lastTimeStapm - $prevoiusTimeStapm;
            $mins = $menos/60;
            if($mins < 1){
                $showing = "???????????????????????????";
            }else{
                $minsfinal = floor($mins);
                $secondfinal = $menos - ($minsfinal * 60);
                $hours = $minsfinal / 60;
                if($hours<1){
                    $showing = $minsfinal . " ?????????????????????";
                }else{
                    $hoursfinal = floor($hours);
                    $minssuperfinal = $minsfinal - ($hoursfinal * 60);
                    $day = $hoursfinal / 24;
                    if($day < 1){
                        $showing = $hoursfinal . " ?????????????????????";
                    }else if($day < 2){
                        $showing = " ???????????????????????? ??????????????? ". $time;
                    }else{
                        $d = date("d",strtotime($date));
                        $m = date("m",strtotime($date));
                        $y = date("Y",strtotime($date));
                        if($m ==1 ){
                            $m = '????????????';
                        }else if($m == 2){
                            $m = '??????????????????';
                        }else if($m == 3){
                            $m = '????????????';
                        }else if($m == 4){
                            $m = '????????????';
                        }else if($m == 5){
                            $m = '????????????';
                        }else if($m == 6){
                            $m = '??????????????????';
                        }else if($m == 7){
                            $m = '??????????????????';
                        }else if($m == 8){
                            $m = '????????????';
                        }else if($m == 9){
                            $m = '???????????????';
                        }else if($m == 10){
                            $m = '????????????';
                        }else if($m == 11){
                            $m = '????????????????????????';
                        }else if ($m == 12){
                            $m = '????????????';
                        }
                        $showing = $d."-".$m."-".$y ." - ??????????????? ". $time;
                    }
                }
            }
            return $showing;
        }
        
    }


?>