<?php

namespace App\Services;

class Media
{
    // work on file data ($_FILE) array
    private array $file;
    private string $fileType;
    private string $fileExtension;
    private float $fileSize;
    private array $errors = [];
    private string $fileName;
    /**
     * Get the value of file
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */
    public function setFile($file)
    {
        $this->file = $file;
        $array = explode('/', $this->file['type']); // [image , jpg]
        $this->fileExtension = $array[1];
        $this->fileType = $array[0];
        $this->fileSize = $this->file['size'];
        return $this;
    }



    /**
     * Get the value of fileExtension
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * Set the value of fileExtension
     *
     * @return  self
     */
    public function setFileExtension($fileExtension)
    {
        $this->fileExtension = $fileExtension;

        return $this;
    }

    /**
     * Get the value of fileType
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * Set the value of fileType
     *
     * @return  self
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * Get the value of fileSize
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set the value of fileSize
     *
     * @return  self
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }
    public function size(int $maxSize)
    {
        if ($this->fileSize > $maxSize) {
            $this->errors[__FUNCTION__] = 'max size' . $maxSize . 'byte';
        }
        return $this;
    }
    public function extension(array $avialableExtensions): self
    {
        if (!in_array($this->fileExtension, $avialableExtensions)) {
            $this->errors[__FUNCTION__] = 'Available Extensions Are: ' . implode(',', $avialableExtensions);
        }
        return $this;
    }

    public function upload(string $pathTo): bool // 
    {
        $this->fileName = uniqid() . '.' . $this->fileExtension; // uniqid() generate uniqe id
        $pathTo .= $this->fileName; // img/users/uniqid that return
        return move_uploaded_file($this->file['tmp_name'], $pathTo); //image from and image to built in fun
    }

    public function delete(string $path): bool
    {
        if (file_exists($path)) { // file_exists -> check the path of image is exists or not
            unlink($path); // delete the path (image)
            return true;
        }
        return false;
    }
    /**
     * Get the value of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Get the value of fileName
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @return  self
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }
    public function getError(string $error): ?string
    {
        return $this->errors[$error] ?? NULL;
    }
}
