<?php


namespace Kimi\command;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class BootMap extends Command
{
    use Verify;


    public function __construct(string $name)
    {
        parent::__construct
        (
            $name,
            "§r загрузка и выгрузка мира",
            "§r использование: boot [имя мира] [загрузка = d | выгрузка = u]"
        );
    }


    /*
     * выполнение команды
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if(!$this->checkOP($sender))
            return;

        if(!isset($args[0])) {
            $sender->sendMessage("§l§e|§f использование: boot [имя мира] [загрузка = d | выгрузка = u]");
            return;
        }

        if(!isset($args[1])) {
            $sender->sendMessage("§l§c|§f вы не указали тип действии [загрузка = d | выгрузка = u]");
            return;
        }

        $server = $this->getServer();

        switch ($args[1])
        {
            case "d":
            case "1":
                if($server->loadLevel($args[0]) === true)
                    $sender->sendMessage("§l§9|§f мир §2{$args[0]}§f успешно загружен");
                else
                    $sender->sendMessage("§l§c|§f не существует мира или имеется ошибка");
                break;

            case "u":
            case "0":
                $level = $server->getLevelByName($args[0]);

                if($level === null) {
                    $sender->sendMessage("§l§c|§f нету такого мира");
                }else {

                    if($server->unloadLevel($level) === true)
                        $sender->sendMessage("§l§9|§f мир §2{$args[0]}§f успешно выгружен");
                    else
                        $sender->sendMessage("§l§9|§f мир §2{$args[0]}§f главный или имеется ошибка");
                }

                break;

            default:
                $sender->sendMessage("§l§c|§f неправильно указали тип действии [загрузка = d | выгрузка = u]");
        }
    }
}