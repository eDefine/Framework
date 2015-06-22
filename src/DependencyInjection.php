<?php

use Edefine\Framework\Dependency\Container;
use Edefine\Framework\Dependency\Injection;

class DependencyInjection extends Injection
{
    public static function initContainer()
    {
        $container = parent::initContainer();

        self::initRepositories($container);

        $container->add('settingManager', new Service\SettingManager(
            $container->get('manager'),
            $container->get('settingRepository')
        ));

        $container->add('transactionManager', new Service\TransactionManager(
            $container->get('manager'),
            $container->get('logger'),
            $container->get('flashBag')
        ));

        $container->add('loginHandler', new Service\LoginHandler(
            $container->get('manager'),
            $container->get('userRepository'),
            $container->get('session'),
            $container->get('cookie'),
            $container->get('flashBag'),
            $container->get('logger')
        ));

        $container->add('messageSender', new Service\MessageSender(
            $container->get('manager'),
            $container->get('userRepository'),
            $container->get('mailer')
        ));

        $container->add('transactionImporter', new Transaction\CsvImporter(
            $container->get('manager')
        ));

        $container->add('weightConsolidation', new Weight\Consolidation(
            $container->get('manager'),
            $container->get('weightRepository')
        ));

        self::initTwigExtensions($container);
        self::initEventDispatcher($container);

        return $container;
    }

    private static function initTwigExtensions(Container $container)
    {
        $twig = $container->get('twig');

        $twig->addExtension(new View\Extension\UserExtension(
            $container->get('session'),
            $container->get('userRepository'),
            $container->get('messageRepository')
        ));

        $twig->addExtension(new View\Extension\UtilExtension(
            $container->get('settingManager')
        ));
    }

    private static function initRepositories(Container $container)
    {
        $container->add('categoryRepository', new Repository\CategoryRepository('Entity\Category', $container->get('database')));
        $container->add('countryRepository', new Repository\CountryRepository('Entity\Country', $container->get('database')));
        $container->add('mealProductRepository', new Repository\MealProductRepository('Entity\MealProduct', $container->get('database')));
        $container->add('mealRepository', new Repository\MealRepository('Entity\Meal', $container->get('database')));
        $container->add('messageRepository', new Repository\MessageRepository('Entity\Message', $container->get('database')));
        $container->add('productRepository', new Repository\ProductRepository('Entity\Product', $container->get('database')));
        $container->add('settingRepository', new Repository\SettingRepository('Entity\Setting', $container->get('database')));
        $container->add('transactionRepository', new Repository\TransactionRepository('Entity\Transaction', $container->get('database')));
        $container->add('userRepository', new Repository\UserRepository('Entity\User', $container->get('database')));
        $container->add('weightRepository', new Repository\WeightRepository('Entity\Weight', $container->get('database')));
    }

    private static function initEventDispatcher(Container $container)
    {
        $dispatcher = $container->get('dispatcher');

        $dispatcher
            ->addListener(new Event\RememberMeListener($container->get('loginHandler')))
            ->addListener(new Event\LastActivityListener($container->get('manager'), $container->get('userRepository')));
    }
}