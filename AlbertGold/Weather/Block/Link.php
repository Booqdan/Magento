<?php


namespace AlbertGold\Weather\Block;

class Link extends \Magento\Framework\View\Element\Html\Link
{
    /**
     * Render block HTML.
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (false != $this->getTemplate()) {
            return parent::_toHtml();
        }
        $label = $this->escapeHtml($this->getLabel());
        return '<li><a ' . $this->getLinkAttributes() . ' >' . $label . '</a></li>';
    }
}
