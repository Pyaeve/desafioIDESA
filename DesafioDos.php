<?php 
include('Database.php');

class DesafioDos {

    public static function retriveLotes(string $loteID):void {

        Database::setDB(); 
        $lotes = self::getLotes($loteID);
      //  echo "<pre>";
       // print_r($lotes);
       // die("</pre>");
        echo(json_encode($lotes));
    }

    private static function getLotes (string $loteID){
        $lotes=[];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts AS t1 where t1.lote='".$loteID."';");
        while($rows = $stmt->fetchArray(SQLITE3_ASSOC)){
            $lotes[] = (object) $rows;
        }
        return $lotes;
    }
}

DesafioDos::retriveLotes('00148');