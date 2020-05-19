<?php
$role_id = $this->session->userdata('role_id');

// Query Menu
$this->db->select('user_menu.id, menu');
$this->db->from('user_menu');
$this->db->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id');
$this->db->where('user_access_menu.role_id', $role_id);
$this->db->order_by('user_access_menu.menu_id', 'asc');

$menu = $this->db->get()->result_array();


?>
<div class="sidebar-section">
    <div class="sidebar-section__scroll">

        <div>
            <?php foreach ($menu as $m) : ?>
                <div class="sidebar-section__separator"><?= $m['menu']; ?></div>
                <?php // Query Sub Menu
                $menu_id = $m['id'];
                $this->db->select('*');
                $this->db->from('user_sub_menu');
                $this->db->where('menu_id', $menu_id);
                $this->db->where('is_active', 1);

                $submenu = $this->db->get()->result_array(); ?>
                <?php foreach ($submenu as $sm) : ?>
                    <ul class="sidebar-section-nav">
                        <li class="sidebar-section-nav__item <?= $title === $sm['title'] ? 'is-active' : ''; ?>">
                            <a class="sidebar-section-nav__link" href="<?= base_url($sm['url']); ?>">
                                <span class="sidebar-section-nav__item-icon <?= $sm['icon']; ?>"></span>
                                <span class="sidebar-section-nav__item-text"><?= $sm['title']; ?></span>
                            </a>
                        </li>
                    </ul>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <div class="sidebar-section__separator">Lainnya</div>


            <ul class="sidebar-section-nav">
                <li class="sidebar-section-nav__item">
                    <a class="sidebar-section-nav__link" href="<?= base_url('signout'); ?>">
                        <span class="sidebar-section-nav__item-icon iconfont-log-out"></span>
                        <span class=" sidebar-section-nav__item-text">Signout</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>

</div>