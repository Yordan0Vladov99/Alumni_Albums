<?php

class DB{

    private $connection;

     function __construct(){
	    $host = "localhost";
        $dbname = "web_project";
        $username = "root";
        $password = "Crazzle1234";
        
        $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
     }

    public function loginUser($name,$password){
        try {
            $sql = "SELECT * FROM users WHERE users.name=?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$name]);
    
            $product=null;
            if($stmt->rowCount() == 0){
                echo "User doesn't exist";
            }
            else{
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if($row['password']!=$password){
                    echo "Wrong Password";
                }
                else{
                    if($row['type']=="photographer"){
                        echo "Login successful. Welcome, photographer.";
                    }
                    else{
                        echo "Login successful";
                    }
                    
                }
            }
        }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function registerUser($name,$password){
        try {
            $sql = "SELECT * FROM users WHERE users.name=?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$name]);
    
            $product=null;
            if($stmt->rowCount() != 0){
                echo "User already exist";
            }
            else{
            $sql = "INSERT into users(name, password, type) VALUES(?,?,'user')";
            $insertStudentStatement = $this->connection->prepare($sql);
            $insertStudentStatement -> execute([$name,$password]);
            echo "Registration is successful";
        }

    }catch (PDOException $e) {
        echo $e->getMessage();
    }
}
public function getRequests($name){
    try {
        $sql = "SELECT * FROM requests WHERE requests.from=? order by publication_date";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$name]);

        if($stmt->rowCount() == 0){
            echo "No requests available";
            echo $name;
        }
        else{
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo json_encode($row);
                echo ";";
            }
        }

}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function getUserSessions($name){
    try {
        $sql = "SELECT * FROM photo_sessions WHERE photo_sessions.requester=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$name]);

        if($stmt->rowCount() == 0){
            echo "No requests available";
            echo $name;
        }
        else{
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo json_encode($row);
                echo ";";
            }
        }

}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function getCartItems($name){
    try {
        $sql = "SELECT * FROM cart_items WHERE cart_items.owner=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$name]);

        if($stmt->rowCount() == 0){
            echo "User cart is empty";
        }
        else{
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo json_encode($row);
                echo ";";
            }
        }

}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function getUserAlbums($name){
    try {
        $sql = "SELECT * FROM albums WHERE albums.owner=? and albums.status='unsent'";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$name]);

        if($stmt->rowCount() == 0){
            echo "User cart is empty";
        }
        else{
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo json_encode($row);
                echo ";";
            }
        }

}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function getAlbum($id){
    try {
        $sql = "SELECT * FROM albums WHERE albums.id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        if($stmt->rowCount() == 0){
            echo "User cart is empty";
        }
        else{
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo json_encode($row);
                echo ";";
            }
        }

}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function getPhotoRequests(){
    try {
        $sql = "SELECT * FROM requests WHERE requests.status='pending' order by publication_date";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            echo "No requests available";
        }
        else{
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo json_encode($row);
                echo ";";
            }
        }

}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function getPhotos(){
    try {
        $sql = "SELECT * FROM files";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            echo "No requests available";
        }
        else{
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo json_encode($row);
                echo ";";
            }
        }

}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function getSessionRequests(){
    try {
        $sql = "SELECT * FROM photo_sessions WHERE status='pending'";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            echo "No requests available";
        }
        else{
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo json_encode($row);
                echo ";";
            }
        }

}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function getPhotoSessions(){
    try {
        $sql = "SELECT * FROM photo_sessions WHERE STATUS='accepted' order by date desc";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            echo "No requests available";
        }
        else{
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo json_encode($row);
                echo ";";
            }
        }

}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function acceptRequest($id){
    try {
        $sql = "UPDATE requests SET requests.status='accepted' where requests.id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        echo $stmt->rowCount() . " records UPDATED successfully";
}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function acceptSession($id){
    try {
        $sql = "UPDATE photo_sessions SET photo_sessions.status='accepted' where photo_sessions.id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        echo $stmt->rowCount() . " records UPDATED successfully";
}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function denyRequest($id){
    try {
        $sql = "UPDATE requests SET requests.status='denied' where requests.id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        echo $stmt->rowCount() . " records UPDATED successfully";
}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function denySession($id){
    try {
        $sql = "UPDATE photo_sessions SET photo_sessions.status='denied' where photo_sessions.id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        echo $stmt->rowCount() . " records UPDATED successfully";
}catch (PDOException $e) {
    echo $e->getMessage();
}
}
public function submitRequest($id,$name,$image,$description){
    try {
        $sql = "INSERT into requests(`from`, `description`, `image`,`status`) VALUES(?,?,?,'pending')";
        $insertRequestStatement = $this->connection->prepare($sql);
        $insertRequestStatement -> execute([$name,$description,$image]);

        $sql = "DELETE from cart_items where id=?";
        $deleteItemStatement = $this->connection->prepare($sql);
        $deleteItemStatement -> execute([$id]);
        echo $deleteItemStatement->rowCount() . " records UPDATED successfully";
    }catch (PDOException $e) {
    echo $e->getMessage();
}


}

public function submitAlbumRequest($link,$name,$description){
    try {
        $sql = "INSERT into requests(`from`, `description`,`link`,`status`) VALUES(?,?,?,'pending')";
        $insertRequestStatement = $this->connection->prepare($sql);
        $insertRequestStatement -> execute([$name,$description,$link]);

        $sql = "UPDATE albums set `status`='sent' where id=?";
        $updateItemStatement = $this->connection->prepare($sql);
        $updateItemStatement -> execute([$link]);
        echo $updateItemStatement->rowCount() . " records UPDATED successfully";
    }catch (PDOException $e) {
    echo $e->getMessage();
}


}

public function removeItem($id){
    try {
        $sql = "DELETE from cart_items where id=?";
        $deleteItemStatement = $this->connection->prepare($sql);
        $deleteItemStatement -> execute([$id]);
        echo $deleteItemStatement->rowCount() . " records UPDATED successfully";
    }catch (PDOException $e) {
    echo $e->getMessage();
}


}

public function removeAlbum($id){
    try {
        $sql = "DELETE from albums where id=?";
        $deleteItemStatement = $this->connection->prepare($sql);
        $deleteItemStatement -> execute([$id]);
        echo $deleteItemStatement->rowCount() . " records UPDATED successfully";
    }catch (PDOException $e) {
    echo $e->getMessage();
}


}

public function requestSession($requester,$date,$time,$location,$people,$description){
    try {
        $sql = "INSERT INTO photo_sessions (requester,`date`,`time`,`location`,people,`description`,`status`) VALUES (?,?,?,?,?,?,'pending')";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$requester,$date,$time,$location,$people,$description]);
        echo $stmt->rowCount() . " records UPDATED successfully";
}catch (PDOException $e) {
    echo $e->getMessage();
}
}

public function sendToCart($owner,$image,$type,$price){
    try {
        $sql = "INSERT INTO cart_items (`owner`,`image`,`name`,price) VALUES (?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$owner,$image,$type,$price]);
        echo $stmt->rowCount() . " records UPDATED successfully";
}catch (PDOException $e) {
    echo $e->getMessage();
}

}

public function addFile($filename){
    try {
        $sql = "INSERT INTO files (`filename`) VALUES (?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$filename]);
}catch (PDOException $e) {
    echo $e->getMessage();
}

}

public function logAlbum($name,$owner,$pictures,$price){
    try {
        $sql = "INSERT INTO albums (`name`,`owner`,`pictures`,`price`) VALUES (?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$name,$owner,$pictures,$price]);
        echo "Album is logged";
}catch (PDOException $e) {
    echo $e->getMessage();
}

}

}


?>