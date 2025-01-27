<?php


namespace WPlugin\Controllers\Render;

abstract class AbstractRender implements InterfaceRender
{
    protected bool $hasEnqueue = true;

    protected function enqueueScripts(array $script): void
    {
        $link = isset($script['external']) ? $script['external'] : wptConfig()->distUrl($script['file']);
        wp_enqueue_script($script['name'], $link);
    }

    protected function enqueueStyles(array $style): void
    {
        $link = isset($style['external']) ? $style['external'] : wptConfig()->distUrl($style['file']);
        wp_enqueue_style($style['name'], $link);
    }

    private function enqueueDefault(): void
    {
        if ($this->hasEnqueue) {
            $this->enqueueStyles(['name' => 'tailwind', 'file' => 'app.css']);
        }
    }

    public function render(string $file, array $data): string
    {
        $this->enqueueDefault();
        return wptUtils()->render($file, $data);
    }
}
