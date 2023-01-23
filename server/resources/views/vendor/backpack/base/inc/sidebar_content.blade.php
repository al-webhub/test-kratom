<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="divider"></li>
<li class="nav-title">Коммерция</li>
<!-- START AIMIX SHOP -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-store"></i> Магазин</a>
	<ul class="nav-dropdown-items">
	  <li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class='nav-icon las la-shopping-bag'></i> Товары</a></li>
	  <li class='nav-item'><a class='nav-link' href='{{ backpack_url('category') }}'><i class='nav-icon las la-tags'></i> Категории</a></li>
	  <li class='nav-item'><a class='nav-link' href='{{ backpack_url('attribute') }}'><i class='nav-icon las la-tag'></i> Атрибуты</a></li>
<!--     <li class='nav-item'><a class='nav-link' href='{{ backpack_url('order') }}'><i class='nav-icon las la-shopping-cart'></i> Заказы</a></li> -->
	</ul>
</li>

<li class='nav-item'>
	<a class='nav-link' href='{{ backpack_url('transaction') }}'>
		<i class='nav-icon las la-exchange-alt'></i> Транзакции
		<span class="badge badge-{{ $transactions > 0? 'warning' : 'light' }}" style="position:initial">{{ $transactions }}</span>
	</a>
</li>
<!-- END AIMIX SHOP -->

<li class="divider"></li>
<li class="nav-title">Сайт</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i class="nav-icon la la-newspaper-o"></i> Статьи</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('profile') }}"><i class="nav-icon la la-user"></i> Пользователи</a></li>
<!-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon fa fa-file-o'></i> <span>Страницы</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('menu-item') }}'><i class='nav-icon fa fa-list'></i> <span>Меню</span></a></li> -->

<!-- START AIMIX FEEDBACK -->
<!-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('feedback') }}'><i class='nav-icon las la-envelope-open-text'></i> Обратная связь</a></li> -->
<!-- END AIMIX FEEDBACK -->

<!-- START AIMIX REVIEW -->
<!-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('review') }}'><i class='nav-icon las la-comments'></i> Отзывы</a></li> -->
<!-- END AIMIX REVIEW -->

<!-- START AIMIX PROMOTION -->
<!-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('promotion') }}'><i class='nav-icon fa fa-question'></i> Акции</a></li> -->
<!-- END AIMIX PROMOTION -->



<!-- START AIMIX BANNER -->
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('banner') }}'><i class='nav-icon la la-desktop'></i> Баннеры</a></li>
<!-- END AIMIX BANNER -->
<!-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('faq') }}'><i class='nav-icon fa fa-question'></i> Faqs</a></li> -->

<li class="divider"></li>
<li class="nav-title">Управление</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> Настройки</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-group"></i> Администрация</a>
	<ul class="nav-dropdown-items">
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Пользователи</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-group"></i> <span>Роли</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Права</span></a></li>
	</ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i class='nav-icon la la-hdd-o'></i> Копии</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i> Логи</a></li>