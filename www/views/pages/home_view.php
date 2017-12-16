<?php
  /**
   * This is page specific content.
   * @todo let's make this a mustache template or something
   */
  require_once('page_view.php');
  class Home_View extends Page_View {

    /**
     * Content
     *
     * @return string
     */
    public function content() {
      return '
        <section class="Hero">
          <div class="Hero-contentBox">
            <div class="Hero-innerContentBox">
              <h1 class="Hero-header">the next stop on your journey to a healthy life</h1>
              <p class="Hero-copy u-Row--medium">
                The Juice Station is about so much more than just juice. We\'re here to help you get on a path to the healthy life you deserve. From juices, cleanses, and classes to hand delivering your orders right to your door step. We\'re here for you!
              </p>
              <a href="/about" class="Hero-cta">learn about the juice station</a>
            </div>
          </div>
        </section>
        <section class="MenuHero">
          <h1 class="MenuHero-header u-Row--medium">
            the simpliest of ingredients
          </h1>
          <div class="MenuHero-contentBox">
            <p class="MenuHero-row">
              Juice is our passion. That means we take our menu very serious. We only use top notch quality ingredients that will satisfy your taste buds and your body\'s health.
            </p>
            <img src="includes/images/home/ingredients.svg" class="MenuHero-row" />
            <h2 class="MenuHero-row">
              Plant&nbsp;Based &nbsp;&nbsp;No&nbsp;Added&nbsp;Sugar &nbsp;&nbsp;No&nbsp;Artificial&nbsp;Flavors &nbsp;&nbsp;Gluten&nbsp;Free &nbsp;&nbsp;All&nbsp;Natural &nbsp;&nbsp;Vegan
            </h2>
          </div>
          <a href="/healthy-menu" class="MenuHero-cta">view our menu</a>
        </section>
        <section class="CleanseHero" id="js-cleanse-hero">
          <div class="CleanseHero-contentBox">
            <h1 class="CleanseHero-header">
              cleanses
            </h1>
            <p class="CleanseHero-copy u-Row--medium">
              The Juice Station offers many different cleanse programs that will revitalize your mind and body to get you back on track to healthy living. Don\'t wait any longer! Start your cleanse today!
            </p>
            <a href="/juice-cleanse" class="CleanseHero-cta">learn more about our cleanse</a>
          </div>
          <div class="CleanseHero-decor">
            <img src="includes/images/home/lemon_ginger.svg" id="js-cleanse-decor" />
          </div>
        </section>
        <section class="DeliveryHero">
          <div class="DeliveryHero-contentBox">
            <div class="DeliveryHero-innerContentBox">
              <h1 class="DeliveryHero-header">
              deliveries
              </h1>
              <p class="DeliveryHero-copy u-Row--medium">
                Can\'t make it to the store as often as you need your juice station items? No problem! Sign up for our subscription delivery service and we\'ll bring them straight to your door!
              </p>
              <a href="/juice-deliveries" class="DeliveryHero-cta">sign up for juice deliveries</a>
          </div>
          </div>
        </section>
      ';
    }
  }
?>