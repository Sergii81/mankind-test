<?php

namespace Sergii\MankindTest;
use DateTime;
use Exception;

class Person
{
    /** @var int */
    public int $id;
    /** @var string */
    public string $name;
    /** @var string */
    public string $surname;
    /** @var string */
    public string $sex;
    /** @var string */
    public string $birthDate;

    /** @var string */
    public const MAN = 'M';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $date
     * @throws Exception
     */
    public function setBirthDate(string $date): void
    {
        $date = DateTime::createFromFormat('d.m.Y', $date);
        $now = new DateTime();
        $interval = $now->diff($date);
        $this->birthDate = $interval->days;
    }
}