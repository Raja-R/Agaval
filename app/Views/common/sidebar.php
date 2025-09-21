<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?php echo base_url(); ?>/public/assets/img/agaval_logo.png">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Agaval POS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item">
            <a href="<?php echo site_url(); ?>Dashboard" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>


        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Transaction &amp; Pages</span>
        </li>

        <li class="menu-item">
            <a href="<?php echo site_url(); ?>Sales" class="menu-link">
                <i class="menu-icon tf-icons ti ti-calendar"></i>
                <div data-i18n="Orders">Orders</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="<?php echo site_url(); ?>Customer" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-plus"></i>
                <div data-i18n="Customers">Customers</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="<?php echo site_url(); ?>Purchase" class="menu-link">
                <i class="menu-icon tf-icons ti ti-first-aid-kit"></i>
                <div data-i18n="Purchase">Purchase</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="<?php echo site_url(); ?>Suppliers" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-check"></i>
                <div data-i18n="Suppliers">Suppliers</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-chart-pie"></i>
                <div data-i18n="Products">Products</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Product" class="menu-link">
                        <div data-i18n="Product List">Product List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Category" class="menu-link">
                        <div data-i18n="Category List">Category List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Brand" class="menu-link">
                        <div data-i18n="Brand List">Brand List</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="<?php echo site_url(); ?>Invoice" class="menu-link">
                <i class="menu-icon tf-icons ti ti-file-invoice"></i>
                <div data-i18n="Invoice">Invoice</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-file-export"></i>
                <div data-i18n="Expenses">Expenses</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Expenses" class="menu-link">
                        <div data-i18n="Expenses List">List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Expenses/category" class="menu-link">
                        <div data-i18n="Category List">Category List</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Reports</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-chart-pie"></i>
                <div data-i18n="Reports">Reports</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="charts-apex.html" class="menu-link">
                        <div data-i18n="Profit & Loss Report">Profit & Loss Report</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="charts-chartjs.html" class="menu-link">
                        <div data-i18n="Purchase Report">Purchase Report</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="charts-chartjs.html" class="menu-link">
                        <div data-i18n="Sales Report">Sales Report</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">System Setting</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Setting">Setting</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Site/application" class="menu-link">
                        <div data-i18n="Application Setting">Application Setting</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Site/profile" class="menu-link">
                        <div data-i18n="Company Profile">Company Profile</div>
                    </a>
                </li>


                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Site/tax" class="menu-link">
                        <div data-i18n="Tax Setting">Tax Setting</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Site/units" class="menu-link">
                        <div data-i18n="Units Setting">Units Setting</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Site/payment" class="menu-link">
                        <div data-i18n="Payment Setting">Payment Setting</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>Site/email" class="menu-link">
                        <div data-i18n="Email Setting">Email Setting</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="System Users"> System Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>User/list" class="menu-link">
                        <div data-i18n="List">List</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>User/role" class="menu-link">
                        <div data-i18n="Roles">Roles</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo site_url(); ?>User/permission" class="menu-link">
                        <div data-i18n="Permission">Permission</div>
                    </a>
                </li>
            </ul>
        </li>



        <!-- Misc -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Support</span>
        </li>
        <li class="menu-item">
            <a href="#" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons ti ti-help"></i>
                <div data-i18n="Help">Help</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons ti ti-file-description"></i>
                <div data-i18n="FAQ">FAQ</div>
            </a>
        </li>

    </ul>
</aside>