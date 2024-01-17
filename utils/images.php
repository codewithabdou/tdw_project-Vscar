<?php

class ImagesTraitement
{

    public function uploadImage($image, $dir)
    {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/vscar' . $dir;
        $target_file = $target_dir . basename($_FILES[$image]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$image]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
                echo "File is an image - " . $check["mime"] . ".";
            } else {
                $uploadOk = 0;
                throw new ErrorException("File is not an image.");
            }
        }

        if (file_exists($target_file)) {
            $uploadOk = 0;
            echo "Sorry, file already exists.";
        }


        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "webp"
        ) {
            $uploadOk = 0;
            throw new ErrorException("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        if ($uploadOk == 0) {

        } else {
            if (move_uploaded_file($_FILES[$image]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES[$image]["name"])) . " has been uploaded.";
                unset($_FILES[$image]);
            } else {
            }
        }
    }
}