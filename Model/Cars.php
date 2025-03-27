<?php 

class Cars{
    private $id;
    private $marka;
    private $modell;
    private $ev;
    private $ar;
    private $kilometerallas;

    public function __construct( $id,  $marka,  $modell,  $ev,  $ar,  $kilometerallas){$this->id = $id;$this->marka = $marka;$this->modell = $modell;$this->ev = $ev;$this->ar = $ar;$this->kilometerallas = $kilometerallas;}
	public function getId() {return $this->id;}

	public function getMarka() {return $this->marka;}

	public function getModell() {return $this->modell;}

	public function getEv() {return $this->ev;}

	public function getAr() {return $this->ar;}

	public function getKilometerallas() {return $this->kilometerallas;}

	public function setId( $id): void {$this->id = $id;}

	public function setMarka( $marka): void {$this->marka = $marka;}

	public function setModell( $modell): void {$this->modell = $modell;}

	public function setEv( $ev): void {$this->ev = $ev;}

	public function setAr( $ar): void {$this->ar = $ar;}

	public function setKilometerallas( $kilometerallas): void {$this->kilometerallas = $kilometerallas;}

	static function getCars($brand, $type)
    {
  

        try{
            $mysqli = new mysqli();
            $mysqli->connect("localhost","root","root","autoadatbazis"); 
            
            $sql = "SELECT * FROM `autok` WHERE marka LIKE '%$brand%' AND modell LIKE '%$type%';";
            $resultObject = $mysqli->query($sql);
            $result = $resultObject->fetch_all(MYSQLI_ASSOC);

            return $result;
        }catch(Exception $e){
            var_dump($e->getMessage());
        }
        
    }

    static function buyCar($userId, $carId){
        try{
            $mysqli = new mysqli();
            $mysqli->connect("localhost","root","root","autoadatbazis"); 

            $sql = "UPDATE autok SET user_id = $userId WHERE autok.id = $carId;";
            $resultObject = $mysqli->query($sql);
            if($resultObject){
                return [
                    "status" => true,
                    "message" => "siker"
                ];
            }
            else{
                return [
                    "status" => false,
                    "message" => "nem siker"
                ];
            }
            var_dump($resultObject);

        }catch(Exception $e){
            return [
                "status" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    static function addNewCar($marka, $modell, $ev, $ar, $kilometerallas) {
        try {
            $mysqli = new mysqli("localhost", "root", "root", "autoadatbazis");
            
            // Check connection
            if ($mysqli->connect_error) {
                throw new Exception("Connection failed: " . $mysqli->connect_error);
            }
    
            // Escape variables to prevent SQL injection
            $marka = $mysqli->real_escape_string($marka);
            $modell = $mysqli->real_escape_string($modell);
            $ev = $mysqli->real_escape_string($ev);
            $ar = $mysqli->real_escape_string($ar);
            $kilometerallas = $mysqli->real_escape_string($kilometerallas);
    
            $sql = "INSERT INTO autok (marka, modell, ev, ar, kilometerallas) 
                    VALUES ('$marka', '$modell', '$ev', $ar, $kilometerallas)";
    
            if ($mysqli->query($sql)) {
                return [
                    'status' => true,
                    'message' => 'Car added successfully',
                    'insertId' => $mysqli->insert_id
                ];
            } else {
                throw new Exception("Error: " . $mysqli->error);
            }
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        } finally {
            $mysqli->close();
        }
    }
}