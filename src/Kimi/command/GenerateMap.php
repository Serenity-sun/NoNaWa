<?php

namespace Kimi\command;

use Kimi\another\LevelMap;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class GenerateMap extends Command
{


    public function __construct(string $name)
    {
        parent::__construct
        (
            $name,
            "generate",
            "использование: generate [имя мира] [тип генерации: nothing | default]"
        );
    }


    /*
     * выполнение команды
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if(!isset($args[0])) {
            $sender->sendMessage("использование: generate [имя мира] [тип генерации: nothing | default]");
            return;
        }

        if(!isset($args[1])) {
            $sender->sendMessage("вы не указали тип генерации [nothing | default]");
            return;
        }

        if($sender instanceof Player) {
            if(!$sender->isOp()) {
                $sender->sendMessage("только операторы могут использовать эту команду");
                return;
            }
        }

        $map = new LevelMap();

        switch ($args[0])
        {
            case "nothing":
                $map->generate($args[0], LevelMap::NOTHING);
                break;

            case "default":
                $map->generate($args[0], LevelMap::DEFAULT);
                break;

            default:
                $sender->sendMessage("неправильно указали тип генерации");
        }
    }
}