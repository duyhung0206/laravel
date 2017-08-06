<?php

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;

//Menu::macro('fullsubmenuexample', function () {
//    return Menu::new()->prepend('<a href="#"><span> Multilevel PROVA </span> <i class="fa fa-angle-left pull-right"></i></a>')
//        ->addParentClass('treeview')
//        ->add(Link::to('/link1prova', 'Link1 prova'))->addClass('treeview-menu')
//        ->add(Link::to('/link2prova', 'Link2 prova'))->addClass('treeview-menu')
//        ->url('http://www.google.com', 'Google');
//});

Menu::macro('adminlteSubmenu', function ($submenuName) {
    return Menu::new()->prepend('<a href="#"><span> ' . $submenuName . '</span> <i class="fa fa-angle-left pull-right"></i></a>')
        ->addParentClass('treeview')->addClass('treeview-menu');
});
Menu::macro('adminlteMenu', function () {
    return Menu::new()
        ->addClass('sidebar-menu');
});
Menu::macro('adminlteSeparator', function ($title) {
    return Html::raw($title)->addParentClass('header');
});

Menu::macro('adminlteDefaultMenu', function ($content) {
    return Html::raw('<i class="fa fa-link"></i><span>' . $content . '</span>')->html();
});

Menu::macro('sidebar', function () {
    return Menu::adminlteMenu()
        ->add(Html::raw('MAIN NAVIGATION')->addParentClass('header'))
        ->action('HomeController@index', '<i class="fa fa-home"></i><span>Dashboard</span>')
        ->add(Menu::adminlteSeparator('MANAGE'))
        #adminlte_menu
        /*customer*/
        ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-user"></i><span>Customer</span> <i class="fa fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('customer/listcustomers', '<i class="fa fa-th-list"></i><span>List customers</span>'))->addClass('treeview-menu')
            ->add(Link::toUrl('customer/pagecreate', '<i class="fa fa-plus-circle"></i><span>Add new customer</span>'))
            ->add(Link::toUrl('order/listorders', '<i class="fa fa-wpforms"></i><span>List orders</span>'))
            ->add(Link::toUrl('order/pagecreateorder', '<i class="fa fa-plus-circle"></i><span>Add new order</span>'))
        )
        /*supplier*/
        ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-truck"></i><span>Supplier</span> <i class="fa fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('supplier/listsuppliers', '<i class="fa fa-th-list"></i><span>List suppliers</span>'))->addClass('treeview-menu')
            ->add(Link::toUrl('supplier/pagecreate', '<i class="fa fa-plus-circle"></i><span>Add new supplier</span>'))
            ->add(Link::toUrl('order/listPOs', '<i class="fa fa-wpforms"></i><span>List PO</span>'))
            ->add(Link::toUrl('order/pagecreatePO', '<i class="fa fa-plus-circle"></i><span>Add new PO</span>'))
        )
        /*product*/
        ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-leaf"></i><span>Product</span> <i class="fa fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('product/listproducts', '<i class="fa fa-th-list"></i><span>List products</span>'))->addClass('treeview-menu')
            ->add(Link::toUrl('product/pagecreate', '<i class="fa fa-plus-circle"></i><span>Add new product</span>'))
        )
        /*order*/
//        ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-file-text-o"></i><span>Order</span> <i class="fa fa-angle-left pull-right"></i></a>')
//            ->addParentClass('treeview')
//            ->add(Link::toUrl('', '<i class="fa fa-th-list"></i><span>List orders</span>'))->addClass('treeview-menu')
//            ->add(Link::toUrl('', '<i class="fa fa-th-list"></i><span>List purchaseorders</span>'))->addClass('treeview-menu')
//            ->add(Link::toUrl('', '<i class="fa fa-plus-circle"></i><span>Add new order</span>'))
//        )

        ->add(Menu::adminlteSeparator('SETTING'))
        /*setting*/
        ->add(Link::toUrl('setting', '<i class="fa fa-cogs"></i><span>Setting</span>'))
        ->add(Menu::adminlteSeparator('USER'))
        ->add(Menu::new()->prepend('<a href="#" onclick="event.preventDefault();document.getElementById(\'logout-form\').submit();"><i class="fa fa-sign-out"></i><span>Logout</span></a>'))
//
















        //        ->add(
//            Menu::fullsubmenuexample()
//        )
//        ->add(Menu::adminlteSeparator('SECONDARY MENU'))
//        ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-share"></i><span>Manage customer</span> <i class="fa fa-angle-left pull-right"></i></a>')
//            ->addParentClass('treeview')
//            ->add(Link::toUrl('customer', '<span>List customer</span>'))->addClass('treeview-menu')
//            ->add(Link::to('/link2', 'Link2'))
//            ->url('http://www.google.com', 'Google')
//            ->add(Menu::new()->prepend('<a href="#"><span>Multilevel 2</span> <i class="fa fa-angle-left pull-right"></i></a>')
//                ->addParentClass('treeview')
//                ->add(Link::to('/link21', 'Link21'))->addClass('treeview-menu')
//                ->add(Link::to('/link22', 'Link22'))
//                ->url('http://www.google.com', 'Google')
//            )
//        )
//        ->add(
//            Menu::adminlteSubmenu('Best menu')
//                ->add(Link::to('/acacha', 'acacha'))
//                ->add(Link::to('/profile', 'Profile'))
//                ->url('http://www.google.com', 'Google')
//        )
        ->setActiveFromRequest();
});
