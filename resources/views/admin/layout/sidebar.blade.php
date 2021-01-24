  
  @php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
  @endphp


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('img/pos.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Inventoy | POS System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item {{ ($prefix == '/suppliers') ? 'menu-is-opening menu-open': '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manage Supplier
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('suppliers.view') }}" class="nav-link {{ ($route == 'suppliers.view') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Supplier</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ ($prefix == '/customers') ? 'menu-is-opening menu-open': '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manage Customer
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customers.view') }}" class="nav-link {{ ($route == 'customers.view') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('customers.credit') }}" class="nav-link {{ ($route == 'customers.credit') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Credit Customer</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ ($prefix == '/units') ? 'menu-is-opening menu-open': '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manage Unit
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('units.view') }}" class="nav-link {{ ($route == 'units.view') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Unit</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item {{ ($prefix == '/categorys') ? 'menu-is-opening menu-open': '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manage Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('categorys.view') }}" class="nav-link {{ ($route == 'categorys.view') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item {{ ($prefix == '/products') ? 'menu-is-opening menu-open': '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manage Product
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('products.view') }}" class="nav-link {{ ($route == 'products.view') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item {{ ($prefix == '/purchases') ? 'menu-is-opening menu-open': '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manage Purchase
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('purchases.view') }}" class="nav-link {{ ($route == 'purchases.view') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Purchase</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('purchases.pendingList') }}" class="nav-link {{ ($route == 'purchases.pendingList') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval Purchase</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('purchases.daily_report') }}" class="nav-link {{ ($route == 'purchases.daily_report') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daily Purchase Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ ($prefix == '/invoices') ? 'menu-is-opening menu-open': '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manage Invoice
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('invoices.view') }}" class="nav-link {{ ($route == 'invoices.view') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('invoices.pendingList') }}" class="nav-link {{ ($route == 'invoices.pendingList') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('invoices.printList') }}" class="nav-link {{ ($route == 'invoices.printList') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice Print</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('invoices.daily_report') }}" class="nav-link {{ ($route == 'invoices.daily_report') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daily Invoice Report</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item {{ ($prefix == '/stock') ? 'menu-is-opening menu-open': '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manage Stock
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('stock.report') }}" class="nav-link {{ ($route == 'stock.report') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('stock.criteria') }}" class="nav-link {{ ($route == 'stock.criteria') ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Report Criteria</p>
                </a>
              </li>
            </ul>
          </li>


        </ul>t
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>