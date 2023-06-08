<?php

namespace Sergii\MankindTest;

use Exception;

class Mankind
{
    /** @var false|resource */
    private $file;
    /** @var array */
    private array $humans;
    /** @var Mankind|null */
    private static ?Mankind $instance = null;
    /** @var string  */
    public const MAN = 'M';

    protected function __construct()
    {
        $this->file = fopen("src/humans.csv", "r");
        if ($this->file !== false) {
            while (($data = fgetcsv($this->file, 1000, ';')) !== false) {
                $this->humans[$data[0]] = [
                    'name' => $data[1],
                    'surname' => $data[2],
                    'sex' => $data[3],
                    'birthDate' => $data[4]
                ];
            }
            fclose($this->file);
        }
    }

    /**
     * @return void
     */
    protected function __clone()
    {
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * @return Mankind|null
     */
    public static function getInstance(): ?Mankind
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return float|int
     */
    public function getThePercentageOfMenInMankind(): float|int
    {
        $countMen = 0;
        if (! empty($this->humans)) {
            foreach ($this->humans as $human) {
                if ($human['sex'] == self::MAN) {
                    $countMen++;
                }
            }

            return $countMen / count($this->humans) * 100;
        } else {

            return 0;
        }
    }

    /**
     * @param int $id
     * @return array|Exception
     * @throws Exception
     */
    public function getPersonById(int $id): array|Exception
    {
        $humanIds = array_keys($this->humans);
        if (! in_array($id, $humanIds)) {
            throw new Exception('The Person does\'t exist');
        }
        foreach (array_chunk($this->humans, 100, true) as $humanChunk) {
            foreach ($humanChunk as $humanId => $human) {
                if ($id == $humanId) {
                    $human = array_merge(['id' => $humanId], $human);
                    $person = Person::fromArray($human);

                    return $person->toArray();
                }
            }
        }
    }
}