<?php

namespace Sergii\MankindTest;

use DateTime;
use Exception;

class Person
{
    /**
     * @param int $id
     * @param string $name
     * @param string $surname
     * @param string $sex
     * @param string $birthDate
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $surname,
        public string $sex,
        public string $birthDate
    ) {
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new static(
            id: $data['id'],
            name: $data['name'],
            surname: $data['surname'],
            sex: $data['sex'],
            birthDate: $data['birthDate']
        );
    }


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

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}