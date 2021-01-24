<?php


namespace Kimi\generator;


use pocketmine\level\generator\Generator;
use pocketmine\math\Vector3;

class Nothing extends Generator
{


    public function __construct(array $settings = [])
    {
    }

    public function generateChunk(int $chunkX, int $chunkZ): void
    {
    }

    public function populateChunk(int $chunkX, int $chunkZ): void
    {

    }

    public function getSettings(): array
    {
        return [];
    }

    public function getName(): string
    {
        return "nothing";
    }

    public function getSpawn(): Vector3
    {
        return new Vector3(0, 80, 0);
    }
}