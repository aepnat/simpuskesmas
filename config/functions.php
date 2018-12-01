<?php

/*
    Upload an image and create the thumbnail. The thumbnail is stored
    under the thumbnail sub-directory of $uploadDir.

    Return the uploaded image name and the thumbnail also.
*/
function uploadImage($inputName, $uploadDir)
{
    $image = $_FILES[$inputName];
    $imagePath = '';
    $thumbnailPath = '';

    // if a file is given
    if (trim($image['tmp_name']) != '') {
        $ext = substr(strrchr($image['name'], '.'), 1);

        // generate a random new file name to avoid name conflict
        // then save the image under the new file name
        $imagePath = '';
        $result = move_uploaded_file($image['tmp_name'], $uploadDir.$imagePath);

        if ($result) {
            // create thumbnail
            $thumbnailPath = '';
            $result = createThumbnail($uploadDir.$imagePath, $uploadDir.'thumbnail/'.$thumbnailPath, THUMBNAIL_WIDTH);

            // create thumbnail failed, delete the image
            if (!$result) {
                unlink($uploadDir.$imagePath);
                $imagePath = $thumbnailPath = '';
            } else {
                $thumbnailPath = $result;
            }
        } else {
            // the image cannot be uploaded
            $imagePath = $thumbnailPath = '';
        }
    }

    return ['image' => $imagePath, 'thumbnail' => $thumbnailPath];
}

/*
    Create a thumbnail of $srcFile and save it to $destFile.
    The thumbnail will be $width pixels.
*/
function createThumbnail($srcFile, $destFile, $width, $quality = 75)
{
    $thumbnail = '';

    if (file_exists($srcFile) && isset($destFile)) {
        $size = getimagesize($srcFile);
        $w = number_format($width, 0, ',', '');
        $h = number_format(($size[1] / $size[0]) * $width, 0, ',', '');

        $thumbnail = copyImage($srcFile, $destFile, $w, $h, $quality);
    }

    // return the thumbnail file name on sucess or blank on fail
    return basename($thumbnail);
}

/*
    Copy an image to a destination file. The destination
    image size will be $w X $h pixels
*/
function copyImage($srcFile, $destFile, $w, $h, $quality = 100)
{
    $tmpSrc = pathinfo(strtolower($srcFile));
    $tmpDest = pathinfo(strtolower($destFile));
    $size = getimagesize($srcFile);

    if ($tmpDest['extension'] == 'gif' || $tmpDest['extension'] == 'jpg') {
        $destFile = substr_replace($destFile, 'jpg', -3);
        $dest = imagecreatetruecolor($w, $h);
    //imageantialias($dest, TRUE);
    } elseif ($tmpDest['extension'] == 'png') {
        $dest = imagecreatetruecolor($w, $h);
    //imageantialias($dest, TRUE);
    } else {
        return false;
    }

    switch ($size[2]) {
        case 1:       //GIF
           $src = imagecreatefromgif($srcFile);
            break;
        case 2:       //JPEG
           $src = imagecreatefromjpeg($srcFile);
            break;
        case 3:       //PNG
           $src = imagecreatefrompng($srcFile);
            break;
        default:
           return false;
            break;
    }

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);

    switch ($size[2]) {
        case 1:
       case 2:
           imagejpeg($dest, $destFile, $quality);
            break;
        case 3:
           imagepng($dest, $destFile);
    }

    return $destFile;
}
