<?php

namespace Shx\Admin\Grid\Displayers;

use Shx\Admin\Admin;

class Upload extends AbstractDisplayer
{
    public function display($multiple = false)
    {
        return Admin::component('admin::grid.inline-edit.upload', [
            'key' => $this->getKey(),
            'name' => $this->getPayloadName(),
            'value' => $this->getValue(),
            'target' => "inline-upload-{$this->getKey()}",
            'resource' => $this->getResource(),
            'multiple' => $multiple,
        ]);
    }
}
