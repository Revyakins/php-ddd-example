<?php


namespace App\Contract\Response;

use JsonSerializable;

/**
 * Класс контракт для ответа клиенту
 *
 * Class PromoResponse
 * @package App\Contract\Response
 */
class PromoResponse  implements JsonSerializable
{
    private $id = null;

    private $active = null;

    private $title = null;

    private $mainText = null;

    private $category = null;

    private $status = null;

    /**
     * @param mixed $id
     * @return PromoResponse
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $title
     * @return PromoResponse
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param mixed $mainText
     * @return PromoResponse
     */
    public function setMainText($mainText)
    {
        $this->mainText = $mainText;
        return $this;
    }

    /**
     * @param mixed $category
     * @return PromoResponse
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @param mixed $status
     * @return PromoResponse
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}