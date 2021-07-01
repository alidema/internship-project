<?php 
    if(isset($_POST["submit"])){
        $itemName = $_POST["item_name"];
        $itemIngridients = $_POST["item_ingridients"];
        $image = $_FILES["image"]["name"];
        $target = "uploads/".basename($_FILES["image"]["name"]);
        $itemPrice = $_POST["item_price"];
        $itemCategorie = $_POST["item_categorie"];
        $businessId = $_SESSION["userid"];

        if(empty($postTitle)){
            $_SESSION["errorMessage"] = "Title can't be empty";
            header("location: posts.php");
        }else if(strlen($postTitle) < 5){
            $_SESSION["errorMessage"] = "Post title should be greater  than 5 characters";
            header("location: posts.php");
        }else if(strlen($category) >9999){ 
            $_SESSION["errorMessage"] = "Post description should be less than 10000 characters";
            header("location: posts.php");
        }else{
            global $conn;
            if(!empty($_FILES["image"]["name"])){
                $sql = "UPDATE posts
                    SET title='$postTitle', category='$category', image = '$image', post='$post'
                    WHERE id = '$idFromURL'";
                }else{
                    $sql = "UPDATE posts
                            SET title='$title', category='$category', post='$post'
                            WHERE id = '$idFromURL'";
                }
            $Execute = $conn->query($sql);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target);
            if($Execute){
                $_SESSION["successMessage"] = "Post Updated Successfuly";
                header("location: posts.php");
            }else{
                $_SESSION["errorMessage"] = "Something went wrong. Try again!";
                header("location: editPost.php?id=<?php echo $idFromURL ?>");
            }
        }
    }//Ending of Submit button If-Condition
?>