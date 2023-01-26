<?php
 class Rest{
 	
 	 public static function retriveLotes(string $loteID):void {

        Database::setDB(); 
        $lotes = self::getLote($loteID);
      //  echo "<pre>";
       // print_r($lotes);
       // die("</pre>");
        echo(json_encode($lotes));
    }

    public static function getLote (string $loteID): array{
        $lotes=[];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts AS t1 where t1.lote='".$loteID."';");
        while($rows = $stmt->fetchArray(SQLITE3_ASSOC)){
            $lotes[] = (object) $rows;
        }
        return $lotes;
    }
    public static function getLotes() : array 
    {
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts");
        while($rows = $stmt->fetchArray(SQLITE3_ASSOC)){
            //$rows['clientID'] = (string) $rows['clientID'];
            $lotes[] = (object) $rows;
        }
        return $lotes;
    }
 }
?>