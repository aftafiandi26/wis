<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use Illuminate\Support\Str;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// HRD - Employes
Breadcrumbs::for('hrd.employes', function (BreadcrumbTrail $trail) {
    $trail->push('Employes', route('employes.index'));
});

Breadcrumbs::for('hrd.employes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('hrd.employes');
    $trail->push('Create', route('employes.create'));
});

Breadcrumbs::for('hrd.employes.edit', function (BreadcrumbTrail $trail, $employee) {
    $trail->parent('hrd.employes');
    $trail->push(Str::slug($employee->fullname()), route('employes.edit', $employee->id));
});

Breadcrumbs::for('hrd.employes.actived', function (BreadcrumbTrail $trail) {
    $trail->parent('hrd.employes');
    $trail->push('Actived', route('employes.actived'));
});

///

Breadcrumbs::for('hrd.employes.annualeave', function (BreadcrumbTrail $trail) {
    $trail->push('Employes Leave', route('annualeave.index'));
});

Breadcrumbs::for('hrd.employes.annualeave.edit', function (BreadcrumbTrail $trail, $employee) {
    $trail->parent('hrd.employes.annualeave');
    $trail->push('Edit', route('annualeave.edit', $employee));
});

// Applying Leave
Breadcrumbs::for('applying-leave.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Applying Leave', route('applying-leave-dashboard.index'));
});

Breadcrumbs::for('applying-leave.annual', function (BreadcrumbTrail $trail) {
    $trail->parent('applying-leave.dashboard');
    $trail->push('Annual', route('applying-leave-annual.create'));
});

// Super Admin

Breadcrumbs::for('superadmin.management.roleaccess', function (BreadcrumbTrail $trail) {
    $trail->push('Role Access', route('management-role-access.index'));
});

Breadcrumbs::for('superadmin.management.roleentitlement', function (BreadcrumbTrail $trail) {
    $trail->push('Role Entitlement Leave', route('management-role-entitlement.index'));
});
