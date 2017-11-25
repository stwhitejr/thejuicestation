<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      <?=$page_title?>
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
    <link href="includes/css/home.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <div class="Wrap">
      <header class="Header u-FlexBox">
        <div class="Logo">
          <img src="includes/images/logo.svg" alt="The Juice Station" class="Logo-img" />
        </div>
        <nav class="Nav">
          <div class="Nav-inner">
            <?php
            foreach ($nav_items as $nav) {
            ?>
              <a href="/<?=$nav['url']?>" class="Nav-item">
                <?=$nav['text']?>
              </a>
            <?php
            }
            ?>
          </div>
        </nav>
      </header>
      <?php require_once($content_view) ?>
      <footer>
      </footer>
    </div>
  </body>
</html>