<?php

namespace Kimi;


use Kimi\another\LevelMap;
use Kimi\generator\Nothing;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\generator\GeneratorManager;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Manager extends PluginBase
{


    public function onEnable(): void
    {
        GeneratorManager::addGenerator(Nothing::class, "nothing");
        $this->getLogger()->info("плагин No Na Wa успешно запущен");
    }


    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if($sender instanceof Player)
            return false;

        switch ($command->getName())
        {
            //генерация нового мира
            case "generate":
                if(isset($args[0])) {

                    $map = new LevelMap();

                    if(isset($args[1])) {
                        $map->generate($args[0], $args[1]);
                    }else{
                        $sender->sendMessage("вы не указали тип генерации. Поставлена [nothing]");
                        $map->generate($args[0]);
                    }
                }else{
                    $sender->sendMessage("синтаксис: generate [имя мира] [тип генерации: nothing | default]");
                }
                break;


            // выгрузка мира
            case "unload":
                if(isset($args[0])) {

                    $map = new LevelMap();

                    if(isset($args[1])) {
                        switch ($args[1])
                        {
                            case "yes":
                            case "y":
                            case "1":
                                $map->unload($args[0], true);
                                break;
                            default:
                                $map->unload($args[0], false);
                                $sender->sendMessage("мир не сохранен и выгружен");
                        }
                    }else{
                        $map->unload($args[0], false);
                        $sender->sendMessage("мир не сохранен и выгружен");
                    }
                }else{
                    $sender->sendMessage("синтаксис: unload [имя мира] [сохранение: y - да | n - нет]");
                }
                break;
        }

        return false;
    }
}