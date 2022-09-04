<body>
<div class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header">
        <div class="logo"><h1>Dashboard - Admin Template</h1></div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
</div>
<div class="template-page-wrapper">
    <div class="navbar-collapse collapse templatemo-sidebar">
        <ul class="templatemo-sidebar-menu">

            <li class="<?php echo $menu1;?>"><a href="/admin/"><i class="fa fa-home"></i>Каталог организаций</a></li>
            <li class="<?php echo $menu4;?>"><a href="/admin/categories"><i class="fa fa-home"></i>Категории</a></li>
            <li class="<?php echo $menu3;?>"><a href="/admin/reviews"><i class="fa fa-cog"></i>Отзывы</a></li>
            <li class="<?php echo $menu2;?>"><a href="/admin/settings"><i class="fa fa-cog"></i>Настройки сайта</a></li>

            <li class="sub open">
                <a href="javascript:;">
                    <i class="fa fa-database"></i> Nested Menu
                    <div class="pull-right"><span class="caret"></span></div>
                </a>
                <ul class="templatemo-submenu">
                    <li><a href="#">Aenean</a></li>
                    <li><a href="#">Pellentesque</a></li>
                    <li><a href="#">Congue</a></li>
                    <li><a href="#">Interdum</a></li>
                    <li><a href="#">Facilisi</a></li>
                </ul>
            </li>
            <li><a href="data-visualization.html"><i class="fa fa-cubes"></i><span class="badge pull-right">9</span>Data
                    Visualization</a></li>
            <li><a href="maps.html"><i class="fa fa-map-marker"></i><span class="badge pull-right">42</span>Maps</a>
            </li>
            <li><a href="tables.html"><i class="fa fa-users"></i><span class="badge pull-right">NEW</span>Manage
                    Users</a></li>

            <li><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Sign
                    Out</a></li>
        </ul>
    </div><!--/.navbar-collapse -->