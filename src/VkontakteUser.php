<?php

namespace mnwb\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

/**
 * @see     https://vk.ru/dev/fields
 *
 * @package illuminati0n\OAuth2\Client\Provider
 */
class VkontakteUser implements ResourceOwnerInterface
{
    /**
     * @type array
     */
    protected $response;

    /**
     * User constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }
    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->response;
    }
    /**
     * @return integer
     */
    public function getId()
    {
        return ($this->getResponseValue('uid') ?: $this->getResponseValue('id'));
    }

    /**
     * @return string|null DD.MM.YYYY
     */
    public function getBirthday(): ?string
    {
        return $this->getResponseValue('bdate');
    }

    /**
     * Get locale.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->getResponseValue('city')['title'].(($this->getResponseValue('city')['title'] && $this->getResponseValue('country')['title']) ? ', ' : '').$this->getResponseValue('country')['title'];
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->getResponseValue('first_name');
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->getResponseValue('last_name');
    }

    /**
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->getResponseValue('nickname');
    }

    /**
     * User's avatar link
     *
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->getResponseValue('photo_max_orig');
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->getResponseValue('screen_name');
    }

    /**
     * @return int 1|2 => woman|man
     */
    public function getGender(): ?string
    {
        return $this->getResponseValue('sex');
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->getResponseValue('email');
    }

    private function getResponseValue($key)
    {
        return $this->response[$key] ?? null;
    }
}
