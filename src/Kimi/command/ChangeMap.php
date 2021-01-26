<?php


namespace Kimi\command;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class ChangeMap extends Command
{
    use Verify;


    public function __construct(string $name)
    {
        parent::__construct
        (
            $name,
            "§r телепортация в другой мир",
            "§r использование: change [имя мира]"
        );
    }


    /*
     * выполнение команды
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender instanceof Player) {
            $sender->sendMessage("§l§c|§f невозможно же телепортировать консоль");
            return;
        }

        if(!$sender->isOp()) {
            $sender->sendMessage("§l§c|§f только операторы могут использовать эту команду");
            return;
        }

        if(!isset($args[0])) {
            $sender->sendMessage("§l§e|§f использование: change [имя мира]");
            return;
        }

        $level = $this->getServer()->getLevelByName($args[0]);

        if($level === null){
            $sender->sendMessage("§l§c|§f такой мир отсутсвует");
            return;
        }

        if($level->getName() === $sender->getLevel()->getName()) {
            $sender->sendMessage("§l§c|§f вы уже в этом мире");
            return;
        }

        $sender->sendMessage("§l§9|§f телепортация..");
        $sender->teleport($level->getSpawnLocation());
    }
}