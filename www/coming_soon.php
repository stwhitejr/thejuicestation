 <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $view->page_title() ?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
    <link href="includes/css/coming_soon.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <div class="Wrap">
      <section>
        <img src="includes/images/logo.svg" alt="The Juice Station" class="Logo" />
        <h1>Website and New Pembroke Location Coming Soon!</h1>
        <p class="Intro">
          We're happy to announce The Juice Station will be opening it's first location at
          <emphasis>808&nbsp;Washington&nbsp;St, Pembroke,&nbsp;MA</emphasis> in January 2018!
        </p>
        <p class="Intro">
          We're hard at work getting the website and new location up and running but here's a sneak peak at just some of the services we'll have to offer. Also, don't forgot to sign up below for updates on our opening date!
        </p>
      </section>
      <section>
        <div class="flex">
          <div class="flex_col">
          <ul>
            <li>Fresh Juice</li>
            <li>Smoothies</li>
            <li>Cleanses</li>
            <li>Shots</li>
            <li>Subscription Delivery Service</li>
          </ul>
        </div>
      </section>
      <section>
        <p id="js-signup-text">
          Sign up to recieve updates on the opening of The Juice Station!
        </p>
        <form>
          <input type="text" name="email" id="js-signup-email" placeholder="Enter email address" />
          <button type="submit" id="js-signup-submit">Submit</button>
        </form>
      </section>
    </div>
    <script type="text/javascript" src="includes/js/coming_soon.js"></script>
  </body>
  </html>