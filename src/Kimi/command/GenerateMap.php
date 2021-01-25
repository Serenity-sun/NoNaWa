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
            "§rгенерация нового мира",
            "§rиспользование: generate [имя мира] [тип генерации: nothing | default]"
        );
    }


    /*
     * выполнение команды
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if($sender instanceof Player) {
            if(!$sender->isOp()) {
                $sender->sendMessage("§l§c|§f только операторы могут использовать эту команду");
                return;
            }
        }

        if(!isset($args[0])) {
            $sender->sendMessage("§l§c|§f использование: generate [имя мира] [тип генерации: nothing | default]");
            return;
        }

        if(!isset($args[1])) {
            $sender->sendMessage("§l§c|§f вы не указали тип генерации [nothing | default]");
            return;
        }

        switch ($args[0])
        {
            case "nothing":
                (new LevelMap())->generate($args[0], LevelMap::NOTHING);
                break;

            case "default":
                (new LevelMap())->generate($args[0], LevelMap::DEFAULT);
                break;

            default:
                $sender->sendMessage("§l§c|§f неправильно указали тип генерации");
                return;
        }

        $sender->sendMessage("§l§9|§f мир §2{$args[0]}§f сгенерирован с типом {$args[1]}");
    }
}