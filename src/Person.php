<?php

namespace Sergii\MankindTest;

use DateTime;

class Person
{
    /**
     * @param int $id
     * @param string $name
     * @param string $surname
     * @param string $sex
     * @param string $birthDay
     * @param string $age
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $surname,
        public string $sex,
        public string $birthDay,
        public string $age
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
            birthDay: $data['birthDate'],
            age: self::getAgeInDays($data['birthDate'])
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
    /**
     * @return string
     */
    public function getAge(): string
    {
        return $this->age;
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
     * @return string
     */
    public function getBirthDay(): string
    {
        return $this->birthDay;
    }

    /**
     * @param string $date
     * @return int|bool
     */
    public static function getAgeInDays(string $date): int|bool
    {
        $date = DateTime::createFromFormat('d.m.Y', $date);
        $now = new DateTime();
        $interval = $now->diff($date);

        return $interval->days;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}