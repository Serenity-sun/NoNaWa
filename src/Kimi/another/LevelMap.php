<?php

namespace Kimi\another;

use http\Exception\InvalidArgumentException;
use Kimi\generator\Nothing;
use pocketmine\level\generator\normal\Normal;
use pocketmine\Server;

class LevelMap
{

    public const NOTHING = "nothing";
    public const DEFAULT = "default";


    /*
     * генерирует новый мир
     * принимает имя нового мира и тип как аргумент
     * возвращает true если удачно сгенерировался в ином случае такой мир уже создан
     * или ошибка ядро. Метод корректно работает под PocketMine 3.17.2
     */
    public function generate(string $name, string $type = self::NOTHING): bool
    {
        switch ($type)
        {
            case self::NOTHING:
                $generator = ["nothing"];
                $class = Nothing::class;
                break;

            // можно добавить flat

            default:
                $generator = ["default"];
                $class = Normal::class;
                break;
        }

        return Server::getInstance()->generateLevel($name, null, $class, $generator);
    }


    /*
     * выгружает мир
     * принимает название мира и сохранение как аргумент
     * ничего не возвращает
     */
    public function unload(string $name, bool $save = true): bool
    {
        $level = Server::getInstance()->getLevelByName($name);

        if($level === null)
            throw new InvalidArgumentException("мир с названием {$name} отсутствует");

        if ($save === true)
            $level->save(true);

        return Server::getInstance()->unloadLevel($level);
    }
}