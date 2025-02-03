<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <li class="nav-item active">
                <a  href="{{route('dashboard')}}"  class=" confirm-leave-link  menu {{ request()->routeIs('dashboard') ? 'sidebar_active' : '' }}" aria-expanded="false">
                    <span class="group-icons dashboard-icon-tag"></span>
                    <p>Dashboard</p>
                </a>
            </li>
            
            <!-- @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'Products')
                        <li class="nav-item">
                            <a  href="{{ route('products.index') }}" class="collapsed menu {{ request()->routeIs('products.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('products.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('products.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                                <span class="group-icons product-icon-tag"></span>
                                <p>Products</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            @else
                @can('Products')
                
                    <li class="nav-item">
                        <a  href="{{ route('products.index') }}" class="collapsed menu {{ request()->routeIs('products.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('products.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('products.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                            <span class="group-icons product-icon-tag"></span>
                            <p>Products</p>
                        </a>
                    </li>
                @endcan
            @endif -->
            @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'Customers')
                        <li class="nav-item">
                            <a data-bs-toggle="collapse"  href="#customer" class="collapsed menu customer-link  {{ request()->routeIs('customers.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('customers.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('customers.edit') ? 'sidebar_active' : '' }}{{ request()->routeIs('customerOrder.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('customerOrder.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('customerOrder.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                                <span class="group-icons customer-icon-tag"></span>
                                <p>Customers</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('customers.create') ? 'show' : '' }}{{ request()->routeIs('customers.index') ? 'show' : '' }}{{ request()->routeIs('customers.edit') ? 'show' : '' }} {{ request()->routeIs('customerOrder.index') ? 'show' : '' }}{{ request()->routeIs('customerOrder.create') ? 'show' : '' }}{{ request()->routeIs('customerOrder.edit') ? 'show' : '' }}" id="customer">
                                <ul class="nav nav-collapse">
                                    <li class="">
                                        <a href="{{ route('customers.create') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('customers.create') ? 'dropdown_active' : '' }}"><span class="sub-item">New Customers</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('customers.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('customers.index') ? 'dropdown_active' : '' }}"><span class="sub-item">List of Customers</span></a>
                                    </li>
                                    <li>
                                        <a href="{{route('customerOrder.index')}}" class="collapsed menu confirm-leave-link {{ request()->routeIs('customerOrder.index') ? 'dropdown_active' : '' }}{{ request()->routeIs('customerOrder.create') ? 'dropdown_active' : '' }}{{ request()->routeIs('customerOrder.edit') ? 'dropdown_active' : '' }}"><span class="sub-item">Orders</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @endforeach
            @else
                @can('Customers')
                    <li  class="nav-item">
                        <a data-bs-toggle="collapse" href="#customer" class="collapsed menu customer-link  {{ request()->routeIs('customers.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('customers.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('customers.edit') ? 'sidebar_active' : '' }}{{ request()->routeIs('customerOrder.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('customerOrder.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('customerOrder.edit') ? 'sidebar_active' : '' }}" aria-expanded="true">
                            <span class="group-icons customer-icon-tag"></span>
                            <p>Customers</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('customers.create') ? 'show' : '' }}{{ request()->routeIs('customers.index') ? 'show' : '' }}{{ request()->routeIs('customers.edit') ? 'show' : '' }}{{ request()->routeIs('customerOrder.index') ? 'show' : '' }}{{ request()->routeIs('customerOrder.create') ? 'show' : '' }}{{ request()->routeIs('customerOrder.edit') ? 'show' : '' }}" id="customer">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('customers.create') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('customers.create') ? 'dropdown_active' : '' }} "><span class="sub-item ">New Customers</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('customers.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('customers.index') ? 'dropdown_active' : '' }}"><span class="sub-item">List of Customers</span></a>
                                </li>
                                <li>
                                    <a href="{{route('customerOrder.index')}}" class="collapsed menu confirm-leave-link {{ request()->routeIs('customerOrder.index') ? 'dropdown_active' : '' }}{{ request()->routeIs('customerOrder.create') ? 'dropdown_active' : '' }}{{ request()->routeIs('customerOrder.edit') ? 'dropdown_active' : '' }}"><span class="sub-item">Orders</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
            @endif
            @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'Suppliers')
                 
            <li class="nav-item">
                <a  href="{{ route('suppliers.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('suppliers.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('suppliers.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('suppliers.edit') ? 'sidebar_active' : '' }}"  aria-expanded="false">
                    <span class="group-icons Suppliers-icon-tag"></span>
                    <p>Suppliers</p>
                </a>
            </li>
                    @endif
                @endforeach
            @else
                @can('Suppliers')
                    <li class="nav-item">
                        <a  href="{{ route('suppliers.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('suppliers.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('suppliers.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('suppliers.edit') ? 'sidebar_active' : '' }}"  aria-expanded="false">
                            <span class="group-icons Suppliers-icon-tag"></span>
                            <p>Suppliers</p>
                        </a>
                    </li>

                @endcan
            @endif

            @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'Group-Pricing')
                        <li class="nav-item">
                            <a  href="{{route('price-list.index')}}" class="collapsed menu confirm-leave-link {{ request()->routeIs('price-list.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('price-list.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('price-list.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                                <span class="group-icons grouppricing-icon-tag"></span>
                                <p>Group Pricing</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            @else
                @can('Group-Pricing')
                    <li class="nav-item">
                        <a href="{{route('price-list.index')}}" class="collapsed menu confirm-leave-link {{ request()->routeIs('price-list.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('price-list.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('price-list.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                            <span class="group-icons grouppricing-icon-tag"></span>
                            <p>Group Pricing</p>
                        </a>
                    </li>
                @endcan
            @endif
            @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'Manufacture')
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#manufacture" class="collapsed menu customer-link{{ request()->routeIs('laminations.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('laminations.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('laminations.edit') ? 'sidebar_active' : '' }}{{ request()->routeIs('products.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('products.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('products.edit') ? 'sidebar_active' : '' }}{{ request()->routeIs('production_order.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('production_order.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('production_order.edit') ? 'sidebar_active' : '' }}{{ request()->routeIs('material.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('material.edit') ? 'sidebar_active' : '' }}{{ request()->routeIs('material.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('materialStock.index') ? 'sidebar_active' : '' }} " aria-expanded="false">
                                <span class="group-icons manufacture-icon-tag"></span>
                                <p>Manufacture</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('laminations.create') ? 'show' : '' }}{{ request()->routeIs('laminations.index') ? 'show' : '' }}{{ request()->routeIs('laminations.edit') ? 'show' : '' }}{{ request()->routeIs('products.create') ? 'show' : '' }}{{ request()->routeIs('products.index') ? 'show' : '' }}{{ request()->routeIs('products.edit') ? 'show' : '' }}{{ request()->routeIs('production_order.create') ? 'show' : '' }}{{ request()->routeIs('production_order.index') ? 'show' : '' }}{{ request()->routeIs('production_order.edit') ? 'show' : '' }}{{ request()->routeIs('material.create') ? 'show' : '' }}{{ request()->routeIs('material.index') ? 'show' : '' }}{{ request()->routeIs('material.edit') ? 'show' : '' }}{{ request()->routeIs('materialStock.index') ? 'show' : '' }}" id="manufacture">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('products.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('products.index') ? 'dropdown_active' : '' }}{{ request()->routeIs('products.create') ? 'dropdown_active' : '' }}{{ request()->routeIs('products.edit') ? 'dropdown_active' : '' }}"><span class="sub-item">Products</span></a>
                                    </li>
                                    <li>
                                        <a href="{{route('production_order.index')}}"class="collapsed menu confirm-leave-link {{ request()->routeIs('production_order.index') ? 'dropdown_active' : '' }}{{ request()->routeIs('production_order.create') ? 'dropdown_active' : '' }}{{ request()->routeIs('production_order.edit') ? 'dropdown_active' : '' }}"><span class="sub-item">Work Orders</span></a>
                                    </li>
                                    <li>
                                        <a href="{{route('material.index')}}"class="collapsed menu confirm-leave-link {{ request()->routeIs('material.index') ? 'dropdown_active' : '' }}{{ request()->routeIs('material.create') ? 'dropdown_active' : '' }}{{ request()->routeIs('material.edit') ? 'dropdown_active' : '' }}"><span class="sub-item">Materials</span></a>
                                    </li>
                                    <li>
                                        <a href="{{route('materialStock.index')}}"class="collapsed menu confirm-leave-link {{ request()->routeIs('materialStock.index') ? 'dropdown_active' : '' }}"><span class="sub-item">Materials Stock</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('laminations.index') }}"class="collapsed menu confirm-leave-link {{ request()->routeIs('laminations.index') ? 'dropdown_active' : '' }}{{ request()->routeIs('laminations.create') ? 'dropdown_active' : '' }}{{ request()->routeIs('laminations.edit') ? 'dropdown_active' : '' }}"><span class="sub-item">Laminations</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><span class="sub-item">Work Center</span></a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    @endif
                @endforeach
            @else
                @can('Manufacture')
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#manufacture" class="collapsed menu {{ request()->routeIs('laminations.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('laminations.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('laminations.edit') ? 'sidebar_active' : '' }}{{ request()->routeIs('products.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('products.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('products.edit') ? 'sidebar_active' : '' }}{{ request()->routeIs('production_order.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('production_order.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('production_order.edit') ? 'sidebar_active' : '' }}{{ request()->routeIs('material.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('material.edit') ? 'sidebar_active' : '' }}{{ request()->routeIs('material.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('materialStock.index') ? 'sidebar_active' : '' }} " aria-expanded="false">
                            <span class="group-icons manufacture-icon-tag"></span>
                            <p>Manufacture</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('products.create') ? 'show' : '' }}{{ request()->routeIs('products.index') ? 'show' : '' }}{{ request()->routeIs('products.edit') ? 'show' : '' }}{{ request()->routeIs('laminations.create') ? 'show' : '' }}{{ request()->routeIs('laminations.index') ? 'show' : '' }}{{ request()->routeIs('laminations.edit') ? 'show' : '' }}{{ request()->routeIs('production_order.create') ? 'show' : '' }}{{ request()->routeIs('production_order.index') ? 'show' : '' }}{{ request()->routeIs('production_order.edit') ? 'show' : '' }}{{ request()->routeIs('material.create') ? 'show' : '' }}{{ request()->routeIs('material.index') ? 'show' : '' }}{{ request()->routeIs('material.edit') ? 'show' : '' }}{{ request()->routeIs('materialStock.index') ? 'show' : '' }}" id="manufacture">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('products.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('products.index') ? 'dropdown_active' : '' }}{{ request()->routeIs('products.create') ? 'dropdown_active' : '' }}{{ request()->routeIs('products.edit') ? 'dropdown_active' : '' }}"><span class="sub-item">Products</span></a>
                                </li>
                                <li  >
                                    <a href="{{route('production_order.index')}}" class="collapsed menu confirm-leave-link {{ request()->routeIs('production_order.index') ? 'dropdown_active' : '' }}{{ request()->routeIs('production_order.create') ? 'dropdown_active' : '' }}{{ request()->routeIs('production_order.edit') ? 'dropdown_active' : '' }}"><span class="sub-item">Work Orders</span></a>
                                </li>
                                <li>
                                    <a href="{{route('material.index')}}"class="collapsed menu confirm-leave-link {{ request()->routeIs('material.index') ? 'dropdown_active' : '' }}{{ request()->routeIs('material.create') ? 'dropdown_active' : '' }}{{ request()->routeIs('material.edit') ? 'dropdown_active' : '' }}"><span class="sub-item">Materials</span></a>
                                </li>
                                <li>
                                    <a href="{{route('materialStock.index')}}"class="collapsed menu confirm-leave-link {{ request()->routeIs('materialStock.index') ? 'dropdown_active' : '' }}"><span class="sub-item">Materials Stock</span></a>
                                </li>
                                <li>
                                    <a href="{{route('laminations.index')}}"class="collapsed menu confirm-leave-link {{ request()->routeIs('laminations.index') ? 'dropdown_active' : '' }}{{ request()->routeIs('laminations.create') ? 'dropdown_active' : '' }}{{ request()->routeIs('material.edit') ? 'dropdown_active' : '' }}"><span class="sub-item">Laminations</span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><span class="sub-item">Work Center</span></a>
                                </li>
                                
                            </ul>
                        </div>
                    </li>
                @endcan
            @endif

            @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'Reports')
                        <li class="nav-item">
                            <a href="{{route( 'reports.index')}}" class="collapsed menu confirm-leave-link {{ request()->routeIs('reports.index') ? 'sidebar_active' : '' }}" aria-expanded="false">
                                <span class="group-icons report-icon-tag"></span>
                                <p>Reports</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            @else
                @can('Reports')
                    <li class="nav-item">
                        <a  href="{{route( 'reports.index')}}" class="collapsed menu confirm-leave-link  {{ request()->routeIs('reports.index') ? 'sidebar_active' : '' }}" aria-expanded="false">
                            <span class="group-icons report-icon-tag"></span>
                            <p>Reports</p>
                        </a>
                    </li>
                @endcan
            @endif
            <li class="nav-item">
                <a href="{{route( 'recipes.index')}}" class="collapsed menu confirm-leave-link {{ request()->routeIs('recipes.index') ? 'sidebar_active' : '' }}" aria-expanded="false">
                    <span class="group-icons report-icon-tag"></span>
                    <p>Recipe Master</p>
                </a>
            </li>
            @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'Staff-Management')
                        <li class="nav-item active">
                            <a href="{{ route('staff-management.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('staff-management.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('staff-management.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('staff-management.edit') ? 'sidebar_active' : '' }}"  aria-expanded="false">

                                <span class="group-icons staff-icon-tag"></span>
                                <p>Staff Management</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            @else
                @can('Staff-Management')
                    <li class="nav-item active">
                        <a href="{{ route('staff-management.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('staff-management.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('staff-management.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('staff-management.edit') ? 'sidebar_active' : '' }}"  aria-expanded="false">

                            <span class="group-icons staff-icon-tag"></span>
                            <p>Staff Management</p>
                        </a>
                    </li>
                @endcan
            @endif
            @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'Role')
                        <li class="nav-item active">
                            <a  href="{{ route('roles.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('roles.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('roles.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('roles.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                                <span class="group-icons staff-icon-tag"></span>
                                <p>Role</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            @else
                @can('Role')
                    <li class="nav-item active">
                        <a  href="{{ route('roles.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('roles.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('roles.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('roles.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                            <span class="group-icons staff-icon-tag"></span>
                            <p>Role</p>
                        </a>
                    </li>
                @endcan
            @endif

            @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'Permissions')
                        <li class="nav-item active">
                            <a  href="{{ route('permissions.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('permissions.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('permissions.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('permissions.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                                <span class="group-icons staff-icon-tag"></span>
                                <p>Permission</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            @else
                @can('Permissions')
                    <li class="nav-item active">
                        <a  href="{{ route('permissions.index') }}" class="collapsed menu confirm-leave-link {{ request()->routeIs('permissions.index') || request()->routeIs('permissions.create') || request()->routeIs('permissions.edit') ? 'sidebar_active' : '' }}
                            " aria-expanded="false">
                            <span class="group-icons staff-icon-tag"></span>
                            <p>Permission</p>
                        </a>
                    </li>
                @endcan
            @endif

            @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'transport')
                        <li class="nav-item">
                            <a  href="{{ route('transport.index') }}" class="collapsed confirm-leave-link menu {{ request()->routeIs('transport.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('transport.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('transport.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                                <span class="group-icons transpot-icon-tag"></span>
                                <p>Transport</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            @else
                @can('transport')
                    <li class="nav-item">
                        <a  href="{{ route('transport.index') }}" class="collapsed confirm-leave-link menu {{ request()->routeIs('transport.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('transport.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('transport.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                            <span class="group-icons transpot-icon-tag"></span>
                            <p>Transport</p>
                        </a>
                    </li>
                @endcan
            @endif
            
            @if (auth()->user()->permissions->isNotEmpty())
                @foreach (auth()->user()->permissions as $permission)
                    @if ($permission->name === 'Settings')
                        <li class="nav-item">
                            <a  href="{{ route('settings.index') }}" class="collapsed confirm-leave-link menu {{ request()->routeIs('settings.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('settings.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('settings.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                                <span class="group-icons setting-icon-tag"></span>
                                <p>Settings</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            @else
                @can('Settings')
                    <li class="nav-item">
                        <a  href="{{ route('settings.index') }}" class="collapsed confirm-leave-link menu {{ request()->routeIs('settings.index') ? 'sidebar_active' : '' }}{{ request()->routeIs('settings.create') ? 'sidebar_active' : '' }}{{ request()->routeIs('settings.edit') ? 'sidebar_active' : '' }}" aria-expanded="false">
                            <span class="group-icons setting-icon-tag"></span>
                            <p>Settings</p>
                        </a>
                    </li>
                @endcan
            @endif
            
            
        </ul>
    </div>
</div>
<script>
    $(document).ready(function(){
    // Open the dropdown when the 'Customers' link gains focus
        $('.customer-link').on('focus', function () {
            var collapseDiv = $(this).attr('href');
            // $('.menu').removeClass('dropdown_active');
            // $(this).addClass('dropdown_active');
            $(collapseDiv).collapse('show'); // Open the dropdown
        });

        // Close the dropdown when focus leaves both the menu link and submenu
        $('.customer-link').on('blur', function () {
            var collapseDiv = $(this).attr('href');
            setTimeout(function() {
                if (!$(collapseDiv).find(':focus').length && !$(collapseDiv).prev().is(':focus')) {
                    $(collapseDiv).collapse('hide'); // Close the dropdown if no focus inside or on link
                }
            }, 100);
        });

        // Keep the dropdown open when focusing within the submenu
        $('.nav-collapse a').on('focus', function() {
            var collapseDiv = $(this).closest('.collapse');
            $(this).addClass('dropdown_active');
            collapseDiv.collapse('show'); // Ensure it's open
        });

        // Close the dropdown when focus leaves the submenu
        $('.nav-collapse a').on('blur', function() {
            var collapseDiv = $(this).closest('.collapse');
            $(this).removeClass('dropdown_active');
            setTimeout(function() {
                if (!collapseDiv.find(':focus').length && !collapseDiv.prev().is(':focus')) {
                    collapseDiv.collapse('hide'); // Close if no focus inside or on the main link
                }
            }, 100);
        });
    });

</script>