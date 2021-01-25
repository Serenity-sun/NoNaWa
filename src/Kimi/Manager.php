<?php

namespace Kimi;


use Kimi\command\GenerateMap;
use Kimi\generator\Nothing;
use pocketmine\level\generator\GeneratorManager;
use pocketmine\plugin\PluginBase;

class Manager extends PluginBase
{


    /*
     * действия при включении
     */
    public function onEnable(): void
    {
        GeneratorManager::addGenerator(Nothing::class, "nothing");

        $this->getLogger()->info("плагин No Na Wa успешно запущен");

        $map = $this->getServer()->getCommandMap();

        $map->register("generate", new GenerateMap("generate"));
    }
}