<?php

/**
 * @package MultiStripeByKeys
 */

namespace Includes\Api;

class MSBK_SettingsApi
{
    public $admin_page = [];

    public $admin_subpages = [];

    public $settings = [];

    public $sections = [];

    public $fields = [];

    public function register()
    {
        if (!empty($this->admin_page)) {
            add_action('admin_menu', [$this, 'add_admin_menu']);
        }

        if (!empty($this->settings)) {
            add_action('admin_init', [$this, 'registerCustomFields']);
        }
    }

    public function addPage(array $page)
    {
        $this->admin_page = $page;

        return $this;
    }

    public function withSubPage(string $title = null)
    {
        if (empty($this->admin_page)) {
            return $this;
        }

        $subpage = [[
            "parent_slug"   => $this->admin_page['menu_slug'],
            "page_title"    => $this->admin_page['page_title'],
            "menu_title"    => ($title) ? $title : $this->admin_page['menu_title'],
            "capability"    => $this->admin_page['capability'],
            "menu_slug"     => $this->admin_page['menu_slug'],
            "callback"      => $this->admin_page['callback']
        ]];

        $this->admin_subpages = $subpage;

        return $this;
    }

    public function addSubPages(array $subpages)
    {
        $this->admin_subpages = array_merge($this->admin_subpages, $subpages);
        return $this;
    }

    public function add_admin_menu()
    {
        add_menu_page(
            $this->admin_page['page_title'],
            $this->admin_page['menu_title'],
            $this->admin_page['capability'],
            $this->admin_page['menu_slug'],
            $this->admin_page['callback'],
            $this->admin_page['icon_url'],
            $this->admin_page['position']
        );

        foreach ($this->admin_subpages as $subpage) {
            add_submenu_page(
                $subpage['parent_slug'],
                $subpage['page_title'],
                $subpage['menu_title'],
                $subpage['capability'],
                $subpage['menu_slug'],
                $subpage['callback']
            );
        }
    }

    public function setSettings( array $settings )
    {
        $this->settings = $settings;

        return $this;
    }

    public function setSections( array $sections )
    {
        $this->sections = $sections;

        return $this;
    }

    public function setFields( array $fields )
    {
        $this->fields = $fields;

        return $this;
    }

    public function registerCustomFields()
    {
        foreach ($this->settings as $setting) {
            register_setting(
                $setting["option_group"],
                $setting["option_name"],
                (isset($setting["callback"]) ? $setting["callback"] : '')
            );
        }

        foreach ($this->sections as $section) {
            add_settings_section(
                $section["id"],
                $section["title"],
                (isset($section["callback"]) ? $section["callback"] : ''),
                $section["page"]
            );
        }

        foreach ($this->fields as $field) {
            add_settings_field(
                $field["id"],
                $field["title"],
                (isset($field["callback"]) ? $field["callback"] : ''),
                $field["page"],
                $field["section"],
                (isset($field["args"]) ? $field["args"] : '')
            );
        }
    }
}
