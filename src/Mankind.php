<?php

namespace Sergii\MankindTest;

use Exception;
use Generator;

class Mankind
{
    /** @var array */
    private array $humans;
    /** @var Mankind|null */
    private static ?Mankind $instance = null;
    /** @var string  */
    public const MAN = 'M';
    /** @var Generator  */
    private Generator $generator;

    protected function __construct()
    {
        $this->generator = $this->readCsv('src/humans.csv');
        foreach ($this->generator as $data) {
            $this->humans[$data[0]] = [
                'name' => $data[1],
                'surname' => $data[2],
                'sex' => $data[3],
                'birthDate' => $data[4]
            ];
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

    /**
     * @param string $fileName
     * @param string $delimiter
     * @return Generator
     */
    public function readCsv(string $fileName, string $delimiter = ';'): Generator
    {
        $file = fopen($fileName, "r");
        if ($file !== false) {
            while (($data = fgetcsv($file, 0, $delimiter)) !== false) {
                yield $data;
            }
            fclose($file);
        }
    }
}