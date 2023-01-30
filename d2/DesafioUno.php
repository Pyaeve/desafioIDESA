<?php 

include  'Database.php';

class DesafioUno {


    public static function getClientDebt (int $clientID)
    {
        Database::setDB();

        $lotes =self::getLotes();
        $cobrar=[];
        $cobrar['status']            = false;
        $cobrar['message']           = 'No hay Lotes para cobrar';
        $cobrar['data']['total']     = 0;
        $cobrar['data']['detail']    = [];

        foreach($lotes as $n){
               
          if($n->precio!==190000) continue;
            if($n->clientID !== $clientID) continue;
                if($n->lote && $n->lote!=='00148') continue;
            $cobrar['status']             = true;
            $cobrar['message']            = 'Tienes Lotes para cobrar';
            $cobrar['data']['total']     += $n->precio;
            $cobrar['data']['detail'][]   = (array) $n;
 
        }
        header('Content-Type: application/json');
        echo(json_encode($cobrar));
    }

    

    private static function getLotes() : array 
    {
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts");
        while($rows = $stmt->fetchArray(SQLITE3_ASSOC)){
            $lotes[] = (object) $rows;
        }
        return $lotes;
    }



}

DesafioUno::getClientDebt(123456);