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
}