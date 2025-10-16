@extends('layout.master')
@section('title', 'Role-wise Menu Permissions')

@section('main-section')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">🔐 Manage Menu Permissions by Role</h5>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.map-role-permission.store') }}">
                                @csrf

                                {{-- Role Selection --}}
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">Select Role</label>
                                    <select name="role_id" class="form-control" required>
                                        <option value="">-- Select Role --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Menus List --}}
                                <div class="menu-tree border rounded p-3">
                                    <h6 class="fw-bold mb-3">Select Menus to Assign</h6>
                                    <ul class="list-unstyled">
                                        @foreach ($menus as $menu)
                                            <li>
                                                <div class="form-check mb-1 d-flex align-items-center">
                                                    @if ($menu->children->count())
                                                        <button type="button" class="toggle-btn btn p-0 me-2"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#menu-children-{{ $menu->id }}"
                                                            aria-expanded="false"
                                                            style="background: transparent; border: none; width: 50px; height: 25px; font-size: 16px; display:flex; align-items:center; justify-content:center;">
                                                            <i class="ti ti-chevron-right"></i>
                                                        </button>
                                                    @else
                                                        <span class="me-2"
                                                            style="width: 25px; display: inline-block;"></span>
                                                    @endif

                                                    <input class="form-check-input menu-checkbox" type="checkbox"
                                                        name="menu_ids[]" id="menu-{{ $menu->id }}"
                                                        value="{{ $menu->id }}">
                                                    <label class="form-check-label fw-semibold ms-2"
                                                        for="menu-{{ $menu->id }}">
                                                        {{ $menu->title }}
                                                    </label>
                                                </div>

                                                {{-- Submenus --}}
                                                @if ($menu->children->count())
                                                    <ul class="collapse ms-4" id="menu-children-{{ $menu->id }}">
                                                        @foreach ($menu->children as $submenu)
                                                            <li>
                                                                <div class="form-check mb-1 d-flex align-items-center">
                                                                    @if ($submenu->children->count())
                                                                        <button type="button"
                                                                            class="toggle-btn btn p-0 me-2"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#submenu-children-{{ $submenu->id }}"
                                                                            aria-expanded="false"
                                                                            style="background: transparent; border: none; width: 25px; height: 25px; font-size: 16px; display:flex; align-items:center; justify-content:center;">
                                                                            <i class="ti ti-chevron-right"></i>
                                                                        </button>
                                                                    @else
                                                                        <span class="me-2"
                                                                            style="width: 25px; display: inline-block;"></span>
                                                                    @endif

                                                                    <input class="form-check-input submenu-checkbox"
                                                                        type="checkbox" name="menu_ids[]"
                                                                        id="submenu-{{ $submenu->id }}"
                                                                        value="{{ $submenu->id }}">
                                                                    <label class="form-check-label ms-2"
                                                                        for="submenu-{{ $submenu->id }}">
                                                                        {{ $submenu->title }}
                                                                    </label>
                                                                </div>

                                                                {{-- Level 3 Children --}}
                                                                @if ($submenu->children->count())
                                                                    <ul class="collapse ms-4"
                                                                        id="submenu-children-{{ $submenu->id }}">
                                                                        @foreach ($submenu->children as $child)
                                                                            <li>
                                                                                <div class="form-check mb-1">
                                                                                    <input
                                                                                        class="form-check-input child-checkbox"
                                                                                        type="checkbox" name="menu_ids[]"
                                                                                        id="child-{{ $child->id }}"
                                                                                        value="{{ $child->id }}">
                                                                                    <label class="form-check-label ms-2"
                                                                                        for="child-{{ $child->id }}">
                                                                                        {{ $child->title }}
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>


                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="ti ti-check"></i> Save Permissions
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CSS for clarity --}}
    <style>
        .menu-tree ul {
            list-style-type: none;
            margin: 0;
            padding-left: 15px;
        }

        .menu-tree label {
            cursor: pointer;
        }
    </style>
    <script>
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                icon.classList.toggle('ti-chevron-right');
                icon.classList.toggle('ti-chevron-down');
            });
        });
    </script>

    {{-- JS: Parent-child checkbox sync --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.menu-checkbox').forEach(menu => {
                menu.addEventListener('change', function() {
                    const submenus = menu.closest('li').querySelectorAll('input[type="checkbox"]');
                    submenus.forEach(cb => cb.checked = menu.checked);
                });
            });

            document.querySelectorAll('.submenu-checkbox').forEach(submenu => {
                submenu.addEventListener('change', function() {
                    const parentMenu = submenu.closest('ul').closest('li').querySelector(
                        '.menu-checkbox');
                    if (submenu.checked) parentMenu.checked = true;
                });
            });
        });
    </script>

@endsection
