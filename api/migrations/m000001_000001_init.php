<?php

use yii\db\Migration;

class m000001_000001_init extends Migration
{
    public function safeUp()
    {
        // Получаем путь к консольному скрипту Yii
        $yiiConsole = Yii::getAlias('@app/yii'); // или '@app/../yii', если yii находится на уровень выше

        // Команда для применения миграций из @yii/rbac/migrations
        $command = "php {$yiiConsole} migrate --migrationPath=@yii/rbac/migrations --interactive=0";

        // Выполняем команду
        exec($command, $output, $returnCode);

        // Проверяем результат выполнения
        if ($returnCode !== 0) {
            echo "Ошибка при выполнении миграций RBAC:\n" . implode("\n", $output) . "\n";
            return false;
        }

        echo "Миграции RBAC успешно применены.\n";
        return true;
    }

    public function safeDown()
    {
        // Получаем путь к консольному скрипту Yii
        $yiiConsole = Yii::getAlias('@app/yii'); // или '@app/../yii', если yii находится на уровень выше

        // Команда для отката миграций из @yii/rbac/migrations
        $command = "php {$yiiConsole} migrate/down all --migrationPath=@yii/rbac/migrations --interactive=0";

        // Выполняем команду
        exec($command, $output, $returnCode);

        // Проверяем результат выполнения
        if ($returnCode !== 0) {
            echo "Ошибка при откате миграций RBAC:\n" . implode("\n", $output) . "\n";
            return false;
        }

        echo "Миграции RBAC успешно откачены.\n";
        return true;
    }
}