<?php


namespace App\DTO\Request;

class CreatePromoRequest
{
    private $title;

    private $mainText;

    private $category;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getMainText()
    {
        return $this->mainText;
    }

    /**
     * @param mixed $mainText
     */
    public function setMainText($mainText): void
    {
        $this->mainText = $mainText;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }
}
