<?php


namespace Kimi\command;


use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

trait Verify
{

    /*
     * проверка на оператора. Если игрок не оператор то возвращает false
     */
    public function checkOP(CommandSender $sender): bool
    {
        if($sender instanceof Player) {
            if(!$sender->isOp()) {
                $sender->sendMessage("§l§c|§f только операторы могут использовать эту команду");
                return false;
            }
        }

        return true;
    }


    /*
     * вернет сервер через синглтон
     */
    public function getServer(): Server
    {
        return Server::getInstance();
    }
}