<?php

namespace Kimi;


use Kimi\generator\Nothing;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\generator\GeneratorManager;
use pocketmine\plugin\PluginBase;

class Manager extends PluginBase
{


    public function onEnable()
    {
        GeneratorManager::addGenerator(Nothing::class, "nothing");

    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName())
        {
            case "generate":
                break;
        }

        return true;
    }
}