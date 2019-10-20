<li>
    <a role="button" tabindex="0"><i class="fa fa-user"></i>
        <span>مدیریت کاربران</span></a>
    <ul>
            <li><a href="<?= Url('/home/admin/users' ); ?>"><i
                            class="fa fa-caret-right"></i>  کاربران سایت</a>
            </li>

            <li><a href="<?= Url('/home/admin/managers' ); ?>"><i
                            class="fa fa-caret-right"></i> کاربران پنل</a>
            </li>

            <li><a href="<?= route('rolePermission.role.index') ?>"><i
                            class="fa fa-caret-right"></i>نقش های کاربران پنل</a>
            </li>

            <li><a href="<?= route('favoritesports.index') ?>"><i
                            class="fa fa-caret-right"></i>ورزش های مورد علاقه کاربر</a>
            </li>

    </ul>
</li>