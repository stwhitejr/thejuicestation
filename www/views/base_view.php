<DOCTYPE html>
<html>
  <head>
    <title>
      <?=$page_title?>
    </title>
  </head>
  <body>
    <header>
      <nav>
        <?php
        foreach ($nav_items as $nav) {
        ?>
          <a href="/<?=$nav['url']?>" class="Nav">
            <?=$nav['text']?>
          </a>
        <?php
        }
        ?>
      </nav>
    </header>
    <?php require_once($content_view) ?>
    <footer>
    </footer>
  </body>
</html>