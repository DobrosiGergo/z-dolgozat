<?php

namespace App;

class Template
{
    public $layout;

    public $title;

    function __construct($title = 'Sheetstack', $layout = 'empty')
    {
        $layout = './views/layouts/' . $layout . '.php';

        if (!isset($this->content_filters)) $this->content_filters = array();

        $this->layout = $layout;
        $this->title = $title;

        ob_start();
        register_shutdown_function(array($this, 'layout_shutdown'));
    }

    public function apply_content_filters($in)
    {
        foreach ($this->content_filters as $filter) {
            $in = call_user_func($filter, $in);
        }
        return $in;
    }

    public function layout_shutdown()
    {

        $content = $this->apply_content_filters(ob_get_contents());

        ob_end_clean();

        if (is_null($this->layout)) {
            echo $content;
            return;
        }

        foreach (headers_list() as $header)
            if (preg_match('/^Location/', $header)) return;

        $title = $this->title;
        require $this->layout;
    }
}
