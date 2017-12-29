<?php
  /**
   */
  require_once('page_view.php');
  class Menu_View extends Page_View {

    private $template_name = 'menu';
    // This will pull from somewhere at some point
    public $menu = [
      ['category' => 'juice', 'items' =>
        [
          ['name' => 'the green juice', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In earum voluptatibus repudiandae expedita nisi at voluptatem architecto odio id tenetur, iste vel libero velit.'],
          ['name' => 'the green juice', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In earum voluptatibus repudiandae expedita nisi at voluptatem architecto odio id tenetur, iste vel libero velit.'],
          ['name' => 'the green juice', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In earum voluptatibus repudiandae expedita nisi at voluptatem architecto odio id tenetur, iste vel libero velit.'],
          ['name' => 'the green juice', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In earum voluptatibus repudiandae expedita nisi at voluptatem architecto odio id tenetur, iste vel libero velit.']
        ]
      ],
      ['category' => 'shots', 'items' =>
        [
          ['name' => 'the green shots', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In earum voluptatibus repudiandae expedita nisi at voluptatem architecto odio id tenetur, iste vel libero velit.'],
          ['name' => 'the green shots', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In earum voluptatibus repudiandae expedita nisi at voluptatem architecto odio id tenetur, iste vel libero velit.'],
          ['name' => 'the green shots', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In earum voluptatibus repudiandae expedita nisi at voluptatem architecto odio id tenetur, iste vel libero velit.'],
          ['name' => 'the green shots', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In earum voluptatibus repudiandae expedita nisi at voluptatem architecto odio id tenetur, iste vel libero velit.']
        ]
      ]
    ];
    /**
     * Content
     *
     * @return string
     */
    public function content() {
      return $this->render_mustache($this->template_name, $this);
    }
  }
?>