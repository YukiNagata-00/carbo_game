<?php
// $top_url = "/carbo_project/top/php/index.php";
$top_url = "/carbo_project/views/top.php";

?>
<!-- ハンバーガーボタン -->
<button type="button" class="drawer-toggle drawer-hamburger">
    <img src="" alt="">
    <span class="sr-only">toggle navigation</span>
    <span class="drawer-hamburger-icon"></span>
</button>
<!-- ナビゲーションの中身 -->
<nav class="drawer-nav" role="navigation">
    <ul class="drawer-menu">
    <li><a class="drawer-brand" href="#">Menu</a></li>
    <li><a class="drawer-menu-item" href="<?= $top_url ?>">トップページ</a></li>
    <li><a class="drawer-menu-item" href="#">プロフィール</a></li>
    <li><a class="drawer-menu-item" href="logout.php">ログアウト</a></li>
    </ul>
</nav>

