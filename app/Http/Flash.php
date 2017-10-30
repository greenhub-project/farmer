<?php

namespace App\Http;

class Flash
{
    /**
     * Create flash  session.
     * @param  string       $title
     * @param  string       $text
     * @param  string       $type
     * @param  string|null  $key
     * @return void
     */
    public function create($title, $text, $type, $key = 'flash_message')
    {
        session()->flash($key, [
            'title'  => $title,
            'text'   => $text,
            'type'   => $type,
        ]);
    }

    /**
     * Create a warning flash message.
     * @param  string   $title
     * @param  string   $text
     * @return mixed
     */
    public function warning($title, $text)
    {
        return $this->create($title, $text, 'warning');
    }

    /**
     * Create an error flash message.
     * @param  string   $title
     * @param  string   $text
     * @return mixed
     */
    public function error($title, $text)
    {
        return $this->create($title, $text, 'error');
    }

    /**
     * Create a warning flash message.
     * @param  string   $title
     * @param  string   $text
     * @return mixed
     */
    public function success($title, $text)
    {
        return $this->create($title, $text, 'success');
    }

    /**
     * Create an info flash message.
     * @param  string   $title
     * @param  string   $text
     * @return mixed
     */
    public function info($title, $text)
    {
        return $this->create($title, $text, 'info');
    }

    /**
     * Create an overlay flash message.
     * @param  string   $title
     * @param  string   $text
     * @param  string   $type
     * @return mixed
     */
    public function overlay($title, $text, $type = 'info')
    {
        return $this->create($title, $text, $type, 'flash_overlay');
    }
}